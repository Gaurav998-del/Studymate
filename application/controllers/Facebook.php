<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Facebook extends CI_Controller {
	public function index()
	{
		$siteSettings = $this->App_model->getData('siteSettings','row_array',$arg=['select'=>['fbAppId','fbAppSecet']]);
		require_once APPPATH.'libraries/facebook/autoload.php';
		$fb = new Facebook\Facebook([
		  'app_id' => $siteSettings['fbAppId'], // Replace {app-id} with your app id
		  'app_secret' => $siteSettings['fbAppSecet'],
		  'default_graph_version' => 'v2.2',
		]);
		$helper = $fb->getRedirectLoginHelper();
		try {
			if (isset($_SESSION['facebook_access_token'])) {
				$accessToken = $_SESSION['facebook_access_token'];
			}else{
				$accessToken = $helper->getAccessToken();
			}
		} catch(FacebookResponseException $e) {
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(FacebookSDKException $e) {
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
		if (isset($accessToken)) {
			if (isset($_SESSION['facebook_access_token'])) {
				$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
			} else {
				$_SESSION['facebook_access_token'] = (string) $accessToken;
				
				$oAuth2Client = $fb->getOAuth2Client();
				
				$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
				$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
				$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
			}
			
			if (isset($_GET['code'])) {
				header('Location: ./');
			}
			try {
				$profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,cover,picture');
				$fbUserProfile = $profileRequest->getGraphNode()->asArray();
				if (count($fbUserProfile)>0) {
					$name=isset($fbUserProfile['name'])?$fbUserProfile['name']:"";
					$email=isset($fbUserProfile['email'])?$fbUserProfile['email']:"";
					$id=isset($fbUserProfile['id'])?$fbUserProfile['id']:"";
					$checkFacebookAccount=$this->App_model->getData('users',$resultType="row_array",$arg=['where'=>['facebook'=>$id]]);
					
					if (count($checkFacebookAccount)==0) {
						$this->App_model->insert('users',['name'=>$name,'email'=>$email,'facebook'=>$id,'status'=>1],$batch=false);
						$userid=$this->db->insert_id();
						$this->session->userid=$userid;
						$this->session->name=$name;
						$this->session->email=$email;
						$this->session->image="default-user-image.png";
					} else {
						$this->session->userid=$checkFacebookAccount['userid'];
						$this->session->name=$checkFacebookAccount['name'];
						$this->session->email=$checkFacebookAccount['email'];
						$this->session->image=$checkFacebookAccount['image'];
					}
					redirect('');
				} else {
					echo "Unable to authorize account";
					exit;
				}
			} catch(FacebookResponseException $e) {
				echo 'Graph returned an error: ' . $e->getMessage();
				session_destroy();
				header("Location: ./");
				exit;
			} catch(FacebookSDKException $e) {
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}
		} else {
			$permissions = ['email'];
			$loginUrl = $helper->getLoginUrl(base_url().'facebook/redirect', $permissions);
			header("Location: ".$loginUrl);
		}
	}
}