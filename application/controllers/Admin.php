<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	public function __contstruct()
	{
		parent::__construct();
		
	}
	
	
	
	public function blog()
	{
		$data=$this->SiteModel->getSiteData();
		$data['title']="Ask";
		$this->load->view('admin/blog',$data);
	}
	
	// Category function

	public function examcat()
	{
		$data=$this->SiteModel->getSiteData();
		$data['title']="Ask";
		$this->load->model("Blog");
		$r=$this->Blog->category_list();
		$data['category_list']=$r;
		$this->load->view('admin/examcategory',$data);
	}
	
	public function insert_category()
	{
		
		
			// 		$logged_in=$this->session->userdata('logged_in');
   //                      $acp=explode(',',$logged_in['setting']);
			// if(!in_array('All',$acp)){
			// exit($this->lang->line('permission_denied'));
			// }
			$this->load->model("Blog");

				if($this->Blog->insert_category()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
						
				}
				redirect('admin/examcat/');
	
	}
		public function remove_category($cid){

					
// 			$mcid=$this->input->post('mcid');
// $this->db->query(" update savsoft_qbank set cid='$mcid' where cid='$cid' ");
			$this->load->model("Blog");


			if($this->Blog->remove_category($cid)){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");
						
					}
					redirect('admin/examcat/');
                     
			
		}

public function pre_remove_category($cid){
		
		$data=$this->SiteModel->getSiteData();
		$data['title']="Ask";
			
		$data['cid']=$cid;
		// fetching group list
		$this->load->model("Blog");
		$r=$this->Blog->category_list();
	
		$data['category_list']=$r;
		$data['title']=$this->lang->line('remove_category');
		$this->load->view('admin/pre_remove_cat',$data);
		
		
	
	}

	// Level function


public function level_list(){
		
		// fetching group list
		$data=$this->SiteModel->getSiteData();
		$data['title']="Ask";
		$this->load->model("Blog");
		$r=$this->Blog->level_list();
	
		$data['level_list']=$r;
		$this->load->view('admin/level_list',$data);

		
		
		
	}
	
	
		public function insert_level()
		{
		
			$this->load->model("Blog");
				if($this->Blog->insert_level()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
						
				}
				redirect('admin/level_list/');
	
		}
	
// 			public function update_level($lid)
// 	{
		
		
// 					$logged_in=$this->session->userdata('logged_in');
//                         $acp=explode(',',$logged_in['setting']);
// 			if(!in_array('All',$acp)){
// 			exit($this->lang->line('permission_denied'));
// 			}
	
// 				if($this->qbank_model->update_level($lid)){
//                 echo "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>";
// 				}else{
// 				 echo "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>";
						
// 				}
				 
	
// 	}
	
	
	
	
			public function remove_level($lid){
    
		$mlid=$this->input->post('mlid');
		// $this->db->query(" update savsoft_qbank set lid='$mlid' where lid='$lid' ");
		$this->load->model("Blog");
	 			
			if($this->Blog->remove_level($lid)){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");
						
					}
					redirect('admin/level_list');
                     
			
		}
