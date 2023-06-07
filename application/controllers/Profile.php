<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('ProfileModel');
	}
	public function loadProfile($userid)
	{
		$checkUserExistence=$this->App_model->getData('users',$resultType="count",$arg=['where'=>['userid'=>$userid]]);
		if ($checkUserExistence==0) {
			show_404();
		}
		$questionPosted=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		
		$answersPosted=$this->App_model->getData('awnsers',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		$user=$this->App_model->getData('users',$resultType="row_array",$arg=['select'=>['name','badgesGold','badgesSilver','badgesBronze','views','peopleReached','votes','title','location','description','website','twitter','image','github','on','contact','birthdate'],'where'=>['userid'=>$userid]]);
		
		$goldBadges=$this->App_model->getData('awardedBadges',$resultType="all_array",$arg=['select'=>['awardedBadges.on','badges.name','badges.priority'],'limit'=>[3,0],'where'=>['awardedBadges.userid'=>$userid,'badges.priority'=>1],'join'=>['table'=>'badges','query'=>'badges.badgeId=awardedBadges.badgeId','type'=>'inner']]);
		$silverBadges=$this->App_model->getData('awardedBadges',$resultType="all_array",$arg=['select'=>['awardedBadges.on','badges.name','badges.priority'],'limit'=>[3,0],'where'=>['awardedBadges.userid'=>$userid,'badges.priority'=>2],'join'=>['table'=>'badges','query'=>'badges.badgeId=awardedBadges.badgeId','type'=>'inner']]);
		$bronzeBadges=$this->App_model->getData('awardedBadges',$resultType="all_array",$arg=['select'=>['awardedBadges.on','badges.name','badges.priority'],'limit'=>[3,0],'where'=>['awardedBadges.userid'=>$userid,'badges.priority'=>3],'join'=>['table'=>'badges','query'=>'badges.badgeId=awardedBadges.badgeId','type'=>'inner']]);
		
		$getUserCategoryStats=$this->ProfileModel->getUserCategoryStats($userid);
		
		$hasView=$this->ProfileModel->manageViews($userid);
		if ($hasView==true) {
			$views=$user['views'];
			$user['views']=$views++;
			$peopleReached=$user['peopleReached'];
			$user['peopleReached']=$peopleReached++;
		}
		$user['memberSince']=time_elapsed_string($user['on']);
		
		$data=$this->SiteModel->getSiteData();
		$data['title']=$user['name'];
		$data['goldBadges']=$goldBadges;
		$data['silverBadges']=$silverBadges;
		$data['bronzeBadges']=$bronzeBadges;
		$data['questionPosted']=$questionPosted;
		$data['answersPosted']=$answersPosted;
		$data['getUserCategoryStats']=$getUserCategoryStats;
		$data['user']=$user;
		$data['userid']=$userid;
		$this->load->view('userProfile',$data);
	}
	public function loadProfileEdit($userid)
	{
		$checkUserExistence=$this->App_model->getData('users',$resultType="count",$arg=['where'=>['userid'=>$userid]]);
		if ($checkUserExistence==0) {
			show_404();
		}
		$questionPosted=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		
		$answersPosted=$this->App_model->getData('awnsers',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		$user=$this->App_model->getData('users',$resultType="row_array",$arg=['select'=>['name','badgesGold','badgesSilver','badgesBronze','views','peopleReached','title','location','description','website','twitter','image','github','on'],'where'=>['userid'=>$userid]]);
		
		$hasView=$this->ProfileModel->manageViews($userid);
		if ($hasView==true) {
			$views=$user['views'];
			$user['views']=$views++;
			$peopleReached=$user['peopleReached'];
			$user['peopleReached']=$peopleReached++;
		}
		$user['memberSince']=time_elapsed_string($user['on']);
		
		$data=$this->SiteModel->getSiteData();
		$data['title']=$user['name'];
		$data['questionPosted']=$questionPosted;
		$data['answersPosted']=$answersPosted;
		$data['user']=$user;
		$data['userid']=$userid;
		$this->load->view('userProfileEdit',$data);
	}
	public function loadProfileActivity($userid)
	{
		$checkUserExistence=$this->App_model->getData('users',$resultType="count",$arg=['where'=>['userid'=>$userid]]);
		if ($checkUserExistence==0) {
			show_404();
		}
		$questionPosted=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		$answersPosted=$this->App_model->getData('awnsers',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		
		$user=$this->App_model->getData('users',$resultType="row_array",$arg=['select'=>['name','badgesGold','badgesSilver','badgesBronze','views','peopleReached','title','location','description','website','twitter','image','github','on'],'where'=>['userid'=>$userid]]);
		
		$awardedBadges=$this->App_model->getData('awardedBadges',$resultType="all_array",$arg=['select'=>['awardedBadges.on','badges.name','badges.priority'],'order'=>['col'=>'on','type'=>'desc'],'where'=>['awardedBadges.userid'=>$userid],'join'=>['table'=>'badges','query'=>'badges.badgeId=awardedBadges.badgeId','type'=>'inner']]);
		
		$limit=5;
		$questions=$this->App_model->getData('questions',$resultType="all_array",$arg=['limit'=>[$limit,0],'order'=>['col'=>'on','type'=>'desc'],'where'=>['userid'=>$userid]]);
		$totalQuestionsCount=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		$data=$this->SiteModel->getSiteData();
		$data['title']=$user['name'];
		$data['now']=$limit;
		$data['next']=$limit;
		$data['questions']=$questions;
		$data['totalQuestionsCount']=$totalQuestionsCount;
		
		$hasView=$this->ProfileModel->manageViews($userid);
		if ($hasView==true) {
			$views=$user['views'];
			$user['views']=$views++;
			$peopleReached=$user['peopleReached'];
			$user['peopleReached']=$peopleReached++;
		}
		
		$reputationRecord=$this->App_model->getData('reputationRecord',$resultType="all_array",$arg=['order'=>['col'=>'on','type'=>'desc'],'where'=>['userid'=>$userid]]);
		
		$data['awardedBadges']=$awardedBadges;
		$data['questionPosted']=$questionPosted;
		$data['answersPosted']=$answersPosted;
		$data['reputationRecord']=$reputationRecord;
		$data['totalReputationRecords']=count($reputationRecord);
		$data['user']=$user;
		$data['userid']=$userid;
		$this->load->view('userProfileActivity',$data);
	}
	
	public function getActivityTab()
	{
		$userid=secureInput($this->input->post('userid'));
		$limit=5;
		$questions=$this->App_model->getData('questions',$resultType="all_array",$arg=['limit'=>[$limit,0],'order'=>['col'=>'on','type'=>'desc'],'where'=>['userid'=>$userid]]);
		$totalQuestionsCount=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		
		$data['now']=$limit;
		$data['next']=$limit;
		$data['questions']=$questions;
		$data['totalQuestionsCount']=$totalQuestionsCount;
		$html=$this->load->view('activityView',$data,true);
		
		responseGenerate(1,$html);
	}	
	public function loadMoreQProfile()
	{
		$limit=5;
		$type=secureInput($this->input->post('type'));
		$userid=secureInput($this->input->post('userid'));
		$next=(int) secureInput($this->input->post('next'));
		$col=$type=="votes"?"votes":"on";
		$questions=$this->App_model->getData('questions',$resultType="all_array",$arg=['limit'=>[$limit,$next],'order'=>['col'=>$col,'type'=>'desc'],'where'=>['userid'=>$userid]]);
		$totalQuestionsCount=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		
		$next=$limit+$next;
		$result=[];
		$result['type']=1;
		$result['next']=$next;
		$result['loadMoreH']=$next>$totalQuestionsCount?1:0;
		$result['result']=$this->load->view('questionsProfileList',['questions'=>$questions],true);
		echo json_encode($result);
	}
	public function loadMoreAProfile()
	{
		$limit=5;
		$userid=secureInput($this->input->post('userid'));
		$type=secureInput($this->input->post('type'));
		$next=(int) secureInput($this->input->post('next'));
		
		$col=$type=="awnsers.votes"?"awnsers.votes":"awnsers.on";
		$answersDb=$this->App_model->getData('awnsers',$resultType="all_array",$arg=['select'=>['awnsers.votes','awnsers.qaid','awnsers.qid','awnsers.on','awnsers.userid','questions.title as qtitle','questions.permalink'],'limit'=>[$limit,$next],'where'=>['awnsers.userid'=>$userid],'order'=>['col'=>$col,'type'=>'desc'],'join'=>['table'=>'questions','query'=>'questions.qid=awnsers.qid','type'=>'inner']]);
		
		$totalAnswersCount=$this->App_model->getData('awnsers',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		
		$next=$limit+$next;
		$result=[];
		$result['type']=1;
		$result['next']=$next;
		$result['loadMoreH']=$next>$totalAnswersCount?1:0;
		$result['result']=$this->load->view('answerProfileList',['answers'=>$answersDb],true);
		echo json_encode($result);
	}
	
	public function postGetProfileQuestions()
	{
		$userid=secureInput($this->input->post('userid'));
		$checkUser=$this->App_model->getData('users',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		if ($checkUser==0) {
			responseGenerate(0,"This user doesnot exist");
		}
		
		$type=secureInput($this->input->post('type'));
		$col=$type=="votes"?"votes":"on";
		$limit=5;
		$questions=$this->App_model->getData('questions',$resultType="all_array",$arg=['limit'=>[$limit,0],'order'=>['col'=>$col,'type'=>'desc'],'where'=>['userid'=>$userid]]);
		$totalQuestionsCount=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		$data=[];
		$data['now']=$limit;
		$data['next']=$limit;
		$data['questions']=$questions;
		$data['totalQuestionsCount']=$totalQuestionsCount;
		
		$questions=$this->load->view('questionProfileTemplate',$data,true);
		$result=[];
		$result['type']=1;
		$result['count']=$totalQuestionsCount;
		$result['result']=$questions;
		echo json_encode($result);
	}
	
	public function postGetProfileAnswers()
	{
		$userid=secureInput($this->input->post('userid'));
		$type=secureInput($this->input->post('type'));
		$checkUser=$this->App_model->getData('users',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		if ($checkUser==0) {
			responseGenerate(0,"This user doesnot exist");
		}
		$limit=5;
		$col=$type=="awnsers.votes"?"awnsers.votes":"awnsers.on";
		$answersDb=$this->App_model->getData('awnsers',$resultType="all_array",$arg=['select'=>['awnsers.votes','awnsers.qaid','awnsers.qid','awnsers.on','awnsers.userid','questions.title as qtitle','questions.permalink'],'limit'=>[$limit,0],'where'=>['awnsers.userid'=>$userid],'order'=>['col'=>$col,'type'=>'desc'],'join'=>['table'=>'questions','query'=>'questions.qid=awnsers.qid','type'=>'inner']]);
		
		$totalAnswersCount=$this->App_model->getData('awnsers',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		$data=[];
		$data['now']=$limit;
		$data['next']=$limit;
		$data['answers']=$answersDb;
		$data['totalAnswersCount']=$totalAnswersCount;
		$answers=$this->load->view('answersProfileTemplate',$data,true);
		$result=[];
		$result['type']=1;
		$result['count']=count($answersDb);
		$result['result']=$answers;
		echo json_encode($result);
	}	
	public function postUpdateProfile()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|max_length[30]');
		$this->form_validation->set_rules('title', 'Title', 'max_length[30]');
		$website=secureInput($this->input->post('website'));
		if (strlen($website)>0) {
			$this->form_validation->set_rules('website', 'Website Link', 'max_length[200]|callback_valid_url');
		}
		$this->form_validation->set_rules('twitter', 'Twitter Link', 'max_length[200]');
		$this->form_validation->set_rules('github', 'Github Link', 'max_length[200]');
		$this->form_validation->set_rules('location', 'Location', 'max_length[200]');
		
		if ($this->form_validation->run() == true) {
			$name=secureInput($this->input->post('name'));
			$title=secureInput($this->input->post('title'));
			
			$twitter=secureInput($this->input->post('twitter'));
			$github=secureInput($this->input->post('github'));
			$location=secureInput($this->input->post('location'));
			$description=encodeContent(trim($this->input->post('description')));
			$userid=getuserid();
			$this->session->name=$name;
			$this->App_model->updateData('users',['name'=>$name,'title'=>$title,'website'=>$website,'location'=>$location,'twitter'=>$twitter,'description'=>$description,'github'=>$github],['userid'=>$userid]);
			responseGenerate(1,"Your profile was successfully updated");
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}
	function postUpdateProfilePic(){
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		if (isset($_FILES['image'])) {
			if ($_FILES['image']['error']==0) {
				$name=$_FILES['image']['name'];
				$file_ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
				$genfileName=md5($name.uniqid()).".".$file_ext;
				$siteRoot= realpath(dirname(__FILE__));
				move_uploaded_file($_FILES['image']['tmp_name'],"./images/".$genfileName);
				$userid=getuserid();
				$this->App_model->updateData('users',['image'=>$genfileName],['userid'=>$userid]);
				responseGenerate(1,"Your image was successfully saved");
			} else {
				responseGenerate(2,"This file is corrupted , Please chose another");
			}
		} else {
			responseGenerate(2,"Please choose an image to upload");
		}
	}
	function valid_url($str){
	   $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
		if (!preg_match($pattern, $str)) {
			return FALSE;
		}
		return TRUE;
    }
	
	public function loadNotifications()
	{
		if (!checksession()){
			redirect('login');
		}
		$data=$this->SiteModel->getSiteData();
		$data['title']="Notifications";
		$userid=getuserid();
		$limit=10;
		$getAllNotifications=$this->SiteModel->getNotifications($userid,$limit,0);
		
		$getAllNotificationsCount=$this->App_model->getData('notifications',$resultType="count",$arg=['where'=>['for'=>$userid]]);
		
		$this->load->model('QuestionsModel');
		$data['getPopularQuestions']=$this->QuestionsModel->getPopularQuestions();
		$data['getPopularQuestionsTags']=$this->QuestionsModel->getPopularQuestionsTags();
		$data['getAllNotifications']=$getAllNotifications;
		$data['next']=$limit;
		$data['getAllNotificationsCount']=$getAllNotificationsCount;
		$this->load->view('notifications',$data);
	}
	public function loadMoreN()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$userid=getuserid();
		$limit=10;
		$next=(int) secureInput($this->input->post('next'));
		
		$getAllNotifications=$this->SiteModel->getNotifications($userid,$limit,$next);
		$getAllNotificationsCount=$this->App_model->getData('notifications',$resultType="count",$arg=['where'=>['for'=>$userid]]);
		
		$next=$limit+$next;
		$result=[];
		$result['type']=1;
		$result['next']=$next;
		$result['loadMoreH']=$next>$getAllNotificationsCount?1:0;
		$result['result']=$this->load->view('notificationsTemplate',['getAllNotifications'=>$getAllNotifications],true);
		echo json_encode($result);
	}
}