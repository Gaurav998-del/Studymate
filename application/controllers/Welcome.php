<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
	public function index($login=0)
	{
		if (($login==1 || $login==2) && checksession()) {
			redirect('');
		}
		$data=$this->SiteModel->getSiteData();
		if ($login==2) {
			$hash=$this->uri->segment(3);
			$checkHash=$this->validateForgotHash($hash);
			
			if (is_array($checkHash)) {
				 show_404();
			}
			$data['hash']=$hash;
		}
		
		$data['title']="";
		$data['login']=$login;
		
		$this->load->model('QuestionsModel');
		$getAllQuestions=$this->QuestionsModel->getAllQuestions(15,0);
		
		$data['getPopularQuestions']=$this->QuestionsModel->getPopularQuestions();
		$data['getPopularQuestionsTags']=$this->QuestionsModel->getPopularQuestionsTags();
		$data['getAllQuestions']=$getAllQuestions;
		
		
		$this->load->view('index',$data);
	}
	public function asearch($login=0)
	{
		if (($login==1 || $login==2) && checksession()) {
			redirect('');
		}
		$data=$this->SiteModel->getSiteData();
		if ($login==2) {
			$hash=$this->uri->segment(3);
			$checkHash=$this->validateForgotHash($hash);
			
			if (is_array($checkHash)) {
				 show_404();
			}
			$data['hash']=$hash;
		}
		
		$data['title']="";
		$data['login']=$login;
		
		$this->load->model('QuestionsModel');
		$getAllQuestions=$this->QuestionsModel->getAllQuestions(15,0);
		
		$data['getPopularQuestions']=$this->QuestionsModel->getPopularQuestions();
		$data['getPopularQuestionsTags']=$this->QuestionsModel->getPopularQuestionsTags();
		$data['getAllQuestions']=$getAllQuestions;
		$qt=$this->QuestionsModel->adsearch();
		$data['qt']=$qt;
		$this->load->view('advancesearch',$data);
	}
	function responseGenerate($type,$html="")
	{
		$result=['type'=>$type,'html'=>$html];
		echo json_encode($result);
		exit;
	}
	public function validateForgotHash($hash)
	{
		$signupHashe=$this->App_model->getData('forgotHashes',$resultType="c_array",$arg=['where'=>['hash'=>$hash]]);
		return $signupHashe;
	}
	
	public function search()
	{
		$search=trim($this->input->post('search'));
		
		if (strlen($search)==0) {
			responseGenerate(1,"");
		}
		
		$searchRows=$this->App_model->getData('questions',$resultType="all_array",$arg=['select'=>['qid','title','permalink'],'like'=>['col'=>'title','query'=>$search],'where'=>['status'=>1]]);
		
		$searchView=$this->load->view('searchViewFull',['searchRows'=>$searchRows],true);
		
		responseGenerate(1,$searchView);
	}
	
	public function signupConfirm($hash)
	{
		$signupHashe=$this->App_model->getData('signupHashes',$resultType="row_array",$arg=['select'=>['userid'],'where'=>['hash'=>$hash]]);
		if (count($signupHashe)>0) {
			$userid=$signupHashe['userid'];
			$this->App_model->updateData('users',['status'=>1],['userid'=>$userid]);
			$this->App_model->deleteData('signupHashes',['hash'=>$hash]);
			redirect('login');
		} else {
			show_404();
		}
	}
	
	public function forgotAc()
	{
		if (checksession()) {
			responseGenerate(2,"You are already logined");
		}
		$hash=trim($this->input->post('hash'));
		$password=trim($this->input->post('passwordF'));
		if (strlen($password)==0) {
			responseGenerate(0,"Please enter new password");
		}
		if (strlen($hash)==0) {
			responseGenerate(0,"Invalid access");
		}
		
		$forgotHashes=$this->App_model->getData('forgotHashes',$resultType="row_array",$arg=['select'=>['userid'],'where'=>['hash'=>$hash]]);
		if (count($forgotHashes)>0) {
			$userid=$forgotHashes['userid'];
			$password=sha1($password);
			
			$this->App_model->updateData('users',['status'=>1,'password'=>$password],['userid'=>$userid]);
			$this->App_model->deleteData('forgotHashes',['hash'=>$hash]);
			responseGenerate(1,"Password was successfully changed");
		} else {
			responseGenerate(0,"Invalid access");
		}
	}
	public function signup()
	{
		if (checksession()) {
			responseGenerate(2,"You are already logined");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Display name', 'required|max_length[30]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == true) {
			$email=trim($this->input->post('email'));
			$name=trim($this->input->post('name'));
			$ucontact=trim($this->input->post('ucontact'));
			$udob=trim($this->input->post('udob'));
			$password=trim($this->input->post('password'));
			$checkEmail=$this->App_model->getData('users',$resultType="count_arr",$arg=['where'=>['email'=>$email]]);
			if ($checkEmail>0) {
				responseGenerate(0,"This email already exists");
			}
			
			$this->App_model->insert('users',['name'=>$name,'email'=>$email,'password'=>sha1($password),'status'=>0,'birthdate'=>$udob,'contact'=>$ucontact],$batch=false);
			$id=$this->db->insert_id();
			$hash=sha1($id.uniqid());
			$this->App_model->insert('signupHashes',['hash'=>$hash,'userid'=>$id],$batch=false);
			$link=base_url().'signup/confirm/'.$hash;
			$message='Hello, Please confirm the link '.$link.'"> to create your account';
			sendEmail($email,$message,"Continue to create you account");
			
			responseGenerate(1,"Account was successfully created ");
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}
	public function login()
	{
		if (checksession()) {
			responseGenerate(2,"You are already logined");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == true) {
			$email=trim($this->input->post('email'));
			$password=trim($this->input->post('password'));
			$checkAccount=$this->App_model->getData('users',$resultType="row_array",$arg=['where'=>['email'=>$email,'password'=>sha1($password)]]);
			
			if (count($checkAccount)==0) {
				responseGenerate(0,"Invalid email or password");
			}
			
			if ($checkAccount['status']!=1) {
				responseGenerate(0,"Please Contact Admin to activate your account");
			}
			
			$userid=$checkAccount['userid'];
			$name=$checkAccount['name'];
			$image=$checkAccount['image'];
			$role=$checkAccount['role'];
			
			$this->session->userid=$userid;
			$this->session->name=$name;
			$this->session->email=$email;
			$this->session->image=$image;
			$this->session->role=$role;
			responseGenerate(1,"Success");
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}
	public function forgot()
	{
		if (checksession()) {
			responseGenerate(2,"You are already logined");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
		
		if ($this->form_validation->run() == true) {
			$email=trim($this->input->post('email'));
			$checkAccount=$this->App_model->getData('users',$resultType="row_array",$arg=['where'=>['email'=>$email]]);
			if (count($checkAccount)==0) {
				responseGenerate(0,"Email doesnot exist");
			}
			
			$userid=$checkAccount['userid'];
			$checkforgotHashes=$this->App_model->getData('forgotHashes',$resultType="count",$arg=['where'=>['userid'=>$userid]]);
			$hash=sha1($userid.uniqid());
			
			if ($checkforgotHashes==0) {
				$this->App_model->insert('forgotHashes',['hash'=>$hash,'userid'=>$userid],$batch=false);
			} else {
				$this->App_model->updateData('forgotHashes',['hash'=>$hash],['userid'=>$userid],$batch=false);
			}
			
			$link=base_url().'forgot/confirm/'.$hash;
			$message='Hello, Please confirm the link '.$link.'"> to reset your password';
			sendEmail($email,$message,"Reset the password @howstack");
			
			responseGenerate(1,"Please confirm the email sent to you to reset password");
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}
	function logout()
	{
		unset($_SESSION['userid']);
		unset($_SESSION['name']);
		unset($_SESSION['email']);
		session_destroy();
		redirect('');
	}
	function test($login=0){
		
		if (($login==1 || $login==2) && checksession()) {
			redirect('');
		}
		$data=$this->SiteModel->getSiteData();
		if ($login==2) {
			$hash=$this->uri->segment(3);
			$checkHash=$this->validateForgotHash($hash);
			
			if (is_array($checkHash)) {
				 show_404();
			}
			$data['hash']=$hash;
		}
		$data['title']="";
		$data['login']=$login;
		$this->load->view('testview',$data);
	}
	function searchquestion($login=0){
		if (($login==1 || $login==2) && checksession()) {
			redirect('');
		}
		$data=$this->SiteModel->getSiteData();
		if ($login==2) {
			$hash=$this->uri->segment(3);
			$checkHash=$this->validateForgotHash($hash);
			
			if (is_array($checkHash)) {
				 show_404();
			}
			$data['hash']=$hash;
		}
		$data['title']="";
		$data['login']=$login;
		$search=trim($this->input->post('search'));
		$this->load->model('QuestionsModel');
		$getAllQuestions=$this->QuestionsModel->searchAllQuestions(15,0,$search);
		$data['getPopularQuestions']=$this->QuestionsModel->getPopularQuestions();
		$data['getPopularQuestionsTags']=$this->QuestionsModel->getPopularQuestionsTags();
		$data['getAllQuestions']=$getAllQuestions;
		$searchRows=$this->App_model->getData('questions',$resultType="all_array",$arg=['select'=>['qid','title','permalink','tags','votes','views','awnsers','on'],'like'=>['col'=>'title','query'=>$search],'where'=>['status'=>1]]);
        // var_dump($searchRows);
		// exit;
		$data['searchresult']=$searchRows;
		$this->load->view('testview',$data);
	}
}