// 	// level functions end
	
	
	
		public function pre_remove_level($lid){
			$data=$this->SiteModel->getSiteData();
		$data['title']="Level";
		$data['lid']=$lid;

			$this->load->model("Blog");
		// fetching group list
		$data['level_list']=$this->Blog->level_list();
		$this->load->view('admin/pre_remove_level',$data);
		
		
	}
	// Exam question


	public function pre_new_question()
	{
			$data=$this->SiteModel->getSiteData();
	 	$data['title']="Add New Question";
	$para=0;
		if($this->input->post('with_paragraph')){
		$para=1;
		
		}
		
		
			
		if($this->input->post('question_type')){
		if($this->input->post('question_type')=='1'){
			$nop=$this->input->post('nop');
			if(!is_numeric($this->input->post('nop'))){
				$nop=4;
			}
		redirect('admin/new_question_1/'.$nop.'/'.$para);
		}
		if($this->input->post('question_type')=='2'){
			$nop=$this->input->post('nop');
			if(!is_numeric($this->input->post('nop'))){
				$nop=4;
			}
		redirect('admin/new_question_2/'.$nop.'/'.$para);
		}
		if($this->input->post('question_type')=='3'){
			$nop=$this->input->post('nop');
			if(!is_numeric($this->input->post('nop'))){
				$nop=4;
			}
		redirect('admin/new_question_3/'.$nop.'/'.$para);
		}
		if($this->input->post('question_type')=='4'){
			$nop=$this->input->post('nop');
			if(!is_numeric($this->input->post('nop'))){
				$nop=4;
			}
		redirect('admin/new_question_4/'.$nop.'/'.$para);
		}
				if($this->input->post('question_type')=='5'){
			$nop=$this->input->post('nop');
			if(!is_numeric($this->input->post('nop'))){
				$nop=4;
			}
		redirect('admin/new_question_5/'.$nop.'/'.$para);
		}

		}
		
		$this->load->view('admin/pre_new_question',$data);
	}

	public function new_question_1($nop='4',$para='0')
	{
		
				$data=$this->SiteModel->getSiteData();
	 	$data['title']="Add New Question";
$this->load->model("Blog");
			if($this->input->post('question')){
				 
				if($this->Blog->insert_question_1()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
				}
				if($this->input->post('parag')==1){
				redirect('admin/new_question_1/'.$nop.'/'.$para);
				}else{
				redirect('admin/pre_new_question/');
				}
			}
			if($this->session->flashdata('qid')){
			$data['qp']=$this->Blog->get_question($this->session->flashdata('qid'));
		
			}			
		 $data['para']=$para;	
		 $data['nop']=$nop;
		// fetching category list
		$data['category_list']=$this->Blog->category_list();
		// fetching level list
		$data['level_list']=$this->Blog->level_list();
		$this->load->view('admin/new_question_1',$data);
	}
	
	
	public function new_question_2($nop='4',$para='0')
	{
		
				$data=$this->SiteModel->getSiteData();
	 	$data['title']="Add New Question";
$this->load->model("Blog");

			if($this->input->post('question')){
				if($this->Blog->insert_question_2()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
				}
				if($this->input->post('parag')==1){
				redirect('admin/new_question_2/'.$nop.'/'.$para);
				}else{
				redirect('admin/pre_new_question/');
				}
			}
			if($this->session->flashdata('qid')){
			$data['qp']=$this->Blog->get_question($this->session->flashdata('qid'));
		
			}			
		 $data['para']=$para;	
		 $data['nop']=$nop;
		// fetching category list
		$data['category_list']=$this->Blog->category_list();
		// fetching level list
		$data['level_list']=$this->Blog->level_list();
		$this->load->view('admin/new_question_2',$data);
	}
	
	
	public function new_question_3($nop='4',$para='0')
	{
		

				$data=$this->SiteModel->getSiteData();
	 	$data['title']="Add New Question";
$this->load->model("Blog");

			if($this->input->post('question')){
				if($this->Blog->insert_question_3()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
				}
								if($this->input->post('parag')==1){
				redirect('admin/new_question_3/'.$nop.'/'.$para);
				}else{
				redirect('admin/pre_new_question/');
				}
			}
			if($this->session->flashdata('qid')){
			$data['qp']=$this->Blog->get_question($this->session->flashdata('qid'));
		
			}			
		 $data['para']=$para;	
		 $data['nop']=$nop;
		// fetching category list
		$data['category_list']=$this->Blog->category_list();
		// fetching level list
		$data['level_list']=$this->Blog->level_list();
		$this->load->view('admin/new_question_3',$data);
	}
	
	
		public function new_question_4($nop='4',$para='0')
	{
		

				$data=$this->SiteModel->getSiteData();
	 	$data['title']="Add New Question";
$this->load->model("Blog");

			if($this->input->post('question')){
				if($this->Blog->insert_question_4()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
				}
								if($this->input->post('parag')==1){
				redirect('admin/new_question_4/'.$nop.'/'.$para);
				}else{
				redirect('admin/pre_new_question/');
				}
			}
			if($this->session->flashdata('qid')){
			$data['qp']=$this->Blog->get_question($this->session->flashdata('qid'));
		
			}			
		 $data['para']=$para;	
		 $data['nop']=$nop;
		// fetching category list
		$data['category_list']=$this->Blog->category_list();
		// fetching level list
		$data['level_list']=$this->Blog->level_list();
		$this->load->view('admin/new_question_4',$data);
	}
	
	
			public function new_question_5($nop='4',$para='0')
	{

				$data=$this->SiteModel->getSiteData();
	 	$data['title']="Add New Question";
$this->load->model("Blog");
		

			if($this->input->post('question')){
				if($this->Blog->insert_question_5()){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_added_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_add_data')." </div>");
				}
								if($this->input->post('parag')==1){
				redirect('admin/new_question_5/'.$nop.'/'.$para);
				}else{
				redirect('admin/pre_new_question/');
				}
			}
			if($this->session->flashdata('qid')){
			$data['qp']=$this->Blog->get_question($this->session->flashdata('qid'));
		
			}			
		 $data['para']=$para;
		 $data['nop']=$nop;
		// fetching category list
		$data['category_list']=$this->Blog->category_list();
		// fetching level list
		$data['level_list']=$this->Blog->level_list();
		$this->load->view('admin/new_question_5',$data);
	}
	
		public function edit_question_1($qid)
		{

				$data=$this->SiteModel->getSiteData();
	 	$data['title']="Add New Question";
$this->load->model("Blog");

		
			if($this->input->post('question')){
				if($this->Blog->update_question_1($qid)){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
				}
				redirect('admin/edit_question_1/'.$qid);
			}			
			
		 
		 $data['title']=$this->lang->line('edit');
		// fetching question
		$data['question']=$this->Blog->get_question($qid);
		$data['options']=$this->Blog->get_option($qid);
		// fetching category list
		$data['category_list']=$this->Blog->category_list();
		// fetching level list
		$data['level_list']=$this->Blog->level_list();
		$this->load->view('admin/edit_question_1',$data);
	}
	
	
	public function edit_question_2($qid)
	{
		

				$data=$this->SiteModel->getSiteData();
	 	$data['title']="Add New Question";
$this->load->model("Blog");


			if($this->input->post('question')){
				if($this->Blog->update_question_2($qid)){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
				}
				redirect('admin/edit_question_2/'.$qid);
			}			
			
		 
		 $data['title']=$this->lang->line('edit');
		// fetching question
		$data['question']=$this->Blog->get_question($qid);
		$data['options']=$this->Blog->get_option($qid);
		// fetching category list
		$data['category_list']=$this->Blog->category_list();
		// fetching level list
		$data['level_list']=$this->Blog->level_list();
		$this->load->view('edit_question_2',$data);
	}
	
	
	public function edit_question_3($qid)
	{

				$data=$this->SiteModel->getSiteData();
	 	$data['title']="Add New Question";
$this->load->model("Blog");


		
			if($this->input->post('question')){
				if($this->Blog->update_question_3($qid)){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
				}
				redirect('admin/edit_question_3/'.$qid);
			}			
			
		  
		 $data['title']=$this->lang->line('edit');
		// fetching question
		$data['question']=$this->Blog->get_question($qid);
		$data['options']=$this->Blog->get_option($qid);
		// fetching category list
		$data['category_list']=$this->Blog->category_list();
		// fetching level list
		$data['level_list']=$this->Blog->level_list();
		$this->load->view('edit_question_3',$data);
	}
	
	
	function pre_question_list($limit='0',$cid='0',$lid='0'){
		$cid=$this->input->post('cid');
		$lid=$this->input->post('lid');
		redirect('admin/question_list/'.$limit.'/'.$cid.'/'.$lid);
	}
	
		public function edit_question_4($qid)
	{
		
				$data=$this->SiteModel->getSiteData();
	 	$data['title']="Add New Question";
$this->load->model("Blog");


			if($this->input->post('question')){
				if($this->Blog->update_question_4($qid)){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
				}
				redirect('admin/edit_question_4/'.$qid);
			}			
			
		 
		 $data['title']=$this->lang->line('edit');
		// fetching question
		$data['question']=$this->Blog->get_question($qid);
		$data['options']=$this->Blog->get_option($qid);
		// fetching category list
		$data['category_list']=$this->Blog->category_list();
		// fetching level list
		$data['level_list']=$this->Blog->level_list();
		$this->load->view('edit_question_4',$data);
	}
	
	
			public function edit_question_5($qid)
	{
		
				$data=$this->SiteModel->getSiteData();
	 	$data['title']="Add New Question";
$this->load->model("Blog");


			if($this->input->post('question')){
				if($this->Blog->update_question_5($qid)){
                $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('data_updated_successfully')." </div>");
				}else{
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_update_data')." </div>");
				}
				redirect('admin/edit_question_5/'.$qid);
			}			
			
		 
		 $data['title']=$this->lang->line('edit');
		// fetching question
		$data['question']=$this->Blog->get_question($qid);
		$data['options']=$this->Blog->get_option($qid);
		// fetching category list
		$data['category_list']=$this->Blog->category_list();
		// fetching level list
		$data['level_list']=$this->Blog->level_list();
		$this->load->view('edit_question_5',$data);
	}
	
public function question_list($limit='0',$cid='0',$lid='0')
{
		$data=$this->SiteModel->getSiteData();
		$data['title']="Exam Question List";
		$this->load->model("Blog");
		$this->load->library('pagination');	

	$this->load->helper('form');
			
			
			 $data['category_list']=$this->Blog->category_list();
		 $data['level_list']=$this->Blog->level_list();
		
		$data['limit']=$limit;
		$data['cid']=$cid;
		$data['lid']=$lid;
		 
		
		$data['title']=$this->lang->line('qbank');
		// fetching user list
		$data['result']=$this->Blog->question_list($limit,$cid,$lid);
		$this->load->view('admin/question_list',$data);


}

	public function remove_question($qid){

		$this->load->model("Blog");
			
			if($this->Blog->remove_question($qid)){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");
						
					}
					redirect('admin/question_list');
                     
			
		}
	


	// End Add Question
	
//quiz list

