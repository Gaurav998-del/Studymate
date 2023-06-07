<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Jobs extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('QuestionsModel');
	}
	
	public function jobPost()
	{
		$data=$this->SiteModel->getSiteData();
		$data['title']="Ask";
		$this->load->view('jobPost',$data);
	}
	
	public function postJob()
	{
		
		if(!checksession()){
		responseGenerate(2,"Please login to continue");
		}
			$title=trim($this->input->post('title'));
			$category=trim($this->input->post('category'));
		
			$technologies=strip_tags(trim($this->input->post('technologies')));
			$experience=strip_tags(trim($this->input->post('experience')));
			$jobtype=strip_tags(trim($this->input->post('jobtype')));
			$role=strip_tags(trim($this->input->post('role')));
			$description=encodeContent(trim($this->input->post('description')));
			//$m=date("Y-m-d");
			$this->App_model->insert('Jobs',['job_title'=>$title,'job_category'=>$category,'technologies'=>$technologies,'job_role'=>$role,'job_type'=>$jobtype,'job_experience'=>$experience],$batch=false);
		
	}
}
?>