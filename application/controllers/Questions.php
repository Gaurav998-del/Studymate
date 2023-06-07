<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Questions extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('QuestionsModel');
				$this->load->model('Blog');

	}
	public function loadAsk()
	{
		if (!checksession()) {
			redirect("login");
		}
		$data=$this->SiteModel->getSiteData();
		$data['title']="Ask";
		$categories=$this->App_model->getData('categories',$resultType="all_array",$arg=['where'=>['status'=>1],'order'=>['col'=>'name','type'=>'asc']]);
		$data['categories']=$categories;
		$this->load->view('askQuestion',$data);
	}

	// Exam

public function loadexam($limit='0',$list_view='grid',$stat='')
	{
		if (!checksession()) {
			redirect("login");
		}
		$data=$this->SiteModel->getSiteData();
		$data['title']="Exam";

		$logged_in=$this->session->userdata('logged_in');
		// if($logged_in['base_url'] != base_url()){
		// $this->session->unset_userdata('logged_in');		
		// redirect('login');
		// }
		
		
		
		 	
			// $logged_in=$this->session->userdata('logged_in');
   //                      $setting_p=explode(',',$logged_in['quiz']);
			// if(in_array('List',$setting_p) || in_array('List_all',$setting_p)){
			
			// }else{
			// exit($this->lang->line('permission_denied'));
			// }
			 
			
			
		$data['list_view']=$list_view;
		$data['limit']=$limit;
		$data['title']=$this->lang->line('quiz');
		// fetching quiz list
		$data['result']=$this->Blog->quiz_list($limit,$stat);
	 	$data['archived']=$this->Blog->quizstat('archived');
		$data['active']=$this->Blog->quizstat('active');
		$data['upcoming']=$this->Blog->quizstat('upcoming');
		 $data['stat']=$stat;
		$this->load->view('quiz_list',$data);

		// $categories=$this->App_model->getData('categories',$resultType="all_array",$arg=['where'=>['status'=>1],'order'=>['col'=>'name','type'=>'asc']]);
		// $data['categories']=$categories;
		// $this->load->view('askQuestion',$data);
	}

		public function quiz_detail($quid){
				// redirect if not loggedin
 
if (!checksession()) {
			redirect("login");
		}
		$data=$this->SiteModel->getSiteData();
		$data['title']="Exam";
		
				$data['title']=$this->lang->line('attempt').' '.$this->lang->line('quiz');
		
		$data['quiz']=$this->Blog->get_quiz($quid);
		$this->load->view('quiz_detail',$data);
		
	}


	public function validate_exam($quid){

		$data=$this->SiteModel->getSiteData();
		$data['title']="Exam";
		

		$selected_lang=0;
	if($this->input->post('selected_lang')){
	$selected_lang=$this->input->post('selected_lang');
	}

			$data['quiz']=$this->Blog->get_quiz($quid);

		if (!checksession()) {
			redirect("login");
		}

				$uid=getuserid();

				// if this quiz already opened by user then resume it
		 $open_result=$this->Blog->open_result($quid,$uid);
		 if($open_result != '0'){
		// $this->session->set_userdata('rid', $open_result);
		redirect('Questions/resume_pending/'.$open_result);
		 	
		}

		// validate start end date/time
		if($data['quiz']['start_date'] > time()){
		$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('quiz_not_available')." </div>");
		redirect('questions/quiz_detail/'.$quid);
		 }
		// validate start end date/time
		if($data['quiz']['end_date'] < time()){
		$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('quiz_ended')." </div>");
		redirect('questions/quiz_detail/'.$quid);
		 }


		// validate ip address
		if($data['quiz']['ip_address'] !=''){
		$ip_address=explode(",",$data['quiz']['ip_address']);
		$myip=$_SERVER['REMOTE_ADDR'];
		if(!in_array($myip,$ip_address)){
		$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('ip_declined')." </div>");
		redirect('questions/quiz_detail/'.$quid);
		 }
		}

		// validate maximum attempts
		$maximum_attempt=$this->Blog->count_result($quid,$uid);
		if($data['quiz']['maximum_attempts'] <= $maximum_attempt){
		$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('reached_maximum_attempt')." </div>");
		redirect('questions/quiz_detail/'.$quid);
	}


		// if($data['quiz']['quiz_price'] >= 1){
			
		// 	$quiz_txn=intval($this->quiz_model->get_quiz_transactions($quid));
			 
		// if($quiz_txn == 0){
		// $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('quiz_paid')." </div>");
		// redirect('quiz/quiz_detail/'.$quid);
		//    }  
		//  }
		// insert result row and get rid (result id)
		$rid=$this->Blog->insert_result($quid,$uid);
		
		$this->session->set_userdata('rid', $rid);
		redirect('questions/attempt/'.$rid.'/'.$selected_lang);	

	}


	function resume_pending($open_result){
		$data=$this->SiteModel->getSiteData();
		$data['title']="Exam";
		if (!checksession()) {
			redirect("login");
		}
		
	$data['title']=$this->lang->line('pending_quiz');
	$this->session->set_userdata('rid', $open_result);
		$data['openquizurl']='Questions/attempt/'.$open_result;
			 		
		 $this->load->view('pending_quiz_message',$data);
	
	}

		function attempt($rid,$selected_lang=0){
			$data=$this->SiteModel->getSiteData();
		$data['title']="Exam";
		if (!checksession()) {
			redirect("login");
		}
		


		 $srid=$this->session->userdata('rid');
								// $this->session->rid=$name;

						// if linked and session rid is not matched then something wrong.
			if($rid != $srid){
		 
		$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('quiz_ended')." </div>");
		redirect('questions/loadexam');

			}
		/*
		if(!$this->session->userdata('logged_in')){
			exit($this->lang->line('permission_denied'));
		}
		*/
		
		// get result and quiz info and validate time period
		$data['quiz']=$this->Blog->quiz_result($rid);
		$data['saved_answers']=$this->Blog->saved_answers($rid);
		$data['selected_lang']=$selected_lang;


		// end date/time
		if($data['quiz']['end_date'] < time()){
		$this->Blog->submit_result($rid);

		$this->session->unset_userdata('rid');
		$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('quiz_ended')." </div>");
		redirect('questions/quiz_detail/'.$data['quiz']['quid']);
		 }

		
		// end date/time
		if(($data['quiz']['start_time']+($data['quiz']['duration']*60)) < time()){
		
		$this->Blog->submit_result($rid);
		$this->session->unset_userdata('rid');
		$this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('time_over')." </div>");
		redirect('questions/quiz_detail/'.$data['quiz']['quid']);
		 }

		// remaining time in seconds 
		$data['seconds']=($data['quiz']['duration']*60) - (time()- $data['quiz']['start_time']);
		

		// get questions
		$data['questions']=$this->Blog->get_questions($data['quiz']['r_qids']);
		// get options
		$data['options']=$this->Blog->get_options($data['quiz']['r_qids']);
		$data['title']=$data['quiz']['quiz_name'];
		
		$this->load->view('quiz_attempt_'.$data['quiz']['quiz_template'],$data);
			
		}
		
		

function open_quiz($limit='0'){
	if(!$this->config->item('open_quiz')){
		exit();
	}
			$data=$this->SiteModel->getSiteData();
		// $data['title']="Exam";
		

		$data['limit']=$limit;
		$data['title']=$this->lang->line('quiz');
		$data['open_quiz']=$this->Blog->open_quiz($limit);
		
		$this->load->view('open_exam',$data);
	
}

function submit_quiz(){
	 				// redirect if not loggedin
			$data=$this->SiteModel->getSiteData();
		$data['title']="Exam";
		if (!checksession()) {
			redirect("login");
		}
			

	 $rid=$this->session->userdata('rid');
		
				if($this->Blog->submit_result()){
					 
					 $this->session->set_flashdata('message', "<div class='alert alert-success'>".str_replace("{result_url}",site_url('Questions/view_result/'.$rid),$this->lang->line('quiz_submit_successfully'))." </div>");
					 
					
					}else{
						    $this->session->set_flashdata('message', "<div class='alert alert-danger'>".$this->lang->line('error_to_submit')." </div>");
						
					}
			$this->session->unset_userdata('rid');		
	if($this->session->userdata('logged_in')){
	redirect('Questions/view_result/'.$rid);				
 redirect('quiz');
	}else{
	 redirect('Questions/open_quiz/0');	
	}
 }

	// End Exam

// Result 