public function add_new_quiz()
	{

	$data=$this->SiteModel->getSiteData();
		$data['title']="Add New Quiz";
		$this->load->model("Blog");
	
				// redirect if not loggedin
		// if(!$this->session->userdata('logged_in')){
		// 	redirect('login');
			
		// }
		// $logged_in=$this->session->userdata('logged_in');
		// if($logged_in['base_url'] != base_url()){
		// $this->session->unset_userdata('logged_in');		
		// redirect('login');
		// }
		
		// 	$logged_in=$this->session->userdata('logged_in');
  //                       $acp=explode(',',$logged_in['quiz']);
		// 	if(!in_array('Add',$acp)){
		// 	exit($this->lang->line('permission_denied'));
		// 	}	
	 
		// fetching group list
		// $data['group_list']=$this->user_model->group_list();
		// $data['user_list']=$this->user_model->user_list_all();
		$this->load->view('admin/new_quiz',$data);
	}
	

		public function insert_quiz()
	{
				// redirect if not loggedin
		// if(!$this->session->userdata('logged_in')){
		// 	redirect('login');
			
		// }
		// $logged_in=$this->session->userdata('logged_in');
		// if($logged_in['base_url'] != base_url()){
		// $this->session->unset_userdata('logged_in');		
		// redirect('login');
		// }
		
	// $data=$this->SiteModel->getSiteData();
	// 	$data['title']="Add New Quiz";
		$this->load->model("Blog");
	 
	
	
		
			// $logged_in=$this->session->userdata('logged_in');
   //                      $acp=explode(',',$logged_in['quiz']);
			// if(!in_array('Add',$acp)){
			// exit($this->lang->line('permission_denied'));
			// }
			
			
			
		$this->load->library('form_validation');
		$this->form_validation->set_rules('quiz_name', 'quiz_name', 'required');
           if ($this->form_validation->run() == FALSE)
                {
                     $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
					redirect('admin/add_new/');
                }
                else
                {
					$quid=$this->Blog->insert_quiz();
                   $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('quiz_created')." </div>");
		  $this->session->set_flashdata('addquestion', "<div class='alert alert-success'>".$this->lang->line('quiz_created')." </div>");
					redirect('admin/edit_quiz/'.$quid);
                }       

	}

		public function edit_quiz($quid)
	{
				// redirect if not loggedin
			
			
		
	$data=$this->SiteModel->getSiteData();
		$data['title']="Edit Quiz";
		$this->load->model("Blog");
	 
		// fetching group list
		// $data['group_list']=$this->user_model->group_list();
		// $data['user_list']=$this->user_model->user_list_all();
		$data['quiz']=$this->Blog->get_quiz($quid);
		if($data['quiz']['question_selection']=='0'){
		$data['questions']=$this->Blog->get_questions($data['quiz']['qids']);
			 
		}else{
	   $data['qcl']=$this->Blog->get_qcl($data['quiz']['quid']);
		
			 $data['category_list']=$this->Blog->category_list();
		 $data['level_list']=$this->Blog->level_list();
		
		}
		$this->load->view('admin/edit_quiz',$data);
	}

	public function update_quiz($quid)
	{
	$data=$this->SiteModel->getSiteData();
		$data['title']="Edit Exam";
		$this->load->model("Blog");

				// redirect if not loggedin

		// if(!$this->session->userdata('logged_in')){
		// 	redirect('login');
			
		// }
		// $logged_in=$this->session->userdata('logged_in');
		// if($logged_in['base_url'] != base_url()){
		// $this->session->unset_userdata('logged_in');		
		// redirect('login');
		// }
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('quiz_name', 'quiz_name', 'required');
           if ($this->form_validation->run() == FALSE)
                {
                     $this->session->set_flashdata('message', "<div class='alert alert-danger'>".validation_errors()." </div>");
					redirect('admin/edit_quiz/'.$quid);
                }
                else
                {
					$quid=$this->Blog->update_quiz($quid);
                   
					redirect('admin/edit_quiz/'.$quid);
                }       

	}
	
		public function add_question($quid,$limit='0',$cid='0',$lid='0')
	{
				// redirect if not loggedin
		$this->load->model("Blog");
	   
		
			$data=$this->SiteModel->getSiteData();
		$data['title']="Add Question to Exam";
	
			
	 
		 $data['quiz']=$this->Blog->get_quiz($quid);
		$data['title']=$this->lang->line('add_question_into_quiz').': '.$data['quiz']['quiz_name'];
		if($data['quiz']['question_selection']=='0'){
		
		$data['result']=$this->Blog->question_list($limit,$cid,$lid);
		 $data['category_list']=$this->Blog->category_list();
		 $data['level_list']=$this->Blog->level_list();
			 
		}else{
			
			exit($this->lang->line('permission_denied'));
		}
		$data['limit']=$limit;
		$data['cid']=$cid;
		$data['lid']=$lid;
		$data['quid']=$quid;
		
		$this->load->view('admin/add_question_into_quiz',$data);
	}
	
	
	
	function add_qid($quid,$qid){
				// redirect if not loggedin
		$this->load->model("Blog");
	  	
		 $this->Blog->add_qid($quid,$qid);
          echo 'added';              
	}


	public function remove_quiz($quid){
			
			if($this->Blog->remove_quiz($quid)){
                        $this->session->set_flashdata('message', "<div class='alert alert-success'>".$this->lang->line('removed_successfully')." </div>");
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_remove')." </div>");
						
					}
					redirect('admin/exam_list');
                     
			
		}
	

		public function exam_list($limit='0',$list_view='grid',$stat='')
	{
		
		
			$data=$this->SiteModel->getSiteData();
		$data['title']="Add Question to Exam";
		$this->load->model("Blog");
	

		// redirect if not loggedin
		
		
		 	
			//             $setting_p=explode(',',$logged_in['quiz']);
			// if(in_array('List',$setting_p) || in_array('List_all',$setting_p)){
			
			// }else{
			// exit($this->lang->line('permission_denied'));
			// }
			 
			
			
		$data['list_view']=$list_view;
		$data['limit']=$limit;
		$data['title']=$this->lang->line('quiz');
		// fetching quiz list
		// $data['purchased_quiz']=$this->quiz_model->get_purchased_quiz();
		$data['result']=$this->Blog->quiz_list($limit,$stat);
	 	$data['archived']=$this->Blog->quizstat('archived');
		$data['active']=$this->Blog->quizstat('active');
		$data['upcoming']=$this->Blog->quizstat('upcoming');
		 $data['stat']=$stat;
		$this->load->view('admin/quiz_list',$data);
	}
	

	


	public function postBlog()
	{
		
		if(!checksessionAdmin()){
		responseGenerate(2,"Please login to continue");
		}
			$title=trim($this->input->post('title'));
			$permalink=format_uri($title);
			
			
			$description=trim($this->input->post('description'));
			$tags=strip_tags(trim($this->input->post('tags')));
			    $config['upload_path']          = './images/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2000;
                $config['max_width']            = 2000;
                $config['max_height']           = 2000;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('thumbnail'))
                {
				
                        $error = array('error' => $this->upload->display_errors());

                        echo "file not upload";
                }
                else
                {
					
                        $data = $this->upload->data();
						$image = $data['file_name'];
					
                }
				
				$immg=$image;
		
				$config['upload_path']          = './images/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 1024;
                $config['max_width']            = 1024;
                $config['max_height']           = 2000;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile'))
                {
				
                        $error = array('error' => $this->upload->display_errors());

                        echo "file not upload";
                }
                else
                {
					
                        $data = $this->upload->data();
						$mainimage = $data['file_name'];
					
					
                }

			
			
			$m=date("Y-m-d");
			
			
			$userid=getuserid();
			$this->App_model->insert('Blog',['blog_title'=>$title,'permalink'=>$permalink,'tags'=>$tags,'blog_description'=>$description,'thumbnail'=>$immg,'main_image'=>$mainimage,'blog_date'=>$m,],$batch=false);
			redirect("/Admin/blog"); 
		
	}
	public function blog_posted(){
		$data=$this->SiteModel->getSiteData();
		$data['title']="Answiz";
		$this->load->model("Blog");
		$this->load->library('pagination');	
		$config = array();
        $config["base_url"] = base_url() . "blogs";
        $config["total_rows"] = $this->Blog->get_count();
        $config["per_page"] = 3;
        $config["uri_segment"] =1;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
		$this->load->model('BLOG');
        $data["blog"] = $this->BLOG->get_posts($config["per_page"], $page);
        $this->load->view('pages-blog',$data);
	}
	public function blogs_posted(){
		$data=$this->SiteModel->getSiteData();
		$data['title']="Answiz";
		$this->load->model("Blog");
		$r=$this->Blog->blog();
		$data['blog']=$r;
		$this->load->view('admin/editblog',$data);
	}
	public function blog_details($b,$id){
		
		$data=$this->SiteModel->getSiteData();
		$data['title']="Ask";
		$this->load->model("Blog");
		$r=$this->Blog->blogs($id);
		$data['blog']=$r;
		$f=$this->Blog->comments($id);
		$data['count']=count($f);
		$data['comments']=$f;
		$rel=$this->Blog->related($b);
        $data['related']=$rel;
		
		$this->load->view('blog-post',$data);
	}
	public function categories()
	{
		
		$categories=$this->App_model->getData('categories',$resultType="all_array",$arg=['select'=>['COUNT(questions.qid) as totalPosts','categories.name as catname','categories.permalink','categories.description','categories.catid'],'group'=>['col'=>'categories.catid'],'join'=>['table'=>'questions','query'=>'categories.catid=questions.catid','type'=>'left'],'order'=>['col'=>'totalPosts','type'=>'desc']]);
		$totalCategories=$this->App_model->getData('categories',$resultType="count",$arg=['where'=>['status'=>1]]);
		$data=$this->SiteModel->getSiteData();
		$data['title']="Categories";
		$data['totalCategories']=$totalCategories;
		$data['fetchedCategories']=count($categories);
		$data['categories']=$categories;
		$this->load->view('admin/categories',$data);
	}
	
	
	public function subcategories()
	{
		$categories=$this->App_model->getData('categories',$resultType="all_array",$arg=['select'=>['COUNT(questions.qid) as totalPosts','categories.name as catname','categories.permalink','categories.description','categories.catid'],'group'=>['col'=>'categories.catid'],'join'=>['table'=>'questions','query'=>'categories.catid=questions.catid','type'=>'left'],'order'=>['col'=>'totalPosts','type'=>'desc']]);
		$totalCategories=$this->App_model->getData('categories',$resultType="count",$arg=['where'=>['status'=>1]]);
		
		$scategories=$this->App_model->getData('subcategories',$resultType="all_array",$arg=['select'=>['subcategories.name as catname','subcategories.permalink','subcategories.description','subcategories.catid','subcategories.scatid'],'group'=>['col'=>'subcategories.scatid'],'join'=>['table'=>'categories','query'=>'subcategories.scatid=categories.catid','type'=>'left'],'order'=>['col'=>'categories.name','type'=>'desc']]);
		$totalsCategories=$this->App_model->getData('subcategories',$resultType="count",$arg=['where'=>['status'=>1]]);
		$data=$this->SiteModel->getSiteData();
		
		$data['title']="SubCategories";
		$data['totalCategories']=$totalCategories;
		$data['fetchedCategories']=count($categories);
		$data['categories']=$categories;
		$data['totalsCategories']=$totalsCategories;
		$data['fetchedsCategories']=count($categories);
		$data['scategories']=$scategories;
		$this->load->view('admin/SubCategories',$data);
	}
	
	
	public function loadLogin()
	{
		if (checksessionAdmin()) {
			redirect('admin');
		}
		$getSettings=$this->App_model->getData('siteSettings',$resultType="row_array",$arg=['select'=>['siteName']]);
		$data['siteSettings']=$getSettings; 
		$this->load->view('admin/login',$data);
	}
	public function loadSettings()
	{
		if (!checksessionAdmin()) {
			redirect('admin/login');
		}
		$getSettings=$this->App_model->getData('siteSettings',$resultType="row_array",$arg=[]);
		$data['siteSettings']=$getSettings;
		$admin=$this->App_model->getData('admin',$resultType="row_array",$arg=['select'=>['email']]);
		$data['admin']=$admin; 
		$data['title']="Site Settings";
		$this->load->view('admin/settings',$data);
	}
	public function loadDashboard()
	{
		if (!checksessionAdmin()) {
			redirect('admin/login');
		}
		$getSettings=$this->App_model->getData('siteSettings',$resultType="row_array",$arg=[]);
		$totalQuestions=$this->App_model->getData('questions',$resultType="count_array",$arg=[]);
		$totalAnswers=$this->App_model->getData('awnsers',$resultType="count_array",$arg=[]);
		$totalQuestionsToday=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>'on >= CURDATE() AND on < CURDATE() + INTERVAL 1 DAY']);
		$totalUsers=$this->App_model->getData('users',$resultType="count_array",$arg=[]);
		$questionsRecord=$this->App_model->getData('questions',$resultType="all_array",$arg=['select'=>['on',"count('on') as totalQuestions"],'group'=>['col'=>"DATE(`on`)"],'limit'=>[30,0],'order'=>['col'=>'on','type'=>'asc']]);
		
		$recentlyPostedQuestions=$this->App_model->getData('questions',$resultType="all_array",$arg=['select'=>['qid','title','permalink','status','on'],'order'=>['col'=>'on','type'=>'desc'],'limit'=>[10,0]]);
		
		$data['totalQuestions']=$totalQuestions;
		$data['totalQuestionsToday']=$totalQuestionsToday;
		$data['totalAnswers']=$totalAnswers;
		$data['totalUsers']=$totalUsers;
		$data['recentlyPostedQuestions']=$recentlyPostedQuestions;
		$data['siteSettings']=$getSettings;
		$data['questionsRecord']=$questionsRecord;
		$data['tquestionsRecord']=is_array($questionsRecord);
		$data['title']="Dashboard";
		$this->load->view('admin/dashboard',$data);
	}
	public function loadUsers($page)
	{
		if(!checksessionAdmin())
		redirect('admin/login');
		$perPage=20;
		$cpage=(int) secureInput($page);
		
		$usersTotal=$this->App_model->getData('users',$resultType="count_array",$arg=[]);
		$users=$this->App_model->getData('users',$resultType="all_array",$arg=['limit'=>[$perPage,$cpage],'order'=>['col'=>'on','type'=>'desc']]);
		$getSettings=$this->App_model->getData('siteSettings',$resultType="row_array",$arg=[]);
		
		$this->load->library('pagination');
		
		$this->pagination->initialize($this->getConfigPagination($usersTotal,$perPage,"admin/users",$segment=3));
		$pagination=$this->pagination->create_links();
		
		$data['siteSettings']=$getSettings;
		$data['users']=$users;
		$data['pagination']=$pagination; 
		$data['title']="Site Users";
		$this->load->view('admin/users',$data);
	}
	
	public function loadReportedAnswers($page)
	{
		if(!checksessionAdmin())
		redirect('admin/login');
		$perPage=10;
		$cpage=(int) secureInput($page);
		$reportedAnswersTotal=$this->App_model->getData('reportedAnswers',$resultType="count_array",$arg=[]);
		$this->load->model('AdminModel');
		$reportedAnswers=$this->AdminModel->getReportedAnswers($perPage,$cpage);
		
		$getSettings=$this->App_model->getData('siteSettings',$resultType="row_array",$arg=[]);
		
		$this->load->library('pagination');
		
		$this->pagination->initialize($this->getConfigPagination($reportedAnswersTotal,$perPage,"admin/reported/answers",$segment=4));
		$pagination=$this->pagination->create_links();
		
		$data['siteSettings']=$getSettings;
		$data['reportedAnswers']=$reportedAnswers;
		$data['pagination']=$pagination; 
		$data['title']="Reported Answers";
		$this->load->view('admin/reportedAnswers',$data);
	}
	
	public function loadReportedAnswersReplies($page)
	{
		if(!checksessionAdmin())
		redirect('admin/login');
		$perPage=10;
		$cpage=(int) secureInput($page);
		$reportedAnswersRepliesTotal=$this->App_model->getData('reportedReplies',$resultType="count_array",$arg=['where'=>['arid!='=>null]]);
		
		$this->load->model('AdminModel');
		$getReportedAnswersReplies=$this->AdminModel->getReportedAnswersReplies($perPage,$cpage);
		
		$getSettings=$this->App_model->getData('siteSettings',$resultType="row_array",$arg=[]);
		$this->load->library('pagination');
		
		$this->pagination->initialize($this->getConfigPagination($reportedAnswersRepliesTotal,$perPage,"admin/reported/answers/replies",$segment=5));
		$pagination=$this->pagination->create_links();
		
		$data['siteSettings']=$getSettings;
		$data['getReportedAnswersReplies']=$getReportedAnswersReplies;
		$data['pagination']=$pagination; 
		$data['title']="Reported Answer's Replies";
		$this->load->view('admin/getReportedAnswersReplies',$data);
	}
	
	public function loadReportedQuestionsReplies($page)
	{
		if(!checksessionAdmin())
		redirect('admin/login');
		$perPage=10;
		$cpage=(int) secureInput($page);
		$reportedQuestionRepliesTotal=$this->App_model->getData('reportedReplies',$resultType="count_array",$arg=['where'=>['qrid!='=>null]]);
		
		$this->load->model('AdminModel');
		$getReportedQuestionReplies=$this->AdminModel->getReportedQuestionReplies($perPage,$cpage);
		
		$getSettings=$this->App_model->getData('siteSettings',$resultType="row_array",$arg=[]);
		
		$this->load->library('pagination');
		
		$this->pagination->initialize($this->getConfigPagination($reportedQuestionRepliesTotal,$perPage,"admin/reported/questions/replies",$segment=5));
		$pagination=$this->pagination->create_links();
		
		$data['siteSettings']=$getSettings;
		$data['getReportedQuestionReplies']=$getReportedQuestionReplies;
		$data['pagination']=$pagination; 
		$data['title']="Reported Question Replies";
		$this->load->view('admin/getReportedQuestionReplies',$data);
	}
	
	public function logout()
	{
		unset($_SESSION['emailAdmin']); 
		redirect('admin');
	}
	public function loadQuestions($page)
	{
		if (!checksessionAdmin()) {
			redirect('login');
		}
		$perPage=20;
		$cpage=(int) secureInput($page);
		
		$questionsTotal=$this->App_model->getData('questions',$resultType="count_array",$arg=[]);
		
		$questions=$this->App_model->getData('questions',$resultType="all_array",$arg=['limit'=>[$perPage,$cpage],'order'=>['col'=>'on','type'=>'desc']]);
		$this->load->library('pagination');
		
		$this->pagination->initialize($this->getConfigPagination($questionsTotal,$perPage,"admin/questions",$segment=3));
		$pagination=$this->pagination->create_links();
		$getSettings=$this->App_model->getData('siteSettings',$resultType="row_array",$arg=[]);
		$data['siteSettings']=$getSettings;
		$data['getQuestions']=$questions; 
		$data['pagination']=$pagination; 
		$data['title']="Questions Posted";
		$this->load->view('admin/questions',$data);
	}
	public function getConfigPagination($totalRecord,$perPage,$url,$segment)
	{
		$config['base_url'] = base_url().$url;
		$config['total_rows'] = $totalRecord;
		$config['per_page'] = $perPage;
		$config['uri_segment'] = $segment;
		$config['first_link'] = 'First';
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '<li>';
		$config['cur_tag_open'] = '<li class="active"><a><strong>';
		$config['cur_tag_close'] = '</strong></a></li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		return $config;
	}
	public function login()
	{
		if (checksessionAdmin()) {
			responseGenerate(2,"You are already logined");
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == true) {
			$email=secureInput($this->input->post('email'));
			$password=trim($this->input->post('password'));
			// echo sha1($password);
			$checkAccount=$this->App_model->getData('admin',$resultType="row_array",$arg=['where'=>['email'=>$email,'password'=>sha1($password)]]);
			
		if (empty($checkAccount)) {
				responseGenerate(0,"Invalid email or password,Please Check it ");
			}
			$this->session->emailAdmin=$email;
			responseGenerate(1,"Admin Successfully Login");
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}
	public function postUpdateAdminSettings()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Your session is expired");
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('adminEmail', 'Email', 'required|valid_email|max_length[100]');
		$this->form_validation->set_rules('adminPrevPassword', 'Previuos Password', 'required');
		
		if ($this->form_validation->run() == true) {
			$adminEmail=secureInput($this->input->post('adminEmail'));
			$adminPrevPassword=trim($this->input->post('adminPrevPassword'));
			$checkAccount=$this->App_model->getData('admin',$resultType="row_array",$arg=['where'=>['password'=>sha1($adminPrevPassword)]]);
			if(count($checkAccount)==0) {
				responseGenerate(0,"Invalid previous password");
			}
			$adminNewPassword=trim($this->input->post('adminNewPassword'));
			$updateAdmin=['email'=>$adminEmail];
			if(strlen($adminNewPassword)>0) {
				$updateAdmin['password']=sha1($adminNewPassword);
			}
			$this->App_model->updateData('admin',$updateAdmin);
			responseGenerate(1,"Admin settings was successfully updated");
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}
	function postUpdateSiteLogo(){
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		
		if (isset($_FILES['image'])) {
			if ($_FILES['image']['error']==0) {
				$name=$_FILES['image']['name'];
				$file_ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
				$genfileName=md5($name.uniqid()).".".$file_ext;
				$siteRoot= realpath(dirname(__FILE__));
				move_uploaded_file($_FILES['image']['tmp_name'],"./images/".$genfileName);
				$getSettings=$this->App_model->getData('siteSettings',$resultType="row_array",$arg=['select'=>['logo']]);
				$this->App_model->updateData('siteSettings',['logo'=>$genfileName]);
				$logoP=$getSettings['logo'];
				if(file_exists("./images/".$logoP))
				unlink("./images/".$logoP);
				responseGenerate(1,"Logo was successfully saved");
			} else {
				responseGenerate(2,"This file is corrupted , Please chose another");
			}
		} else {
			responseGenerate(2,"Please choose an image to upload");
		}
	}
	
	public function postUpdateSiteSettings()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		$fb=secureInput($this->input->post('fb'));
		$gp=secureInput($this->input->post('gp'));
		$db=secureInput($this->input->post('db'));
		$tw=secureInput($this->input->post('tw'));
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('siteName', 'Site Name', 'required|max_length[100]');
		$this->form_validation->set_rules('siteTags', 'Site Tags', 'max_length[100]');
		 
		if (strlen($fb)>0)
		$this->form_validation->set_rules('fb', 'Facebook social link', 'max_length[200]|callback_valid_url');
		if (strlen($gp)>0)
		$this->form_validation->set_rules('gp', 'Google plus social link', 'max_length[200]|callback_valid_url');
		if (strlen($db)>0)
		$this->form_validation->set_rules('db', 'Dribble social link', 'max_length[200]|callback_valid_url');
		if (strlen($tw)>0)
		$this->form_validation->set_rules('tw', 'Twitter social link', 'max_length[200]|callback_valid_url');
		
		$this->form_validation->set_rules('smtpUsername', 'SMTP Username', 'max_length[200]');
		$this->form_validation->set_rules('smtpPassword', 'SMTP Password', 'max_length[200]');
		
		if ($this->form_validation->run() == true) {
			$siteName=secureInput($this->input->post('siteName'));
			$siteTags=secureInput($this->input->post('siteTags'));
			$adminApproveQuestions=secureInput($this->input->post('adminApproveQuestions'));
			$googleAnalyticsCode=(trim($this->input->post('googleAnalyticsCode')));
			$fbAppId=secureInput($this->input->post('fbAppId'));
			$fbAppSecet=secureInput($this->input->post('fbAppSecet'));
			$googleAppId=secureInput($this->input->post('googleAppId'));
			$googleAppSecret=secureInput($this->input->post('googleAppSecret'));
			$description=encodeContent(trim($this->input->post('description')));
			$smtpUsername=secureInput($this->input->post('smtpUsername'));
			$smtpPassword=secureInput($this->input->post('smtpPassword'));
			$imgurClientId=secureInput($this->input->post('imgurClientId'));
			$this->App_model->updateData('siteSettings',['smtpUsername'=>$smtpUsername,'smtpPassword'=>$smtpPassword,'imgurClientId'=>$imgurClientId,'adminApproveQuestions'=>$adminApproveQuestions,'googleAnalyticsCode'=>$googleAnalyticsCode,'fbAppId'=>$fbAppId,'fbAppSecet'=>$fbAppSecet,'googleAppId'=>$googleAppId,'googleAppSecret'=>$googleAppSecret,'facebookLink'=>$fb,'googleLink'=>$gp,'twitterLink'=>$db,'dribbleLink'=>$tw,'siteName'=>$siteName,'tags'=>$siteTags,'description'=>$description]);
			responseGenerate(1,"Site settings was successfully updated");
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}
	
	public function postUpdateAdsSiteSettings()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		
		$bannerAd=trim($this->input->post('bannerAd'));
		$sidebarAd=trim($this->input->post('sidebarAd'));
		
		$bannerAdEnable=secureInput($this->input->post('bannerAdEnable'));
		$sidebarAdEnable=secureInput($this->input->post('sidebarAdEnable'));
		
		$this->App_model->updateData('siteSettings',['bannerAdEnable'=>$bannerAdEnable,'sidebarAdEnable'=>$sidebarAdEnable,'bannerAd'=>$bannerAd,'sidebarAd'=>$sidebarAd]);
		responseGenerate(1,"Ad settings was successfully updated");
	}
	
	public function postModeratorAction()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		
		$userid=secureInput($this->input->post('userid'));
		$checkUser=$this->App_model->getData('users',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		if ($checkUser==0) {
			responseGenerate(2,"Invalid user posted");
		}
		
		$action=(secureInput($this->input->post('action')));
		$action=$action==0?1:2;
		$this->App_model->updateData('users',['role'=>$action],['userid'=>$userid]);
		
		responseGenerate(1,"Successfully updated");
	}
	
	public function postAppBlockAction()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		
		$userid=secureInput($this->input->post('userid'));
		$checkUser=$this->App_model->getData('users',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		if ($checkUser==0) {
			responseGenerate(2,"Invalid user posted");
		}
		
		$action=(secureInput($this->input->post('action')));
		$action=$action==0?$action:1;
		$this->App_model->updateData('users',['status'=>$action],['userid'=>$userid]);
		
		responseGenerate(1,"Successfully updated");
	}
	
	public function postDeleteUser()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		$userid=secureInput($this->input->post('userid'));
		$checkUser=$this->App_model->getData('users',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
		if ($checkUser==0) {
			responseGenerate(2,"Invalid user posted");
		}
		$this->App_model->deleteData('users',$where=['userid'=>$userid]);
		responseGenerate(1,"Successfully deleted");
	}
	
	public function postInsertCategories()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Your session is expired");
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required|max_length[50]');
		$this->form_validation->set_rules('permalink','permalink','required|max_length[30]');
		$this->form_validation->set_rules('description','description','required');
		$this->form_validation->set_rules('status','status','required');
		if ($this->form_validation->run() == true) {
			$name=secureInput($this->input->post('name'));
			$permalink=trim($this->input->post('permalink'));
			$description=trim($this->input->post('description'));
			$status=trim($this->input->post('status'));
			
			$insertCategory=['name'=>$name];
			$insertCategory=['permalink'=>$permalink];
			$insertCategory=['description'=>$description];
			$insertCategory=['status'=>$status];
			
			
			$this->App_model->insert('categories',['name'=>$name,'permalink'=>$permalink,'description'=>$description,'status'=>$status],$batch=false);
			
			responseGenerate(1,"Category Added Successfully");
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
		
		
	}
	public function postInsertSubCategories()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Your session is expired");
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required|max_length[50]');
		$this->form_validation->set_rules('sname', 'name', 'required|max_length[50]');
		$this->form_validation->set_rules('permalink','permalink','required|max_length[30]');
		$this->form_validation->set_rules('description','description','required');
		$this->form_validation->set_rules('status','status','required');
		if ($this->form_validation->run() == true) {
			$name=secureInput($this->input->post('name'));
			$sname=secureInput($this->input->post('sname'));
			$permalink=trim($this->input->post('permalink'));
			$description=trim($this->input->post('description'));
			$status=trim($this->input->post('status'));
			
			// $insertCategory=['catid'=>$name];
			// $insertCategory=['sname'=>$sname];
			// $insertCategory=['permalink'=>$permalink];
			// $insertCategory=['description'=>$description];
			// $insertCategory=['status'=>$status];
			
			
			$this->App_model->insert('subcategories',['catid'=>$name,'name'=>$sname,'permalink'=>$permalink,'description'=>$description,'status'=>$status],$batch=false);
			
			responseGenerate(1,"Sub Category Added Successfully");
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
		
		
	}
	public function postUpdateCategories()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Your session is expired");
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required|max_length[50]');
		$this->form_validation->set_rules('permalink','permalink','required|max_length[30]');
		$this->form_validation->set_rules('description','description','required');
		if ($this->form_validation->run() == true) {
			$name=secureInput($this->input->post('name'));
			$permalink=secureInput($this->input->post('permalink'));
			$description=secureInput($this->input->post('description'));
			$catid=trim($this->input->post('catid'));
			$data['name']=$name;
			$data['permalink']=$permalink;
			$data['description']=$description;
			
			$this->App_model->updateData('categories',$data,$where=['catid'=>$catid]);
			
		
			responseGenerate(1,"Category Updated successfully");
		} else {
			responseGenerate(0,validation_errors('<p>problem</p>'));
		}
		
	}
	public function postUpdatesubCategories()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Your session is expired");
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required|max_length[50]');
		$this->form_validation->set_rules('permalink','permalink','required|max_length[30]');
		$this->form_validation->set_rules('description','description','required');
		if ($this->form_validation->run() == true) {
			$name=secureInput($this->input->post('name'));
			$permalink=secureInput($this->input->post('permalink'));
			$description=secureInput($this->input->post('description'));
			$catid=trim($this->input->post('catid'));
			$data['name']=$name;
			$data['permalink']=$permalink;
			$data['description']=$description;
			
			$this->App_model->updateData('subcategories',$data,$where=['scatid'=>$catid]);
			
		
			responseGenerate(1,"SubCategory Updated successfully");
		} else {
			responseGenerate(0,validation_errors('<p>problem</p>'));
		}
		
	}
	
	public function postUpdateBlogs()
	{ 
	
	if(!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		
		$blog_title=secureInput($this->input->post('blog_title'));
        $blog_description=secureInput($this->input->post('Description'));
		
        $thumbnailimage=secureInput($this->input->post('thumbnailimage'));
        $mainimages=secureInput($this->input->post('mainimages'));
		$tags=secureInput($this->input->post('tags'));
		$id=secureInput($this->input->post('id'));
		
		
		if(isset($_FILES['thumbnail']) && isset($_FILES['BlogImage'])) {
			
				
				$name=$_FILES['thumbnail']['name'];
				$name1=$_FILES['BlogImage']['name'];
				
				$file_ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
				$genfileName=md5($name.uniqid()).".".$file_ext;
				$siteRoot= realpath(dirname(__FILE__));
				move_uploaded_file($_FILES['thumbnail']['tmp_name'],"./images/".$genfileName);
				
				$file_ext1 = strtolower(pathinfo($name1, PATHINFO_EXTENSION));
				$genfileName1=md5($name1.uniqid()).".".$file_ext1;
				$siteRoot1= realpath(dirname(__FILE__));
				move_uploaded_file($_FILES['BlogImage']['tmp_name'],"./images/".$genfileName1);
				 $thumbnail= $name;
				 $main_image= $name1;
				
        
		        
		        $this->App_model->updateData('Blog',['blog_title'=>$blog_title,'blog_description'=>$blog_description,'thumbnail'=>$thumbnail,'main_image'=>$main_image,'tags'=>$tags],['id'=>$id]);

				responseGenerate(1,"Favicon was successfully saved");
			
		}
		
		else if(isset($_FILES['thumbnail'])) {
			
				
				$name=$_FILES['thumbnail']['name'];
				$name1=$mainimages;
				
				$file_ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
				$genfileName=md5($name.uniqid()).".".$file_ext;
				$siteRoot= realpath(dirname(__FILE__));
				move_uploaded_file($_FILES['thumbnail']['tmp_name'],"./images/".$genfileName);
				 $thumbnail= $name;
				 $main_image= $name1;
				
        
		        
		        $this->App_model->updateData('Blog',['blog_title'=>$blog_title,'blog_description'=>$blog_description,'thumbnail'=>$thumbnail,'main_image'=>$main_image,'tags'=>$tags],['id'=>$id]);

				responseGenerate(1,"Post was successfully saved");
			
		}
		
		else if(isset($_FILES['BlogImage'])) {
			
				
				$name=thumbnailimage;
				$name1=$_FILES['BlogImage']['name'];
				
				$file_ext1 = strtolower(pathinfo($name1, PATHINFO_EXTENSION));
				$genfileName1=md5($name1.uniqid()).".".$file_ext1;
				$siteRoot1= realpath(dirname(__FILE__));
				move_uploaded_file($_FILES['BlogImage']['tmp_name'],"./images/".$genfileName1);
				 $thumbnail= $name;
				 $main_image= $name1;
				
        
		        
		        $this->App_model->updateData('Blog',['blog_title'=>$blog_title,'blog_category'=>$BlogCategory,'blog_description'=>$blog_description,'thumbnail'=>$thumbnail,'main_image'=>$main_image,'tags'=>$tags],['id'=>$id]);

				responseGenerate(1,"Post was successfully saved");
			
		}
		
		
		
		else {
			
		$this->App_model->updateData('Blog',['blog_title'=>$blog_title,'blog_description'=>$blog_description,'thumbnail'=>$thumbnailimage,'main_image'=>$mainimages,'tags'=>$tags],['id'=>$id]);
		$this->App_model->updateData('Blog',['blog_title'=>$blog_title,'blog_description'=>$blog_description,'thumbnail'=>$thumbnailimage,'main_image'=>$mainimages,'tags'=>$tags],['id'=>$id]);
		responseGenerate(4,"Post was successfully updated");
	            
			
		}
		
		    

	}
	public function postEditCategory()
	{
	
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		
		$catid=secureInput($this->input->post('catid'));
		
		$data=$this->App_model->getData('categories',$resultType="row_array",$arg=['where'=>['catid'=>$catid]]);
	 
	  echo json_encode($data);
	}
	public function postEditsubCategory()
	{
	
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		
		$catid=secureInput($this->input->post('catid'));
		
		$data=$this->App_model->getData('subcategories',$resultType="row_array",$arg=['where'=>['scatid'=>$catid]]);
	 
	  echo json_encode($data);
	}
	
	public function postEditBlog()
	{
	
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		
		$catid=secureInput($this->input->post('catid'));
		
		$data=$this->App_model->getData('Blog',$resultType="row_array",$arg=['where'=>['id'=>$catid]]);
	 
	  echo json_encode($data);
	}
	
	public function postDeleteCategory()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		$catid=secureInput($this->input->post('catid'));
		$checkCategory=$this->App_model->getData('categories',$resultType="count_array",$arg=['where'=>['catid'=>$catid]]);
		
		if ($checkCategory==0) {
			responseGenerate(2,"Invalid Category posted");
		}
		$this->App_model->deleteData('categories',$where=['catid'=>$catid]);
		responseGenerate(1,"Successfully deleted");
	}
	public function postDeletesubCategory()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		$catid=secureInput($this->input->post('catid'));
		$checkCategory=$this->App_model->getData('subcategories',$resultType="count_array",$arg=['where'=>['scatid'=>$catid]]);
		
		if ($checkCategory==0) {
			responseGenerate(2,"Invalid subCategory posted");
		}
		$this->App_model->deleteData('subcategories',$where=['scatid'=>$catid]);
		responseGenerate(1,"Successfully deleted");
	}
	public function postDelBlog()
	{
		
		if (!checksessionAdmin())
		responseGenerate(2,"Please login to continue");
	
		$qid=(int) secureInput($this->input->post('catid'));
	
		
		$where=['id'=>$qid];
		$this->App_model->deleteData('Blog',$where);
		responseGenerate(1,"Blog was successfully deleted");
	}
	public function postDeleteQuestion()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		$qid=($this->input->post('qid'));
		$checkQuestion=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['qid'=>$qid]]);
		if ($checkQuestion==0) {
			responseGenerate(2,"Invalid question posted");
		}
		
		$this->App_model->deleteData('questions',$where=['qid'=>$qid]);
		responseGenerate(1,"Successfully deleted");
	}
	public function postDeleteAnswer()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		$qaid=($this->input->post('qaid'));
		$checkAnswer=$this->App_model->getData('awnsers',$resultType="count_array",$arg=['where'=>['qaid'=>$qaid]]);
		if ($checkAnswer==0) {
			responseGenerate(2,"Invalid answer posted");
		}
		
		$this->App_model->deleteData('awnsers',$where=['qaid'=>$qaid]);
		responseGenerate(1,"Successfully deleted");
	}
	public function postDeleteAnswerReply()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		$reportRId=($this->input->post('reportRId'));
		$checkAnswer=$this->App_model->getData('reportedReplies',$resultType="count_array",$arg=['where'=>['reportRId'=>$reportRId]]);
		if ($checkAnswer==0) {
			responseGenerate(2,"Invalid answer reply posted");
		}
		
		$this->App_model->deleteData('reportedReplies',$where=['reportRId'=>$reportRId]);
		responseGenerate(1,"Successfully deleted");
	}
	public function postDeleteQuestionReply()
	{
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		$reportRId=($this->input->post('reportRId'));
		$checkAnswer=$this->App_model->getData('reportedReplies',$resultType="row_array",$arg=['where'=>['reportRId'=>$reportRId]]);
		if ($checkAnswer==0) {
			responseGenerate(2,"Invalid question reply posted");
		}
		
		$this->App_model->deleteData('reportedReplies',$where=['reportRId'=>$reportRId]);
		responseGenerate(1,"Successfully deleted");
	}
	public function postQuestionBlockAction()
	{
		if(!checksessionAdmin())
		responseGenerate(2,"Please login to continue");
		
		$qid=(trim($this->input->post('qid')));
		$checkQuestions=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['qid'=>$qid]]);
		if($checkQuestions==0)
		{
			responseGenerate(2,"Invalid question posted");
		}
		
		$action=(trim($this->input->post('action')));
		$action=$action==0?$action:1;
		
		$this->App_model->updateData('questions',['status'=>$action],['qid'=>$qid]);
		
		responseGenerate(1,"Successfully updated");
	}
	function postUpdateSiteFavicon(){
		if(!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		
		if(isset($_FILES['image'])) {
			if($_FILES['image']['error']==0) {
				$name=$_FILES['image']['name'];
				$file_ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
				$genfileName=md5($name.uniqid()).".".$file_ext;
				$siteRoot= realpath(dirname(__FILE__));
				move_uploaded_file($_FILES['image']['tmp_name'],"./images/".$genfileName);
				$getSettings=$this->App_model->getData('siteSettings',$resultType="row_array",$arg=['select'=>['favicon']]);
				
				$this->App_model->updateData('siteSettings',['favicon'=>$genfileName]);
				
				$faviconP=$getSettings['favicon'];
				if(file_exists("./images/".$faviconP))
				unlink("./images/".$faviconP);
			
				responseGenerate(1,"Favicon was successfully saved");
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
	public function postJobs()
	{
		$data=$this->SiteModel->getSiteData();
		$data['title']="Ask";
		$this->load->view('admin/postJob',$data);
	}
		public function postedJob()
	{
		
		if(!checksessionAdmin())
		responseGenerate(2,"Please login to continue");
		
			$title=trim($this->input->post('title'));
			$category=trim($this->input->post('category'));
		
			$technologies=strip_tags(trim($this->input->post('technologies')));
			$role=trim($this->input->post('role'));
			$jobtype=trim($this->input->post('jobtype'));
			$experience=trim($this->input->post('experience'));
			$salary=trim($this->input->post('salary'));
			$companyname=trim($this->input->post('companyname'));
			$companylocation=trim($this->input->post('companylocation'));
			    
			$description=trim($this->input->post('editor'));
			
			
			$m=date("Y-m-d");
			
			$userid=getuserid();
			$this->App_model->insert('Jobs',['job_title'=>$title,'job_category'=>$category,'job_role'=>$role,'job_type'=>$jobtype,'	job_experience'=>$experience,'technologies'=>$technologies,'description'=>$description,'date'=>$m,'salary'=>$salary,'companyname'=>$companyname,'companylocation'=>$companylocation],$batch=false);
			redirect("/admin/postJobs");
		
	}
	public function jobs_posted(){
		$data=$this->SiteModel->getSiteData();
		$data['title']="Ask";
		$this->load->model("Job");
		$r=$this->Job->job();
		$data['job']=$r;
		$this->load->view('admin/editJob',$data);
	}
	public function postEditJob()
	{
	
		if (!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		
		$catid=secureInput($this->input->post('catid'));
		
		$data=$this->App_model->getData('Jobs',$resultType="row_array",$arg=['where'=>['id'=>$catid]]);
	 
	  echo json_encode($data);
	}
	
	public function UpdateJobs()
	{ 
	
	if(!checksessionAdmin()) {
			responseGenerate(2,"Please login to continue");
		}
		
		$job_title=secureInput($this->input->post('job_title'));
        $JobCategory=secureInput($this->input->post('JobCategory'));
        $Description=secureInput($this->input->post('Description'));
        $role=secureInput($this->input->post('role'));
		$jobtype=secureInput($this->input->post('jobtype'));
		$experience=secureInput($this->input->post('experience'));
		$salary=secureInput($this->input->post('salary'));
		$companyname=secureInput($this->input->post('companyname'));
		$companylocation=secureInput($this->input->post('companylocation'));
		$technologies=secureInput($this->input->post('technologies'));
		
		$m=date("Y-m-d");
		$this->App_model->updateData('Jobs',['job_title'=>$job_title,'job_category'=>$JobCategory,'description'=>$Description,'job_role'=>$role,'job_type'=>$jobtype,'job_experience'=>$experience,'salary'=>$salary,'companyname'=>$companyname,'companylocation'=>$companylocation,'technologies'=>$technologies,'date'=>$m]);
  
			
		responseGenerate(1,"Data was successfully saved");
		
		
		
		    

	}
	public function postDelJob()
	{
		
		if (!checksessionAdmin())
		responseGenerate(2,"Please login to continue");
	
		$qid=(int) secureInput($this->input->post('catid'));
	
		
		$where=['id'=>$qid];
		$this->App_model->deleteData('Jobs',$where);
		responseGenerate(1,"Job was successfully deleted");
	}
}