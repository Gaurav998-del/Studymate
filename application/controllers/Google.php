<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Google extends CI_Controller {
	public function index()
	{
		$siteSettings = $this->App_model->getData('siteSettings','row_array',$arg=['select'=>['googleAppId','googleAppSecret']]);
		require_once APPPATH.'third_party/src/Google_Client.php';
		require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';
		$clientId =$siteSettings['googleAppId']; //Google client ID
		$clientSecret = $siteSettings['googleAppSecret']; //Google client secret
		$redirectURL = base_url() . 'google/redirect';
		
		//Call Google API
		$gClient = new Google_Client();
		$gClient->setApplicationName('Login');
		$gClient->setClientId($clientId);
		$gClient->setClientSecret($clientSecret);
		$gClient->setRedirectUri($redirectURL);
		$google_oauthV2 = new Google_Oauth2Service($gClient);
	
		if (isset($_GET['code'])) {
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
		}

		if (isset($_SESSION['token'])) {
			$gClient->setAccessToken($_SESSION['token']);
		}
		
		if ($gClient->getAccessToken()) {
			$googleUser = $google_oauthV2->userinfo->get();
			$id = $googleUser['id'];
			
			$getUser = $this->App_model->getData('users','row_array',$arg=['where'=>['googleplus'=>$id]]);
			if (count($getUser) > 0) {
				$this->session->userid=$getUser['userid'];
				$this->session->name=$getUser['name'];
				$this->session->email=$getUser['email'];
				$this->session->image=$getUser['image'];
			} else {
				$name=isset($googleUser['given_name'])?$googleUser['given_name']:"";
				$email=isset($googleUser['email'])?$googleUser['email']:"";
				
				$this->App_model->insert('users',['name'=>$name,'email'=>$email,'googleplus'=>$id,'status'=>1],$batch=false);
				$userid=$this->db->insert_id();
				$this->session->userid=$userid;
				$this->session->name=$name;
				$this->session->email=$email;
				$this->session->image="default-user-image.png";
			}
			redirect('');
		} else {
			$url = $gClient->createAuthUrl();
			header("Location:".$url);
			exit;
		}
	}
}