function view_result($rid){
		
		$data=$this->SiteModel->getSiteData();
		$data['title']="Exam";
		if (!checksession()) {
			redirect("login");
		}
	
			// $logged_in=$this->session->userdata('logged_in');
   //                      $setting_p=explode(',',$logged_in['results']);
			// if(in_array('List',$setting_p) || in_array('List_all',$setting_p)){
			
			// }else{
			// exit($this->lang->line('permission_denied'));
			// }		
		
		 	// check any custom field pending to fill..
			
		$data['result']=$this->Blog->get_result($rid);
		 
	// 	if(!in_array('List_all',$setting_p)){
	// 			if($this->user_model->pending_custom($data['result']['uid']) >= 1 ){
	// 				redirect('user/edit_user_fill_custom/'.$data['result']['uid'].'/'.$rid);
	// 			}
	// }
		$data['attempt']=$this->Blog->no_attempt($data['result']['quid'],$data['result']['uid']);
		$data['title']=$this->lang->line('result_id').' '.$data['result']['rid'];
		// if($data['result']['view_answer']=='1' || $logged_in['su']=='1'){
		//  $this->load->model("quiz_model");
		// $data['saved_answers']=$this->quiz_model->saved_answers($rid);
		// $data['questions']=$this->quiz_model->get_questions($data['result']['r_qids']);
		// $data['options']=$this->quiz_model->get_options($data['result']['r_qids']);

		// }
		// top 10 results of selected quiz
	$last_ten_result = $this->Blog->last_ten_result($data['result']['quid']);
	$value=array();
     $value[]=array('Quiz Name','Percentage (%)');
     foreach($last_ten_result as $val){
     $value[]=array($val['email'].' ('.$val['name'].')',intval($val['percentage_obtained']));
     }
     $data['value']=json_encode($value);
	 
	// time spent on individual questions
	$correct_incorrect=explode(',',$data['result']['score_individual']);
	 $qtime[]=array($this->lang->line('question_no'),$this->lang->line('time_in_sec'));
    foreach(explode(",",$data['result']['individual_time']) as $key => $val){
	if($val=='0'){
		$val=1;
	}
	 if($correct_incorrect[$key]=="1"){
	 $qtime[]=array($this->lang->line('q')." ".($key+1).") - ".$this->lang->line('correct')." ",intval($val));
	 }else if($correct_incorrect[$key]=='2' ){
	  $qtime[]=array($this->lang->line('q')." ".($key+1).") - ".$this->lang->line('incorrect')."",intval($val));
	 }else if($correct_incorrect[$key]=='0' ){
	  $qtime[]=array($this->lang->line('q')." ".($key+1).") -".$this->lang->line('unattempted')." ",intval($val));
	 }else if($correct_incorrect[$key]=='3' ){
	  $qtime[]=array($this->lang->line('q')." ".($key+1).") - ".$this->lang->line('pending_evaluation')." ",intval($val));
	 }
	}
	 $data['qtime']=json_encode($qtime);
	 $data['percentile'] = $this->Blog->get_percentile($data['result']['quid'], $data['result']['uid'], $data['result']['score_obtained']);

	  
	  $uid=$data['result']['uid'];
	  $quid=$data['result']['quid'];
	  
	  
		$this->load->view('view_result',$data);
		
		
	}


	public function result_list($limit='0',$status='0')
	{
			$data=$this->SiteModel->getSiteData();
		$data['title']="Result List";
		if (!checksession()) {
			redirect("login");
		}
			 			
		$data['limit']=$limit;
		$data['status']=$status;
		$data['title']=$this->lang->line('resultlist');
		// fetching result list
		$data['result']=$this->Blog->result_list($limit,$status);
		// fetching quiz list
		$data['quiz_list']=$this->Blog->quiz_list1();
		// group list
		
		$this->load->view('result_list',$data);
	}
 // End Result

	
	public function findsubcategories()
	{
		if (!checksession()) {
			redirect("login");
		}
		$category_id=secureInput($this->input->post('category_id'));

		$scategories=$this->App_model->findsubcat($category_id);
	

?>
 <select id="scategory" class="search_test SumoUnder form-control input-rounded w-100">
										<option value="">Please Select SubCategory</option>
										<?php foreach ($scategories as $scat) {?>
											<option value="<?php echo $scat['scatid'];?>">
												<?php echo $scat['name'];?>
											</option>
										<?php } ?>
									</select> 
<?php 
		// print_r($scategories);
		// die();
		// $data['scategories']=$scategories;

	}
	public function voteManageQuestion()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$qid=secureInput($this->input->post('question'));
		$checkQuestion=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['status'=>1,'qid'=>$qid]]);
		if ($checkQuestion==0) {
			responseGenerate(0,"Invalid question being tried to vote");
		}
		
		$val=secureInput($this->input->post('type'));
		
		$val=$val==0?0:1;
		$userid=getuserid();
		$userRepu=$this->App_model->getData('users',$resultType="row_array",$arg=['select'=>['votes'],'where'=>['userid'=>$userid]]);
		$questionSchema=$this->App_model->getData('questionSchema',$resultType="row_array",$arg=['select'=>['canVoteAfter']]);
		$canVoteAfter=$questionSchema['canVoteAfter'];
		
		if (0) {
			responseGenerate(0,"You need ".$canVoteAfter." reputation to vote");
		}
		
		$checkVoteExist=$this->App_model->getData('votedQuestions',$resultType="count_array",$arg=['where'=>['by'=>$userid,'qid'=>$qid]]);

		if ($checkVoteExist>0) {
			$this->App_model->updateData('votedQuestions',['val'=>$val],['qid'=>$qid,'by'=>$userid]);
		} else {
			$this->App_model->insert('votedQuestions',['by'=>$userid,'qid'=>$qid,'val'=>$val],$batch=false);
		}
		
		if ($val==1) {
			$this->QuestionsModel->incQ(['qid'=>$qid],"votes","questions");
		} else {
			$this->QuestionsModel->decQ(['qid'=>$qid],"votes","questions");
			
		}
		$getOwnerId=$this->App_model->getData('questions',$resultType="row_array",$arg=['select'=>['userid'],'where'=>['qid'=>$qid]]);
		$for=$getOwnerId['userid'];
		$this->App_model->insert('notifications',['qid'=>$qid,'for'=>$for,'by'=>$userid,'qid'=>$qid,'nsId'=>13],$batch=false);
		
		responseGenerate(1,"Success");
	}
	
	public function voteManageAnswer()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		
		$qaid=secureInput($this->input->post('qaid'));
		$checkAnswer=$this->App_model->getData('awnsers',$resultType="count_array",$arg=['where'=>['qaid'=>$qaid]]);
		if ($checkAnswer==0) {
			responseGenerate(0,"Invalid answer being tried to vote");
		}
		
		$val=secureInput($this->input->post('type'));
		$val=$val==0?0:1;
		$userid=getuserid();
		$userRepu=$this->App_model->getData('users',$resultType="row_array",$arg=['select'=>['votes'],'where'=>['userid'=>$userid]]);
		$questionSchema=$this->App_model->getData('questionSchema',$resultType="row_array",$arg=['select'=>['canVoteAfter']]);
		$canVoteAfter=$questionSchema['canVoteAfter'];
		
		if (0) {
			responseGenerate(0,"You need ".$canVoteAfter." reputation to vote");
		}
		
		$checkVoteExist=$this->App_model->getData('votedAnswers',$resultType="count_array",$arg=['where'=>['by'=>$userid,'qaid'=>$qaid]]);
		if ($checkVoteExist>0) {
			$this->App_model->updateData('votedAnswers',['val'=>$val],['qaid'=>$qaid,'by'=>$userid]);
		} else {
			$this->App_model->insert('votedAnswers',['by'=>$userid,'qaid'=>$qaid,'val'=>$val],$batch=false);
		}
		if ($val==1) {
			$this->QuestionsModel->incQ(['qaid'=>$qaid],"votes","awnsers");
		} else {
			$this->QuestionsModel->decQ(['qaid'=>$qaid],"votes","awnsers");
		}
		
		$getOwnerId=$this->App_model->getData('awnsers',$resultType="row_array",$arg=['select'=>['userid','qid'],'where'=>['qaid'=>$qaid]]);
		$for=$getOwnerId['userid'];
		$qid=$getOwnerId['qid'];
		$this->App_model->insert('notifications',['qid'=>$qid,'for'=>$for,'by'=>$userid,'qaid'=>$qaid,'nsId'=>14],$batch=false);
		
		responseGenerate(1,"Success");
	}
	
	public function voteManageQuestionR()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$qrid=secureInput($this->input->post('qrid'));
		$checkQuestionR=$this->App_model->getData('questionsReplies',$resultType="count_array",$arg=['where'=>['qrid'=>$qrid]]);
		if ($checkQuestionR==0) {
			responseGenerate(0,"Invalid question's reply being tried to vote");
		}
		
		$val=secureInput($this->input->post('type'));
		$val=$val==0?0:1;
		$userid=getuserid();
		$userRepu=$this->App_model->getData('users',$resultType="row_array",$arg=['select'=>['votes'],'where'=>['userid'=>$userid]]);
		$userRepu=$userRepu['votes'];
		$questionSchema=$this->App_model->getData('questionSchema',$resultType="row_array",$arg=['select'=>['canVoteAfter']]);
		$canVoteAfter=$questionSchema['canVoteAfter'];
		
		if (0) {
			responseGenerate(1,"You need ".$canVoteAfter." reputation to vote");
		}
		
		$checkVoteExist=$this->App_model->getData('votedQReplies',$resultType="count_array",$arg=['where'=>['by'=>$userid,'qrid'=>$qrid]]);
		if ($checkVoteExist>0) {
			$this->App_model->deleteData('votedQReplies',$where=['qrid'=>$qrid,'by'=>$userid]);
		} else {
			$this->App_model->insert('votedQReplies',['by'=>$userid,'qrid'=>$qrid],$batch=false);
		}
		
		if ($val==1) {
			$this->QuestionsModel->incQ(['qrid'=>$qrid],"votes","questionsReplies");
		} else {
			$this->QuestionsModel->decQ(['qrid'=>$qrid],"votes","questionsReplies");
		}
		$getOwnerId=$this->App_model->getData('questionsReplies',$resultType="row_array",$arg=['select'=>['userid','qid'],'where'=>['qrid'=>$qrid]]);
		$for=$getOwnerId['userid'];
		$qid=$getOwnerId['qid'];
		$this->App_model->insert('notifications',['qid'=>$qid,'for'=>$for,'by'=>$userid,'qrid'=>$qrid,'nsId'=>9],$batch=false);
		
		responseGenerate(1,"Success");
	}
	
	public function voteManageAnswerR()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$arid=secureInput($this->input->post('arid'));
		$checkAnswerR=$this->App_model->getData('awnserReplies',$resultType="count_array",$arg=['where'=>['arid'=>$arid]]);
		if ($checkAnswerR==0) {
			responseGenerate(0,"Invalid answers's reply being tried to vote");
		}
		
		$val=secureInput($this->input->post('type'));
		$val=$val==0?0:1;
		$userid=getuserid();
		$userRepu=$this->App_model->getData('users',$resultType="row_array",$arg=['select'=>['votes'],'where'=>['userid'=>$userid]]);
		$userRepu=$userRepu['votes'];
		$questionSchema=$this->App_model->getData('questionSchema',$resultType="row_array",$arg=['select'=>['canVoteAfter']]);
		$canVoteAfter=$questionSchema['canVoteAfter'];
		
		if (0) {
			responseGenerate(0,"You need ".$canVoteAfter." reputation to vote");
		}
		
		$checkVoteExist=$this->App_model->getData('votedAReplies',$resultType="count_array",$arg=['where'=>['by'=>$userid,'arid'=>$arid]]);
		if ($checkVoteExist>0) {
			$this->App_model->deleteData('votedAReplies',$where=['arid'=>$arid,'by'=>$userid]);
		} else {
			$this->App_model->insert('votedAReplies',['by'=>$userid,'arid'=>$arid],$batch=false);
		}
		
		if ($val==1) {
			$this->QuestionsModel->incQ(['arid'=>$arid],"votes","awnserReplies");
		} else {
			$this->QuestionsModel->decQ(['arid'=>$arid],"votes","awnserReplies");
		}
		
		$getOwnerId=$this->App_model->getData('awnserReplies',$resultType="row_array",$arg=['select'=>['userid','qid'],'where'=>['arid'=>$arid]]);
		$for=$getOwnerId['userid'];
		$qid=$getOwnerId['qid'];
		$this->App_model->insert('notifications',['qid'=>$qid,'for'=>$for,'by'=>$userid,'arid'=>$arid,'nsId'=>15],$batch=false);
		
		responseGenerate(1,"Success");
	}
	
	public function loadTaged($tagName)
	{
		$tagName=trim($tagName);
		if (strlen($tagName)==0) {
			show_404();
		}
		$data=$this->SiteModel->getSiteData();
		$data['title']=$tagName;
		$limit=10;
		$getAllQuestions=$this->QuestionsModel->getAllQuestions($limit,0,$type="",$tagName);
		
		$getAllQuestionsCount=$this->App_model->getData('questions',$resultType="count",$arg=['where'=>['status'=>1],'like'=>['col'=>'tags','query'=>$tagName]]);
		$data['getPopularQuestions']=$this->QuestionsModel->getPopularQuestions();
		$data['getPopularQuestionsTags']=$this->QuestionsModel->getPopularQuestionsTags();
		$data['getAllQuestions']=$getAllQuestions;
		$data['next']=$limit;
		$data['type']=$type;
		$data['tagName']=$tagName;
		$data['getAllQuestionsCount']=$getAllQuestionsCount;
		$this->load->view('questions',$data);
	}
	public function loadCategories($traling,$categoryPerma="")
	{
		$categoryPerma=(strlen($traling)>0 && strlen($categoryPerma)>0) ?$traling."/".$categoryPerma:$traling;
		$categoryPerma=trim($categoryPerma);
		if (strlen($categoryPerma)==0) {
			show_404();
		}
		$getCategory=$this->App_model->getData('categories',$resultType="row_array",$arg=['where'=>['status'=>1,'permalink'=>$categoryPerma]]);
		
		if (count($getCategory)==0) {
			show_404();
		}
		$catid=$getCategory['catid'];
		
		$data=$this->SiteModel->getSiteData();
		$data['title']=$getCategory['name'];
		
		$limit=10;
		$getAllQuestions=$this->QuestionsModel->getAllQuestions($limit,0,$type="","",$catid);
		if ($catid!=null) {
			$this->db->where('questions.catid',$catid);
		}
		$getAllQuestionsCount=$this->App_model->getData('questions',$resultType="count",$arg=['where'=>['status'=>1,'catid'=>$catid]]);
		$data['getPopularQuestions']=$this->QuestionsModel->getPopularQuestions();
		$data['getPopularQuestionsTags']=$this->QuestionsModel->getPopularQuestionsTags();
		$data['getAllQuestions']=$getAllQuestions;
		$data['next']=$limit;
		$data['type']=$type;
		$data['catid']=$catid;
		$data['getAllQuestionsCount']=$getAllQuestionsCount;
		$this->load->view('questions',$data);
	}
	public function loadQuestions($type)
	{
		
		$limit=10;
		$getAllQuestions=$this->QuestionsModel->getAllQuestions($limit,0,$type);
		$where=['status'=>1];
		if (strlen($type)>0) {
			if ($type=="hot") {
				$where['questions.votes>']=0;
			} else if ($type=="unanswered") {
				$where['questions.awnsers']=0;
			}
		}
		$getAllQuestionsCount=$this->App_model->getData('questions',$resultType="count",$arg=['where'=>$where]);
		$data=$this->SiteModel->getSiteData();
		$data['title']="Questions";
		$data['getPopularQuestions']=$this->QuestionsModel->getPopularQuestions();
		$data['getPopularQuestionsTags']=$this->QuestionsModel->getPopularQuestionsTags();
		$data['getAllQuestions']=$getAllQuestions;
		$data['next']=$limit;
		$data['type']=$type;
		$data['getAllQuestionsCount']=$getAllQuestionsCount;
		$this->load->view('questions',$data);
	}
	public function loadMoreQ()
	{
		$limit=10;
		$next=(int) secureInput($this->input->post('next'));
		$type=secureInput($this->input->post('selectedType'));
		$tag=secureInput($this->input->post('tag'));
		$search=secureInput($this->input->post('search'));
		$catid=secureInput($this->input->post('catid'));
		
		$getAllQuestions=$this->QuestionsModel->getAllQuestions($limit,$next,$type,$tag,$catid,$search);
		
		$where=['status'=>1];
		if (strlen($type)>0) {
			if ($type=="hot") {
				$where['questions.votes>']=0;
			} else if ($type=="unanswered") {
				$where['questions.awnsers']=0;
			}
		}
		
		if (strlen($tag)>0) {
			$arg['like']=['col'=>'tags','query'=>$tag];
		}
		if (strlen($search)>0) {
			$arg['like2']=['col'=>'title','query'=>$search];
		}
		if (strlen($catid)>0) {
			$where['questions.catid']=(int) $catid;
		}
		$arg['where']=$where;
		$getAllQuestionsCount=$this->App_model->getData('questions',$resultType="count_array",$arg);
		
		$next=$limit+$next;
		$result=[];
		$result['type']=1;
		$result['next']=$next;
		$result['loadMoreH']=$next>$getAllQuestionsCount?1:0;
		$result['result']=$this->load->view('questionsTemplateLM',['getAllQuestions'=>$getAllQuestions],true);
		echo json_encode($result);
	}
	public function questionViewer($qid)
	{
		$question=$this->App_model->getData('questions',$resultType="row_array",$arg=['where'=>['qid'=>$qid]]);
		
		if (count($question)==0) {
			show_404();
		}
		if (!checksessionAdmin()) {
			if ($question['status']==2) {
				show_404();
			} else if ($question['status']==0) {
				if(checksession()) {
					if($this->session->role==1 && $question['userid'] != getuserid())
					{
						show_404();
					}
				} else {
					redirect('login');
				}
			}
		}
		$data=$this->SiteModel->getSiteData();
		$userinfo=$this->App_model->getData('users',$resultType="row_array",$arg=['select'=>['name','image'],'where'=>['userid'=>$question['userid']]]);
		$catInfo=$this->App_model->getData('categories',$resultType="row_array",$arg=['select'=>['name','permalink'],'where'=>['catid'=>$question['catid']]]);
		$userid=$question['userid'];
		$limit=5;
		$s=0;
		$data['title']=$question['title'];
		$data['siteSettings']['tags']=$question['tags'];
		$data['siteSettings']['description']=$question['description'];
		
		$recentAnswers=$this->App_model->getData('awnsers',$resultType="all_array",$arg=['select'=>['awnsers.qaid','awnsers.on','awnsers.description','awnsers.votes','users.name','users.image','users.userid'],'limit'=>[$limit,$s],'where'=>['awnsers.qid'=>$qid],'order'=>['col'=>'on','type'=>'desc'],'join'=>['table'=>'users','query'=>'users.userid=awnsers.userid','type'=>'inner']]);
		
		$userids=array_column($recentAnswers,'userid');
		if (!in_array($userid,$userids))
		$userids[]=$userid;
		
		if (count($userids)>0) {
			$recentBadges=$this->App_model->getData('awardedBadges',$resultType="all_array",$arg=['select'=>['badges.name','awardedBadges.userid'],'limit'=>[1,0],'wherein'=>['column'=>'awardedBadges.userid','data'=>$userids],'order'=>['col'=>'badges.on','type'=>'desc'],'join'=>['table'=>'badges','query'=>'awardedBadges.badgeId=badges.badgeId','type'=>'inner']]);
		} else {
			$recentBadges=[];
		}
		
		$recentAnswersCount=$this->App_model->getData('awnsers',$resultType="count",$arg=['where'=>['qid'=>$qid]]);
		
		$questionReplies=$this->App_model->getData('questionsReplies',$resultType="all_array",$arg=['select'=>['questionsReplies.qrid','questionsReplies.on','questionsReplies.reply','questionsReplies.votes','users.name','users.userid'],'limit'=>[$limit,$s],'where'=>['questionsReplies.qid'=>$qid],'order'=>['col'=>'on','type'=>'desc'],'join'=>['table'=>'users','query'=>'users.userid=questionsReplies.userid','type'=>'inner']]);
		
		$questionsRepliesCount=$this->App_model->getData('questionsReplies',$resultType="count",$arg=['where'=>['questionsReplies.qid'=>$qid]]);
		$votedQuestionsReplies=[]; 
		$reportedQuestionsReplies=[]; 
		$votedAnswerCon=[]; 
		if (checksession()) {
			$data['reportSchema']=$this->App_model->getData('reportSchema',$resultType="all_array",$arg=[]);
			$userid=getuserid();
			$data['votedQuestions']=$this->App_model->getData('votedQuestions',$resultType="row_array",$arg=['select'=>['val'],'where'=>['by'=>$userid,'qid'=>$qid]]);
			
			if (count($questionReplies)>0) {
				$replyIds=array_column($questionReplies,'qrid');
				
				$votedQuestionsRepliesR=$this->App_model->getData('votedQReplies',$resultType="all_array",$arg=['select'=>['qrid'],'where'=>['by'=>$userid],'wherein'=>['column'=>'qrid','data'=>$replyIds]]);
				if (count($votedQuestionsRepliesR)>0) {
					$votedQuestionsReplies=array_column($votedQuestionsRepliesR,'qrid');
				}
				$reportedQuestionsRepliesData=$this->App_model->getData('reportedReplies',$resultType="all_array",$arg=['select'=>['qrid'],'where'=>['userid'=>$userid],'wherein'=>['column'=>'qrid','data'=>$replyIds]]);
				if (count($reportedQuestionsRepliesData)>0) {
					$reportedQuestionsReplies=array_column($reportedQuestionsRepliesData,'qrid');
				}
			}
			
			if (count($recentAnswers)>0) {
				$answerIds=array_column($recentAnswers,'qaid');
				$votedAnswerCon=$this->App_model->getData('votedAnswers',$resultType="all_array",$arg=['select'=>['qaid','val'],'where'=>['by'=>$userid],'wherein'=>['column'=>'qaid','data'=>$answerIds]]);
			}
		}
		
		$data['votedQuestionsReplies']=$votedQuestionsReplies; 
		$data['votedAnswerCon']=$votedAnswerCon; 
		$hasView=$this->QuestionsModel->manageViews($qid);
		if ($hasView==true) {
			$views=$question['views'];
			$question['views']=$views++;
		}
		
		$checkEditByUsers=$this->App_model->getData('editedQuestionsList',$resultType="count_array",$arg=['where'=>['qid'=>$qid]]);
		$editByUsers=[];
		if ($checkEditByUsers>0) {
			$editByUsers=$this->App_model->getData('editedQuestionsList',$resultType="all_array",$arg=['select'=>['editedQuestionsList.on','users.name','users.image','users.userid'],'where'=>['editedQuestionsList.qid'=>$qid],'order'=>['col'=>'on','type'=>'desc'],'join'=>['table'=>'users','query'=>'users.userid=editedQuestionsList.userid','type'=>'inner']]);
		}
		
		$data['getPopularQuestions']=$this->QuestionsModel->getPopularQuestions();
		$data['getRelatedQuestions']=$this->QuestionsModel->getRelatedQuestions($limit=3,$question['catid'],$qid);
		$data['getPopularQuestionsTags']=$this->QuestionsModel->getPopularQuestionsTags();
		$data['editByUsers']=$editByUsers;
		$data['recentAnswers']=$recentAnswers;
		$data['recentAnswersCount']=$recentAnswersCount;
		$data['questionReplies']=$questionReplies;
		$data['reportedQuestionsReplies']=$reportedQuestionsReplies;
		$data['questionsRepliesCount']=$questionsRepliesCount;
		$data['next']=$limit+$s;
		$data['limitAnswerReplies']=5;
		$data['userinfo']=$userinfo;
		$data['question']=$question;
		$data['catInfo']=$catInfo;
		$data['recentBadges']=$recentBadges;
		
		$this->load->view('question',$data);
	}
	public function loadMoreQa()
	{
		$qid=secureInput($this->input->post('question'));
		
		$question=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['qid'=>$qid,'status'=>1]]); 
		if ($question!=1) {
			responseGenerate(2,"Invalid question was selected");
		}
		$next=(int) secureInput($this->input->post('next'));
		$type=secureInput($this->input->post('dtype'));
		
		$where=['awnsers.qid'=>$qid];
		if ($type=="vote") {
			$orderBy=['col'=>'votes','type'=>'desc'];
			$where['awnsers.votes>']=0;
		} else if ($type=="old") {
			$orderBy=['col'=>'on','type'=>'asc'];
		} else {
			$orderBy=['col'=>'on','type'=>'desc'];
		}
		
		$limit=5;
		$s=$next;
		
		$next=$limit+$s;
		$answers=$this->App_model->getData('awnsers',$resultType="all_array",$arg=['select'=>['awnsers.qaid','awnsers.on','awnsers.description','awnsers.votes','users.name','users.image','users.userid'],'limit'=>[$limit,$s],'where'=>$where,'order'=>$orderBy,'join'=>['table'=>'users','query'=>'users.userid=awnsers.userid','type'=>'inner']]);
		
		$userids=array_column($answers,'userid');
		
		if (count($userids)>0) {
			$recentBadges=$this->App_model->getData('awardedBadges',$resultType="all_array",$arg=['select'=>['badges.name','awardedBadges.userid'],'limit'=>[1,0],'wherein'=>['column'=>'awardedBadges.userid','data'=>$userids],'order'=>['col'=>'badges.on','type'=>'desc'],'join'=>['table'=>'badges','query'=>'awardedBadges.badgeId=badges.badgeId','type'=>'inner']]);
		} else {
			$recentBadges=[];
		}
		$recentAnswersCount=$this->App_model->getData('awnsers',$resultType="count",$arg=['where'=>['awnsers.qid'=>$qid]]);
		$votedAnswerCon=[];
		if (checksession()) {
			$userid=getuserid();
			if (count($answers)>0) {
				$answerIds=array_column($answers,'qaid');
				$votedAnswerCon=$this->App_model->getData('votedAnswers',$resultType="all_array",$arg=['select'=>['qaid','val'],'where'=>['by'=>$userid],'wherein'=>['column'=>'qaid','data'=>$answerIds]]);
			}
		}
		
		$answers=$this->load->view('answerTemplateLM',['votedAnswerCon'=>$votedAnswerCon,'recentBadges'=>$recentBadges,'answers'=>$answers,'limitAnswerReplies'=>5],true);
		$result=[];
		$result['type']=1;
		$result['next']=$next;
		$result['loadMoreH']=$next>$recentAnswersCount?1:0;
		$result['result']=$answers;
		echo json_encode($result);
	}
	public function loadMoreMq()
	{
		$qid=secureInput($this->input->post('question'));
		$next=secureInput($this->input->post('next'));
		$question=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['qid'=>$qid,'status'=>1]]);
		
		if ($question!=1) {
			show_404();
		}
		$limit=5;
		$s=$next;
		$questionReplies=$this->App_model->getData('questionsReplies',$resultType="all_array",$arg=['select'=>['questionsReplies.qrid','questionsReplies.on','questionsReplies.reply','questionsReplies.votes','users.name','users.userid'],'limit'=>[$limit,$s],'where'=>['questionsReplies.qid'=>$qid],'order'=>['col'=>'on','type'=>'desc'],'join'=>['table'=>'users','query'=>'users.userid=questionsReplies.userid','type'=>'inner']]);
		
		$questionsRepliesCount=$this->App_model->getData('questionsReplies',$resultType="count",$arg=['where'=>['questionsReplies.qid'=>$qid]]);
		$votedQuestionsReplies=[]; 
		$reportedQuestionsReplies=[]; 
		if (checksession()) {
			if (count($questionReplies)>0) {
				$userid=getuserid();
				$replyIds=array_column($questionReplies,'qrid');
				
				$votedQuestionsReplies=$this->App_model->getData('votedQReplies',$resultType="all_array",$arg=['select'=>['qrid'],'where'=>['by'=>$userid],'wherein'=>['column'=>'qrid','data'=>$replyIds]]);
				if (count($votedQuestionsReplies)>0) {
					$votedQuestionsReplies=array_column($votedQuestionsReplies,'qrid');
				}
				
				$reportedQuestionsRepliesData=$this->App_model->getData('reportedReplies',$resultType="all_array",$arg=['select'=>['qrid'],'where'=>['userid'=>$userid],'wherein'=>['column'=>'qrid','data'=>$replyIds]]);
				if (count($reportedQuestionsRepliesData)>0) {
					$reportedQuestionsReplies=array_column($reportedQuestionsRepliesData,'qrid');
				}
			}
		}
		
		
		$resultr=$this->load->view('replyTemplateQL',['reportedQuestionsReplies'=>$reportedQuestionsReplies,'votedQuestionsReplies'=>$votedQuestionsReplies,'questionReplies'=>$questionReplies],true);
		$next=$limit+$s;
		$result=[];
		$result['type']=1;
		$result['next']=$next;
		$result['loadMoreH']=$next>$questionsRepliesCount?1:0;
		$result['result']=$resultr;
		echo json_encode($result);
	}
	public function loadInnerTabsQuestion()
	{
		$qid=secureInput($this->input->post('question'));
		$type=secureInput($this->input->post('type'));
		$question=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['qid'=>$qid,'status'=>1]]);
		
		if ($question!=1) {
			show_404();
		}
		$limit=5;
		$s=0;
		$where=['awnsers.qid'=>$qid];
		$showErr=1;
		if ($type=="vote") {
			$orderBy=['col'=>'votes','type'=>'desc'];
			$where['awnsers.votes>']=0;
		} else if ($type=="old") {
			$orderBy=['col'=>'on','type'=>'asc'];
		} else {
			$orderBy=['col'=>'on','type'=>'desc'];
			$showErr=0;
		}
		
		$answers=$this->App_model->getData('awnsers',$resultType="all_array",$arg=['select'=>['awnsers.qaid','awnsers.on','awnsers.description','awnsers.votes','users.name','users.image','users.userid'],'limit'=>[$limit,$s],'where'=>$where,'order'=>$orderBy,'join'=>['table'=>'users','query'=>'users.userid=awnsers.userid','type'=>'inner']]);
		$answersCount=$this->App_model->getData('awnsers',$resultType="count",$arg=['where'=>$where]);
		
		$userids=array_column($answers,'userid');
		if (count($userids)>0) {
			$recentBadges=$this->App_model->getData('awardedBadges',$resultType="all_array",$arg=['select'=>['badges.name','awardedBadges.userid'],'limit'=>[1,0],'wherein'=>['column'=>'awardedBadges.userid','data'=>$userids],'order'=>['col'=>'badges.on','type'=>'desc'],'join'=>['table'=>'badges','query'=>'awardedBadges.badgeId=badges.badgeId','type'=>'inner']]);
		} else {
			$recentBadges=[];
		}
		
		$answers=$this->load->view('answerTemplateL',['recentBadges'=>$recentBadges,'next'=>$limit,'answersCount'=>$answersCount,'type'=>$type,'showErr'=>$showErr,'answers'=>$answers,'limitAnswerReplies'=>5],true);
		responseGenerate(1,$answers);
	}
	public function loadMoreMqar()
	{
		$answerid=secureInput($this->input->post('answerid'));
		$next=secureInput($this->input->post('next'));
		$checkAwnser=$this->App_model->getData('awnsers',$resultType="count_array",$arg=['where'=>['qaid'=>$answerid]]);
		
		if ($checkAwnser!=1) {
			show_404();
		}
		$limit=5;
		$start=$next;
		$answerReplies=$this->QuestionsModel->getanswerreplies($answerid,$limit,$start);
		
		$answerRepliesCount=$this->QuestionsModel->getanswerrepliescount($answerid);
		
		$answerRepliesVotesReports=$this->QuestionsModel->answerRepliesVotesReports($answerReplies);
		$votedAnswerReplies=$answerRepliesVotesReports['votedAnswerReplies'];
		$reportedAnswerRepliesIds=$answerRepliesVotesReports['reportedAnswerRepliesIds'];
		
		$resultr=$this->load->view('replyTemplateAL',['answerReplies'=>$answerReplies,'reportedAnswerRepliesIds'=>$reportedAnswerRepliesIds,'votedAnswerReplies'=>$votedAnswerReplies],true);
		$next=$limit+$start;
		$result=[];
		$result['type']=1;
		$result['next']=$next;
		$result['loadMoreH']=$next>$answerRepliesCount?1:0;
		$result['result']=$resultr;
		echo json_encode($result);
	}
	public function postReportAreply()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$userid=getuserid();
		$arid=secureInput($this->input->post('arid'));
		$checkAnswerReply=$this->App_model->getData('awnserReplies',$resultType="count_array",$arg=['where'=>['arid'=>$arid]]);
		if ($checkAnswerReply==0) {
			responseGenerate(0,"Invalid answer's reply being tried to report");
		}
		
		$reportedReason=secureInput($this->input->post('reportedReason'));
		if (strlen($reportedReason)==0) {
			responseGenerate(0,"Please select a reason");	
		}
		$rsid=(int) $reportedReason;
		$checkrsid=$this->App_model->getData('reportSchema',"count_array",$arg=['where'=>['rsid'=>$rsid]]);
		if ($checkrsid==0) {
			responseGenerate(0,"Invalid reason selected for reporting");
		}
		$checkrsid=$this->App_model->getData('reportedReplies',"count_array",$arg=['where'=>['userid'=>$userid,'arid'=>$arid]]);
		
		if ($checkrsid>0) {
			responseGenerate(0,"You have already reported this reply");
		}
		$this->App_model->insert('reportedReplies',['userid'=>$userid,'arid'=>$arid,'rsid'=>$rsid],$batch=false);
		
		$getOwnerId=$this->App_model->getData('awnserReplies',$resultType="row_array",$arg=['select'=>['userid','qid'],'where'=>['arid'=>$arid]]);
		$for=$getOwnerId['userid'];
		$qid=$getOwnerId['qid'];
		$this->App_model->insert('notifications',['qid'=>$qid,'for'=>$for,'by'=>$userid,'arid'=>$arid,'nsId'=>10],$batch=false);
		
		responseGenerate(1,"Answer reply was successfully reported");
	}
	public function questionEditor($qid)
	{
		$question=$this->App_model->getData('questions',$resultType="row_array",$arg=['select'=>['userid','status','catid','title','tags','description'],'where'=>['qid'=>$qid]]);
		
		if (count($question)==0) {
			show_404();
		} else if ($question['status']==2) {
			show_404();
		} else if ($question['status']==0) {
			if(checksession()) {
				if($this->session->role==1 && $question['userid'] != getuserid())
				{
					show_404();
				}
			} else {
				redirect('login');
			}
		}
		
		$data=$this->SiteModel->getSiteData();
		$data['title']=$question['title'];
		$categories=$this->App_model->getData('categories',$resultType="all_array",$arg=['where'=>['status'=>1]]);
		$data['categories']=$categories;
		$data['question']=$question;
		$data['qid']=$qid;
		$this->load->view('editquestion',$data);
	}
	
	public function postUpdateQuestion()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$userid=getuserid();
		$qid=secureInput($this->input->post('qid'));
		$where=['qid'=>$qid];
		if ($this->session->role!=2) {
			$where['userid']=$userid;
		}
		
		$questionInfo=$this->App_model->getData('questions',$resultType="row_array",$arg=['select'=>['permalink','userid'],'where'=>$where]);
		if (count($questionInfo)==0) {
			responseGenerate(0,"Invalid question being tried to edit");
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Question Title', 'required|max_length[150]|min_length[10]');
		$this->form_validation->set_rules('category', 'Question category', 'required');
		$this->form_validation->set_rules('tags', 'Question tags', 'required|max_length[200]');
		$this->form_validation->set_rules('description', 'Question description', 'required|min_length[10]');
		
		if ($this->form_validation->run() == true) {
			$category=secureInput($this->input->post('category'));
			$checkCategory=$this->App_model->getData('categories',$resultType="count_arr",$arg=['where'=>['catid'=>$category,'status'=>1]]);
			if ($checkCategory==0) {
				responseGenerate(0,"Invalid category posted");
			}
			
			$title=trim($this->input->post('title',true));
			$permalink=format_uri($title);
			$prevperma=$questionInfo['permalink'];
			if ($prevperma!=$permalink) {
				$checkquestion=$this->App_model->getData('questions',$resultType="count_arr",$arg=['where'=>['permalink'=>$permalink]]);
				if ($checkquestion!=0) {
					responseGenerate(0,"This question already exists , Please choose another title");
				}
			}
			$tags=secureInput($this->input->post('tags'));
			$description=encodeContent(trim($this->input->post('description')));
			
			$this->App_model->updateData('questions',['catid'=>$category,'title'=>encodeContent($title),'permalink'=>$permalink,'tags'=>$tags,'description'=>$description],['qid'=>$qid]);
			
			if ($this->session->role==2) {
				$userQuestion=$questionInfo['userid'];
				if ($userid!=$userQuestion) {
					$editedQuestionsList=$this->App_model->getData('editedQuestionsList',$resultType="count_arr",$arg=['where'=>['qid'=>$qid,'userid'=>$userid]]);
					$on=date('Y-m-d H:i:s');
					if ($editedQuestionsList==0) {
						$this->App_model->insert('editedQuestionsList',['userid'=>$userid,'qid'=>$qid,'on'=>$on],$batch=false);
					} else {
						$this->App_model->updateData('editedQuestionsList',['on'=>$on],['qid'=>$qid,'userid'=>$userid]);
					}
					$getOwnerId=$this->App_model->getData('questions',$resultType="row_array",$arg=['select'=>['userid'],'where'=>['qid'=>$qid]]);
					$for=$getOwnerId['userid'];
					$this->App_model->insert('notifications',['for'=>$for,'by'=>$userid,'qid'=>$qid,'nsId'=>4],$batch=false);
				}
			}
			responseGenerate(1,"Question was successfully updated");
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}

	public function postQuestioncheck()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('question', 'question', 'required|max_length[150]|min_length[1]');
		if ($this->form_validation->run() == true) {
		$question=secureInput($this->input->post('question'));

		$checkabuseword=$this->App_model->checkabuseword($question);

		
			$checkquestion=$this->App_model->checkquestion($question);

			if($checkquestion->num_rows() > 0)
			{
			 responseGenerate(0,"Question Already exit");

			}
			else
			{
			 responseGenerate(1,"Ok");

			}
	

		}
		else
		{
			responseGenerate(3,validation_errors('<p>','</p>'));
		}
	} 
	public function postQuestion()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Question Title', 'required|max_length[150]|min_length[10]');
		$this->form_validation->set_rules('category', 'Question category', 'required');
		$this->form_validation->set_rules('tags', 'Question tags', 'required|max_length[200]');
		$this->form_validation->set_rules('description', 'Question description', 'required|min_length[10]');
		
		if ($this->form_validation->run() == true) {
			$category=secureInput($this->input->post('category'));
			$scategory=secureInput($this->input->post('scategory'));
			$checkCategory=$this->App_model->getData('categories',$resultType="count_arr",$arg=['where'=>['catid'=>$category,'status'=>1]]);
			if ($checkCategory==0) {
				responseGenerate(0,"Invalid category posted");
			}
			
			$title=encodeContent(trim($this->input->post('title')));
			$permalink=format_uri($title);
			
			$checkquestion=$this->App_model->getData('questions',$resultType="count_arr",$arg=['where'=>['permalink'=>$permalink]]);
			if ($checkquestion!=0) {
				responseGenerate(0,"This question already exists , Please choose another title");
			}
			
			$tags=secureInput($this->input->post('tags'));
			$description=encodeContent(trim($this->input->post('description')));
		
			$userid=getuserid();
			
			$permissonCheck=$this->App_model->getData('siteSettings',$resultType="row_array",$arg=['select'=>['adminApproveQuestions']]);
			$permissonCheck=$permissonCheck['adminApproveQuestions']==1;
			if ($permissonCheck) {
				$status=0;
				$html="Question was successfully posted, and is sent for review.<br>As soon as it is approved, you would be notified.<br>Till then it will be only visible to You & Moderator";
			} else 	{
				$status=1;
				$html="Question was successfully posted, redirecting you to the question page";
			}
			
			
			$this->App_model->insert('questions',['userid'=>$userid,'catid'=>$category,'scatid'=>$scategory,'title'=>$title,'status'=>$status,'permalink'=>$permalink,'tags'=>$tags,'description'=>$description],$batch=false);
		
			$qid=$this->db->insert_id();
		
			$link=base_url()."questions/".$qid."/".$permalink;
			
			if ($permissonCheck) {
				$html.=" <br><a href='".$link."'>Click to open posted question</a>";
			}
			
			$result=['type'=>1,'link'=>$link,'html'=>$html];
			echo json_encode($result);
			exit;
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}
	public function postQuestionReply()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('replyTextQ', 'Question Reply', 'required');
		$this->form_validation->set_rules('question', 'Question', 'required');
		
		if ($this->form_validation->run() == true) {
			$userid=getuserid();
			$questionSchema=$this->App_model->getData('questionSchema',$resultType="row_array",$arg=[]);
			$canReplyAfter=$questionSchema['canReplyAfter'];
			
			$votes=$this->App_model->getData('users',$resultType="row_array",$arg=['select'=>['votes'],'where'=>['userid'=>$userid]]);
			$votes=$votes['votes'];
			if (0) {
				responseGenerate(0,"You need ".$canReplyAfter." reputation to reply on this question");
			}
			
			$question=secureInput($this->input->post('question'));
			$checkquestion=$this->App_model->getData('questions',$resultType="count_array",$arg=[]);
			if ($checkquestion==0) {
				responseGenerate(0,"Invalid question being tried to reply");
			}
			
			$replyTextQ=encodeContent(trim($this->input->post('replyTextQ')));
			$replyTime=date('Y-m-d H:i:s');
			$this->App_model->insert('questionsReplies',['userid'=>$userid,'qid'=>$question,'reply'=>$replyTextQ,'on'=>$replyTime],$batch=false);
			$qrid=$this->db->insert_id();
			
			$getOwnerId=$this->App_model->getData('questions',$resultType="row_array",$arg=['select'=>['userid'],'where'=>['qid'=>$question]]);
			$for=$getOwnerId['userid'];
			$this->App_model->insert('notifications',['for'=>$for,'by'=>$userid,'qid'=>$question,'qrid'=>$qrid,'nsId'=>2],$batch=false);
			
			$viewHmtl=['qrid'=>$qrid,'replyTime'=>$replyTime,'replyTextQ'=>$replyTextQ];
			responseGenerate(1,$this->load->view('replyTemplateQ',$viewHmtl,true));
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}
	public function postEditQuestionReply()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('qrid', 'Question Reply', 'required');
		$this->form_validation->set_rules('replyTextQ', 'Question Reply', 'required');
		$this->form_validation->set_rules('question', 'Question', 'required');
		
		if ($this->form_validation->run() == true) {
			$userid=getuserid();
			$questionSchema=$this->App_model->getData('questionSchema',$resultType="row_array",$arg=[]);
			$canReplyAfter=$questionSchema['canReplyAfter'];
			
			$votes=$this->App_model->getData('users',$resultType="row_array",$arg=['select'=>['votes'],'where'=>['userid'=>$userid]]);
			$votes=$votes['votes'];
			if (0) {
				responseGenerate(0,"You need ".$canReplyAfter." reputation to reply on this question");
			}
			
			$question=secureInput($this->input->post('question'));
			$checkquestion=$this->App_model->getData('questions',$resultType="count_array",$arg=[]);
			if ($checkquestion==0) {
				responseGenerate(0,"Invalid question being tried to reply");
			}
			
			$qrid=(int) secureInput($this->input->post('qrid'));
			$checkquestionr=$this->App_model->getData('questionsReplies',$resultType="count_array",$arg=['where'=>['userid'=>$userid,'qrid'=>$qrid]]);
			if ($checkquestionr==0) {
				responseGenerate(0,"The reply you are trying to edit appears to be deleted or its not yours");
			}
			
			$replyTextQ=encodeContent(trim($this->input->post('replyTextQ')));
			$replyTime=date('Y-m-d H:i:s');
			
			$this->App_model->updateData('questionsReplies',['reply'=>$replyTextQ,'on'=>$replyTime],['userid'=>$userid,'qrid'=>$qrid,'on'=>$replyTime]);
			
			responseGenerate(1,"Successfully Updated");
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}
	public function postEditAnswerReply()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('arid', 'Answer Reply', 'required');
		$this->form_validation->set_rules('replyTextA', 'Answer Reply', 'required');
		if ($this->form_validation->run() == true) {
			$userid=getuserid();
			$questionSchema=$this->App_model->getData('questionSchema',$resultType="row_array",$arg=[]);
			$canReplyAfter=$questionSchema['canReplyAfter'];
			
			$votes=$this->App_model->getData('users',$resultType="row_array",$arg=['select'=>['votes'],'where'=>['userid'=>$userid]]);
			$votes=$votes['votes'];
			if (0) {
				responseGenerate(0,"You need ".$canReplyAfter." reputation to reply on this answer");
			}
			
			$arid=(int) secureInput($this->input->post('arid'));
			$checkquestiona=$this->App_model->getData('awnserReplies',$resultType="count_array",$arg=['where'=>['userid'=>$userid,'arid'=>$arid]]);
			if ($checkquestiona==0) {
				responseGenerate(0,"The reply you are trying to edit appears to be deleted or its not yours");
			}
			
			$replyTextA=encodeContent(trim($this->input->post('replyTextA')));
			$replyTime=date('Y-m-d H:i:s');
			
			$this->App_model->updateData('awnserReplies',['reply'=>$replyTextA,'on'=>$replyTime],['userid'=>$userid,'arid'=>$arid,'on'=>$replyTime]);
			
			responseGenerate(1,"Successfully Updated");
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}
	
	public function postReportAnswer()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$userid=getuserid();
		
		$answerid=secureInput($this->input->post('answerid'));
		$checkanswer=$this->App_model->getData('awnsers',$resultType="count_array",$arg=['where'=>['qaid'=>$answerid]]);
		if ($checkanswer==0) {
			responseGenerate(0,"Invalid answer being tried to report");
		}
		
		$reportedReason=secureInput($this->input->post('reportedReason'));
		
		$checkrsid=$this->App_model->getData('reportSchema',"count_array",$arg=['rsid'=>$reportedReason]);
		if ($checkrsid==0)
		responseGenerate(0,"Invalid reason selected for reporting");
		
		$insert=['userid'=>$userid,'qaid'=>$answerid,'rsid'=>$reportedReason,'on'=>date('Y-m-d H:i:s')];
		
		$getOwnerId=$this->App_model->getData('awnsers',$resultType="row_array",$arg=['select'=>['userid','qid'],'where'=>['qaid'=>$answerid]]);
		$for=$getOwnerId['userid'];
		$qid=$getOwnerId['qid'];
		$this->App_model->insert('notifications',['qid'=>$qid,'for'=>$for,'by'=>$userid,'qaid'=>$answerid,'nsId'=>2],$batch=false);
		
		$this->App_model->insert('reportedAnswers',$insert,$batch=false);
		responseGenerate(1,"Answer was successfully reported");
	}
	public function postReportQreply()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$userid=getuserid();
		$qrid=secureInput($this->input->post('qrid'));
		$checkQuestionReply=$this->App_model->getData('questionsReplies',$resultType="count_array",$arg=['where'=>['qrid'=>$qrid]]);
		if ($checkQuestionReply==0) {
			responseGenerate(0,"Invalid question's reply being tried to report");
		}
		
		$reportedReason=secureInput($this->input->post('reportedReason'));
		if (strlen($reportedReason)==0) {
			responseGenerate(0,"Please select a reason");	
		}
		$rsid=(int) $reportedReason;
		$checkrsid=$this->App_model->getData('reportSchema',"count_array",$arg=['where'=>['rsid'=>$rsid]]);
		if ($checkrsid==0) {
			responseGenerate(0,"Invalid reason selected for reporting");
		}
		$checkrsid=$this->App_model->getData('reportedReplies',"count_array",$arg=['where'=>['userid'=>$userid,'qrid'=>$qrid]]);
		
		if ($checkrsid>0) {
			responseGenerate(0,"You have already reported this reply");
		}
		$insert[]=['userid'=>$userid,'qrid'=>$qrid,'rsid'=>$rsid];
		
		$getOwnerId=$this->App_model->getData('questionsReplies',$resultType="row_array",$arg=['select'=>['userid','qid'],'where'=>['qrid'=>$qrid]]);
		$for=$getOwnerId['userid'];
		$qid=$getOwnerId['qid'];
		$this->App_model->insert('notifications',['qid'=>$qid,'for'=>$for,'by'=>$userid,'qrid'=>$qrid,'nsId'=>8],$batch=false);
		
		$this->App_model->insert('reportedReplies',$insert,$batch=true);
		responseGenerate(1,"Question reply was successfully reported");
	}
	
	public function postDelAnswer()
	{
		if (!checksession())
		responseGenerate(2,"Please login to continue");
	
		$userid=getuserid();
		$question=secureInput($this->input->post('question'));
		$checkquestion=$this->App_model->getData('questions',$resultType="count_array",$arg=[]);
		if ($checkquestion==0) {
			responseGenerate(0,"Invalid question's answer being tried to deleted");
		}
		
		$answerid=secureInput($this->input->post('answerid'));
		$checkanswer=$this->App_model->getData('awnsers',$resultType="count_array",$arg=['where'=>['qaid'=>$answerid,'userid'=>$userid]]);
		if ($checkanswer==0) {
			responseGenerate(0,"Invalid answer being tried to deleted");
		}
		$this->QuestionsModel->decAwnser($question);
		$this->App_model->deleteData('awnsers',$where=['qaid'=>$answerid,'userid'=>$userid]);
		responseGenerate(1,"Answer was successfully deleted");
	}
	
	public function postDelQuestion()
	{
		if (!checksession())
		responseGenerate(2,"Please login to continue");
	
		$qid=(int) secureInput($this->input->post('qid'));
		
		$where=['qid'=>$qid];
		if ($this->session->role!=2) {
			$where['userid']=getuserid();
		}
		
		$checkquestion=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>$where]);
		if ($checkquestion==0) {
			responseGenerate(0,"Invalid question being tried to deleted");
		}
		
		$this->App_model->deleteData('questions',$where);
		responseGenerate(1,"Question was successfully deleted");
	}
	
	public function postDelAnswerReply()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$userid=getuserid();
		$arid=secureInput($this->input->post('arid'));
		$checkAnswerReply=$this->App_model->getData('awnserReplies',$resultType="count_array",$arg=['where'=>['userid'=>$userid,'arid'=>$arid]]);
		if ($checkAnswerReply==0) {
			responseGenerate(0,"Invalid answer reply being tried to deleted");
		}
		
		$this->App_model->deleteData('awnserReplies',$where=['arid'=>$arid,'userid'=>$userid]);
		responseGenerate(1,"Answer reply was successfully deleted");
	}
	public function postDelQuestionReply()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$userid=getuserid();
		$qrid=secureInput($this->input->post('qrid'));
		$checkquestionR=$this->App_model->getData('questionsReplies',$resultType="count_array",$arg=['where'=>['qrid'=>$qrid,'userid'=>$userid]]);
		if ($checkquestionR==0) {
			responseGenerate(0,"Invalid question reply being tried to deleted");
		}
		
		$this->App_model->deleteData('questionsReplies',$where=['qrid'=>$qrid,'userid'=>$userid]);
		responseGenerate(1,"Question reply was successfully deleted");
	}
	
	public function postQuestionAnswerReply()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('question', 'Question', 'required');
		$this->form_validation->set_rules('answerReply', 'Answer Reply', 'required');
		$this->form_validation->set_rules('answerid', 'Awnser', 'required');
		
		if ($this->form_validation->run() == true) {
			$userid=getuserid();
			$questionSchema=$this->App_model->getData('questionSchema',$resultType="row_array",$arg=[]);
			$canReplyAfter=$questionSchema['canReplyAfter'];
			
			$votes=$this->App_model->getData('users',$resultType="row_array",$arg=['select'=>['votes'],'where'=>['userid'=>$userid]]);
			$votes=$votes['votes'];
			if (0) {
				responseGenerate(0,"You need ".$canReplyAfter." reputation to reply on this Answer");
			}
			
			$question=secureInput($this->input->post('question'));
			$checkquestion=$this->App_model->getData('questions',$resultType="count_array",$arg=[]);
			if ($checkquestion==0) {
				responseGenerate(0,"Invalid question's answer being tried to reply");
			}
			
			$answerid=secureInput($this->input->post('answerid'));
			$checkanswer=$this->App_model->getData('awnsers',$resultType="count_array",$arg=[]);
			if ($checkanswer==0) {
				responseGenerate(0,"Invalid answer being tried to reply");
			}
			
			$answerReply=encodeContent(trim($this->input->post('answerReply')));
			$replyTime=date('Y-m-d H:i:s');
			$this->App_model->insert('awnserReplies',['userid'=>$userid,'qid'=>$question,'qaid'=>$answerid,'reply'=>$answerReply,'on'=>$replyTime],$batch=false);
			$arid=$this->db->insert_id();
			$viewHmtl=['arid'=>$arid,'replyTime'=>$replyTime,'replyTextQ'=>$answerReply];
			
			$getOwnerId=$this->App_model->getData('questions',$resultType="row_array",$arg=['select'=>['userid'],'where'=>['qid'=>$question]]);
			$for=$getOwnerId['userid'];
			$this->App_model->insert('notifications',['qid'=>$question,'for'=>$for,'by'=>$userid,'arid'=>$arid,'nsId'=>3],$batch=false);
			
			responseGenerate(1,$this->load->view('replyTemplateA',$viewHmtl,true));
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}
	
	public function postQuestionAnswer()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('answerEditor', 'Question Answer', 'required');
		$this->form_validation->set_rules('question', 'Question', 'required');
		
		if ($this->form_validation->run() == true) {
			$userid=getuserid();
			
			$question=secureInput($this->input->post('question'));
			$checkquestion=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['qid'=>$question]]);
			if ($checkquestion==0) {
				responseGenerate(0,"Invalid question being tried to reply");
			}
			$recentBadges=$this->App_model->getData('awardedBadges',$resultType="row_array",$arg=['select'=>['badges.name'],'limit'=>[1,0],'where'=>['awardedBadges.userid'=>$userid],'order'=>['col'=>'badges.on','type'=>'desc'],'join'=>['table'=>'badges','query'=>'awardedBadges.badgeId=badges.badgeId','type'=>'inner']]);
			$answerEditor=encodeContent(trim($this->input->post('answerEditor')));
			$awnswerTime=date('Y-m-d H:i:s');
			$this->App_model->insert('awnsers',['userid'=>$userid,'qid'=>$question,'description'=>$answerEditor,'on'=>$awnswerTime],$batch=false);
			$qaid=$this->db->insert_id();
			
			$this->QuestionsModel->incAwnser($question);
			
			$getOwnerId=$this->App_model->getData('questions',$resultType="row_array",$arg=['select'=>['userid','permalink'], 'where'=>['qid'=>$question]]);
			$for=$getOwnerId['userid'];
			
			$getpermalink=$getOwnerId['permalink'];
			
			$getOwnerEmail=$this->App_model->getData('users',$resultType="row_array",$arg=['select'=>['email'],'where'=>['userid'=>$for]]);
			$questionOwnerEmail=$getOwnerEmail['email'];
			
			
			$link=base_url().'questions/'.$question.'/'.$getpermalink;
			$message='YOu have a new answer for your question '.$link.'';
			sendEmail($questionOwnerEmail,$message,"You have received new reply");
			
			$this->App_model->insert('notifications',['qid'=>$question,'for'=>$for,'by'=>$userid,'qaid'=>$qaid,'nsId'=>1],$batch=false);
			$viewHmtl=['recentBadges'=>$recentBadges,'qaid'=>$qaid,'awnswerTime'=>$awnswerTime,'answerEditor'=>$answerEditor];
			responseGenerate(1,$this->load->view('awnserTemplate',$viewHmtl,true));
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}
	
	public function postEditAnswer()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('answer', "Question's Answer", 'required');
		$this->form_validation->set_rules('answerid', 'Answer', 'required');
		if ($this->form_validation->run() == true) {
			$userid=getuserid();
			$answerid=secureInput($this->input->post('answerid'));
			$checkanswer=$this->App_model->getData('awnsers',$resultType="count_array",$arg=['where'=>['qaid'=>$answerid,'userid'=>$userid]]);
			if ($checkanswer==0) {
				responseGenerate(0,"Invalid answer being tried to edit");
			}
			
			$answer=encodeContent(trim($this->input->post('answer')));
			$awnswerTime=date('Y-m-d H:i:s');
			$this->App_model->updateData('awnsers',['description'=>$answer,'on'=>$awnswerTime],['userid'=>$userid,'qaid'=>$answerid]);
			
			responseGenerate(1,"Answer was successfully edited");
		} else {
			responseGenerate(0,validation_errors('<p>','</p>'));
		}
	}
	public function postImagesToEmbed()
	{
		if (!checksession()) {
			responseGenerate(2,"Please login to continue");
		}
		
		$getSettings=$this->App_model->getData('siteSettings',$resultType="row_array",$arg=['select'=>['imgurClientId']]);
		if(strlen($getSettings['imgurClientId'])==0)
		{
			responseGenerate(0,"There is some error in the configuration, Please try again later");
		}
		
		if (isset($_FILES['image'])) {
			if ($_FILES['image']['error']==0) {
				$client_id=$getSettings['imgurClientId'];
				$filetype = explode('/',mime_content_type($_FILES['image']['tmp_name']));
				if ($filetype[0] !== 'image') {
					die('Invalid image type');
				}
				$image = file_get_contents($_FILES['image']['tmp_name']);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Authorization: Client-ID $client_id" ));
				curl_setopt($ch, CURLOPT_POSTFIELDS, array( 'image' => base64_encode($image) ));
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$dataReturned = curl_exec($ch);
				curl_close($ch);
				$dataReturned = json_decode($dataReturned,true);
				if (isset($dataReturned['data']))
				{
					$imgGet=$dataReturned['data'];
					if(array_key_exists('link',$imgGet))
					{
						$imgCreate='<img src="'.$imgGet['link'].'"/>';
						$result=['type'=>1,'link'=>encodeContent($imgCreate),'html'=>"Image was successfully uploaded"];
						echo json_encode($result);
					} else {
						responseGenerate(0,"Unable to upload image as server is busy, Pleas try again later");
					}
				} else {
					responseGenerate(0,"Unable to upload image as server is busy, Pleas try again later");
				}
			} else {
				responseGenerate(2,"This file is corrupted , Please chose another");
			}
		} else {
			responseGenerate(2,"Please choose an image to upload");
		}
	}
}