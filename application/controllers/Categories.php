<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categories extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	public function loadCategories()
	{
		$limit=16;
		$categories=$this->App_model->getData('categories',$resultType="all_array",$arg=['select'=>['COUNT(questions.qid) as totalPosts','categories.name as catname','categories.permalink','categories.description'],'limit'=>[$limit,0],'group'=>['col'=>'categories.catid'],'join'=>['table'=>'questions','query'=>'categories.catid=questions.catid','type'=>'left'],'order'=>['col'=>'totalPosts','type'=>'desc']]);
		$totalCategories=$this->App_model->getData('categories',$resultType="count",$arg=['where'=>['status'=>1]]);
		$data=$this->SiteModel->getSiteData();
		$data['title']="Categories";
		$data['next']=$limit;
		$data['totalCategories']=$totalCategories;
		$data['fetchedCategories']=count($categories);
		$data['categories']=$categories;
		$this->load->view('categories',$data);
	}
	
	public function addCategories()
	{
		if (checksessionAdmin()) {
			redirect('admin');
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Display name', 'required|max_length[30]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == true) {
			$email=trim($this->input->post('email'));
			$name=trim($this->input->post('name'));
			$password=trim($this->input->post('password'));
			$checkEmail=$this->App_model->getData('users',$resultType="count_arr",$arg=['where'=>['email'=>$email]]);
			if ($checkEmail>0) {
				responseGenerate(0,"This email already exists");
			}
			
			$this->App_model->insert('users',['name'=>$name,'email'=>$email,'password'=>sha1($password),'status'=>0],$batch=false);
			$id=$this->db->insert_id();
			$hash=sha1($id.uniqid());
			$this->App_model->insert('signupHashes',['hash'=>$hash,'userid'=>$id],$batch=false);
			$link=base_url().'signup/confirm/'.$hash;
			$message='Hello, Please confirm the link '.$link.'"> to create your account';
			sendEmail($email,$message,"Continue to create you account");
			
			responseGenerate(1,"Account was successfully created");
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
		
		
	}
	
	public function loadMoreCategories()
	{
		$limit=16;
		$next=(int) secureInput($this->input->post('next'));
		$filters=secureInput($this->input->post('filters'));
		$search=secureInput($this->input->post('search'));
		
		$where=['categories.status'=>1];
		if ($filters=="name") {
			$col="categories.name";
			$type="asc";
		} else if ($filters=="new") {
			$col="categories.on";
			$type="desc";  
		} else {
			$col="totalPosts";
			$type="desc";
		}
		$args=['where'=>$where];
		
		if (strlen($search)>0) {
			$args['like']=['col'=>'categories.name','query'=>$search];
		}
		
		$totalCategories=$this->App_model->getData('categories',$resultType="count",$arg=$args);
		
		$args['limit']=[$limit,$next];
		$args['order']=['col'=>$col,'type'=>$type];
		$args['select']=['COUNT(questions.qid) as totalPosts','categories.name as catname','categories.permalink','categories.description'];
		$args['group']=['col'=>'categories.catid'];
		$args['join']=['table'=>'questions','query'=>'categories.catid=questions.catid','type'=>'left'];
		
		$categories=$this->App_model->getData('categories',$resultType="all_array",$arg=$args);
		$categoriesView=$this->load->view('categoriesLM',['categories'=>$categories],true);
		$next=$limit+$next;
		
		$result=[];
		$result['type']=1;
		$result['next']=$next;
		$result['loadMoreH']=$next>$totalCategories?1:0;
		$result['result']=$categoriesView;
		echo json_encode($result);
	}
}