<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends CI_Model 
{
	protected $table = 'blog';
	function __construct() {
		parent::__construct();
	   $this->lang->load('basic', $this->config->item('language'));

	}
	public function blog()
		 {
			$this->db->select('*');
			$this->db->from('Blog');
			$query=$this->db->get();
			return $query->result_array(); 
		 }	
		 public function blogs($id)
		 {
			$this->db->select('*');
			$this->db->from('Blog');
			$this->db->where('id',$id);
			$query=$this->db->get();
			return $query->result_array(); 
		 }	
		 public function comments($id)
		 {
			$this->db->select('*');
			$this->db->from('blog_comment');
			$this->db->where('comment_id',$id);
			$query=$this->db->get();
			return $query->result_array(); 
			
		 }

// category function start
 function category_list(){
	 $this->db->order_by('cid','desc');
	 $query=$this->db->get('exam_cate');
	 return $query->result_array();
	 
 }

function insert_category(){
	 
	 	$userdata=array(
		'category_name'=>$this->input->post('category_name'),
			);
		
		if($this->db->insert('exam_cate',$userdata)){
			
			return true;
		}else{
			
			return false;
		}
	 
 }


 function remove_category($cid){
	 
	 $this->db->where('cid',$cid);
	 if($this->db->delete('exam_cate')){
		 return true;
	 }else{
		 
		 return false;
	 }
	 
	 
 }
 
 // level l
function level_list(){
	  $query=$this->db->get('exam_level');
	 return $query->result_array();
	 
 }
 
 
 
 
 function update_level($lid){
	 
		$userdata=array(
		'level_name'=>$this->input->post('level_name'),
		 	
		);
	 
		 $this->db->where('lid',$lid);
		if($this->db->update('exam_level',$userdata)){
			
			return true;
		}else{
			
			return false;
		}
	 
 }
  
 
 
 function remove_level($lid){
	 
	 $this->db->where('lid',$lid);
	 if($this->db->delete('exam_level')){
		 return true;
	 }else{
		 
		 return false;
	 }
	 
	 
 }
 
  
 
 function insert_level(){
	 
	 	$userdata=array(
		'level_name'=>$this->input->post('level_name'),
			);
		
		if($this->db->insert('exam_level',$userdata)){
			
			return true;
		}else{
			
			return false;
		}
	 
 }
 
 // level function end
 

// Exam question 


function get_question($qid){
	 $this->db->where('qid',$qid);
	 $query=$this->db->get('exam_qbank');
	 return $query->row_array();
	 
	 
 }
 function get_option($qid){
	 $this->db->where('qid',$qid);
	 $query=$this->db->get('exam_options');
	 return $query->result_array();
	 
	 
 }
 
 function remove_question($qid){
	 
	 $this->db->where('qid',$qid);
	 if($this->db->delete('exam_qbank')){
		  $this->db->where('qid',$qid);
			$this->db->delete('exam_options');
			
						
	$qr=$this->db->query("select * from exam_quiz where FIND_IN_SET($qid, qids) ");
	 
			foreach($qr->result_array() as $k =>$val){
			
			$quid=$val['quid'];
			$qids=explode(',',$val['qids']);
			$nqids=array();
			foreach($qids as $qk => $qv){
			if($qv != $qid){
			$nqids[]=$qv;
			}
			}
			$noq=count($nqids);
			$nqids=implode(',',$nqids);
			$this->db->query(" update exam_quiz set qids='$nqids', noq='$noq' where quid='$quid' ");
			}
			
			
		 return true;
	 }else{
		 
		 return false;
	 }
	 
	 
 }
 
 function insert_question_1(){
	 

	  
	 $userdata=array(
	 'paragraph'=>$this->input->post('paragraph'),
	 'question'=>$this->input->post('question'),
	 'description'=>$this->input->post('description'),
	 'question_type'=>$this->lang->line('multiple_choice_single_answer'),
	 'cid'=>$this->input->post('cid'),
	 'lid'=>$this->input->post('lid')	 
	 );
	  $logged_in=$this->session->userdata('logged_in');
	  $uid='1';
	  $fname='Admin';
	  $userdata['inserted_by']=1;
	  $userdata['inserted_by_name']='Studymate';
	  
	  $lang=$this->config->item('question_lang');
	  foreach($lang as $lk => $lv){
		  if($lk > 0){
		  if($this->input->post('question'.$lk)){
				$userdata['paragraph'.$lk]=$this->input->post('paragraph'.$lk); 
				$userdata['question'.$lk]=$this->input->post('question'.$lk); 
					$userdata['description'.$lk]=$this->input->post('description'.$lk); 
			}	 
		  }		  
	  }
	  
	 $this->db->insert('exam_qbank',$userdata);
	 $qid=$this->db->insert_id();
	 $this->session->set_flashdata('qid',$qid);
	 foreach($this->input->post('option') as $key => $val){
		 if($this->input->post('score')==$key){
			 $score=1;
		 }else{
			 $score=0;
		 }
	$userdata=array(
	 'q_option'=>$val,
	 'qid'=>$qid,
	 'score'=>$score,
	 );
	  $lang=$this->config->item('question_lang');
	  foreach($lang as $lk => $lv){
		   
		  if($lk > 0){
			   
		  if(isset($_POST['option'.$lk])){
			  print_r($this->input->post('option1'));
			  $eopo=$this->input->post('option'.$lk);
				$userdata['q_option'.$lk]=$eopo[$key];  
			}	 
		  }		  
	  }
	  
	  
	 $this->db->insert('exam_options',$userdata);	 
		 
	 }
	 
	 return true;
	 
 }


 function insert_question_2(){
	 
	 
	 $userdata=array(
	 'paragraph'=>$this->input->post('paragraph'),
	 	 'question'=>$this->input->post('question'),
	 'description'=>$this->input->post('description'),
	 'question_type'=>$this->lang->line('multiple_choice_multiple_answer'),
	 'cid'=>$this->input->post('cid'),
	 'lid'=>$this->input->post('lid')	 
	 );
	  $logged_in=$this->session->userdata('logged_in');
	 	  $uid='1';
	  $fname='Admin';
	  $userdata['inserted_by']=1;
	  $userdata['inserted_by_name']='Studymate';
 
	 $this->db->insert('exam_qbank',$userdata);
	 $qid=$this->db->insert_id();
	 $this->session->set_flashdata('qid',$qid);
	 foreach($this->input->post('option') as $key => $val){
		 if(in_array($key,$this->input->post('score'))){
			 $score=(1/count($this->input->post('score')));
		 }else{
			 $score=0;
		 }
	$userdata=array(
	 'q_option'=>$val,
	 'qid'=>$qid,
	 'score'=>$score,
	 );
	 $this->db->insert('exam_options',$userdata);	 
		 
	 }
	 
	 return true;
	 
 }
 
 
 function insert_question_3(){
	 
	 
	 $userdata=array(
	  'paragraph'=>$this->input->post('paragraph'),
	 'question'=>$this->input->post('question'),
	 'description'=>$this->input->post('description'),
	 'question_type'=>$this->lang->line('match_the_column'),
	 'cid'=>$this->input->post('cid'),
	 'lid'=>$this->input->post('lid')	 
	 );
	 	  $logged_in=$this->session->userdata('logged_in');
	 	  $uid='1';
	  $fname='Admin';
	  $userdata['inserted_by']=1;
	  $userdata['inserted_by_name']='Studymate';

	 $this->db->insert('exam_qbank',$userdata);
	 $qid=$this->db->insert_id();
	 $this->session->set_flashdata('qid',$qid);
	 foreach($this->input->post('option') as $key => $val){
	  $score=(1/count($this->input->post('option')));
	$userdata=array(
	 'q_option'=>$val,
	 'q_option_match'=>$_POST['option2'][$key],
	 'qid'=>$qid,
	 'score'=>$score,
	 );
	 $this->db->insert('exam_options',$userdata);	 
		 
	 }
	 
	 return true;
	 
 }
 
 
 
 
 function insert_question_4(){
	 
	 
	 $userdata=array(
	  'paragraph'=>$this->input->post('paragraph'),
	 'question'=>$this->input->post('question'),
	 'description'=>$this->input->post('description'),
	 'question_type'=>$this->lang->line('short_answer'),
	 'cid'=>$this->input->post('cid'),
	 'lid'=>$this->input->post('lid')	 
	 );
	 	  $logged_in=$this->session->userdata('logged_in');
	  
	  	  $uid='1';
	  $fname='Admin';
	  $userdata['inserted_by']=1;
	  $userdata['inserted_by_name']='Studymate';


	 $this->db->insert('exam_qbank',$userdata);
	 $qid=$this->db->insert_id();
	 $this->session->set_flashdata('qid',$qid);
	 foreach($this->input->post('option') as $key => $val){
	  $score=1;
	$userdata=array(
	 'q_option'=>$val,
	 'qid'=>$qid,
	 'score'=>$score,
	 );
	 $this->db->insert('exam_options',$userdata);	 
		 
	 }
	 
	 return true;
	 
 }
 
 
 function insert_question_5(){
	 
	 
	 $userdata=array(
	  'paragraph'=>$this->input->post('paragraph'),
	 'question'=>$this->input->post('question'),
	 'description'=>$this->input->post('description'),
	 'question_type'=>$this->lang->line('long_answer'),
	 'cid'=>$this->input->post('cid'),
	 'lid'=>$this->input->post('lid')	 
	 );
	 	  $logged_in=$this->session->userdata('logged_in');
		  $uid='1';
	  $fname='Admin';
	  $userdata['inserted_by']=1;
	  $userdata['inserted_by_name']='Studymate';

	 $this->db->insert('exam_qbank',$userdata);
	 $qid=$this->db->insert_id();
	 $this->session->set_flashdata('qid',$qid);
	 
	 return true;
	 
 }


 
  function update_question_1($qid){
	 
	 
	 $userdata=array(
	  'paragraph'=>$this->input->post('paragraph'),
	 'question'=>$this->input->post('question'),
	 'description'=>$this->input->post('description'),
	 'question_type'=>$this->lang->line('multiple_choice_single_answer'),
	 'cid'=>$this->input->post('cid'),
	 'lid'=>$this->input->post('lid')	 
	 );
	 	  $lang=$this->config->item('question_lang');
	  foreach($lang as $lk => $lv){
		  if($lk > 0){
		  if($this->input->post('question'.$lk)){
				$userdata['paragraph'.$lk]=$this->input->post('paragraph'.$lk); 
				$userdata['question'.$lk]=$this->input->post('question'.$lk); 
					$userdata['description'.$lk]=$this->input->post('description'.$lk); 
			}	 
		  }		  
	  }
	 $this->db->where('qid',$qid);
	 $this->db->update('exam_qbank',$userdata);
	 $this->db->where('qid',$qid);
	$this->db->delete('exam_options');
	 foreach($this->input->post('option') as $key => $val){
		 
		 
		 if($this->input->post('score')==$key){
			 $score=1;
		 }else{
			 $score=0;
		 }
	$userdata=array(
	 'q_option'=>$val,
	 'qid'=>$qid,
	 'score'=>$score,
	 );
	   $lang=$this->config->item('question_lang');
	  foreach($lang as $lk => $lv){
		   
		  if($lk > 0){
			   
		  if(isset($_POST['option'.$lk])){
			  print_r($this->input->post('option1'));
			  $eopo=$this->input->post('option'.$lk);
				$userdata['q_option'.$lk]=$eopo[$key];  
			}	 
		  }		  
	  }
	 $this->db->insert('exam_options',$userdata);	 
		 
	 }
	 
	 return true;
	 
 }
 

 
  function update_question_2($qid){
	 
	 
	 $userdata=array(
	  'paragraph'=>$this->input->post('paragraph'),
	 'question'=>$this->input->post('question'),
	 'description'=>$this->input->post('description'),
	 'question_type'=>$this->lang->line('multiple_choice_multiple_answer'),
	 'cid'=>$this->input->post('cid'),
	 'lid'=>$this->input->post('lid')	 
	 );
	 $this->db->where('qid',$qid);
	 $this->db->update('exam_qbank',$userdata);
	 $this->db->where('qid',$qid);
	$this->db->delete('exam_options');
	 foreach($this->input->post('option') as $key => $val){
		 if(in_array($key,$this->input->post('score'))){
			 $score=(1/count($this->input->post('score')));
		 }else{
			 $score=0;
		 }
	$userdata=array(
	 'q_option'=>$val,
	 'qid'=>$qid,
	 'score'=>$score,
	 );
	 $this->db->insert('exam_options',$userdata);	 
		 
	 }
	 
	 return true;
	 
 }
 
 
 function update_question_3($qid){
	 
	 
	 $userdata=array(
	  'paragraph'=>$this->input->post('paragraph'),
	 'question'=>$this->input->post('question'),
	 'description'=>$this->input->post('description'),
	 'question_type'=>$this->lang->line('match_the_column'),
	 'cid'=>$this->input->post('cid'),
	 'lid'=>$this->input->post('lid')	 
	 );
	 	 $this->db->where('qid',$qid);
	 $this->db->update('exam_qbank',$userdata);
	 $this->db->where('qid',$qid);
	$this->db->delete('exam_options');
	foreach($this->input->post('option') as $key => $val){
	  $score=(1/count($this->input->post('option')));
	$userdata=array(
	 'q_option'=>$val,
	 'q_option_match'=>$_POST['option2'][$key],
	 'qid'=>$qid,
	 'score'=>$score,
	 );
	 $this->db->insert('exam_options',$userdata);	 
		 
	 }
	 
	 return true;
	 
 }
 
 
 
 
 function update_question_4($qid){
	 
	 
	 $userdata=array(
	 'paragraph'=>$this->input->post('paragraph'),
	  'question'=>$this->input->post('question'),
	 'description'=>$this->input->post('description'),
	 'question_type'=>$this->lang->line('short_answer'),
	 'cid'=>$this->input->post('cid'),
	 'lid'=>$this->input->post('lid')	 
	 );
		 $this->db->where('qid',$qid);
	 $this->db->update('exam_qbank',$userdata);
	 $this->db->where('qid',$qid);
	$this->db->delete('exam_options');
 foreach($this->input->post('option') as $key => $val){
	  $score=1;
	$userdata=array(
	 'q_option'=>$val,
	 'qid'=>$qid,
	 'score'=>$score,
	 );
	 $this->db->insert('exam_options',$userdata);	 
		 
	 }
	 
	 return true;
	 
 }
 
 
 function update_question_5($qid){
	 
	 
	 $userdata=array(
	  'paragraph'=>$this->input->post('paragraph'),
	 'question'=>$this->input->post('question'),
	 'description'=>$this->input->post('description'),
	 'question_type'=>$this->lang->line('long_answer'),
	 'cid'=>$this->input->post('cid'),
	 'lid'=>$this->input->post('lid')	 
	 );
		 $this->db->where('qid',$qid);
	 $this->db->update('exam_qbank',$userdata);
	 $this->db->where('qid',$qid);
	$this->db->delete('exam_options');

	 
	 return true;
	 
 }
 

  function add_qid($quid,$qid){
	 
	 $this->db->where('quid',$quid);
	 $query=$this->db->get('exam_quiz');
	 $quiz=$query->row_array();
	 $new_qid=array();
	 foreach(explode(',',$quiz['qids']) as $key => $oqid){
		 
		 if($oqid != $qid){
			$new_qid[]=$oqid; 
			 
		 }
		 
	 }
	 $new_qid[]=$qid;
	 
	 $new_qid=array_filter(array_unique($new_qid));
	 $noq=count($new_qid);
	 $userdata=array(
	 'qids'=>implode(',',$new_qid),
	 'noq'=>$noq
	 
	 );
	 $this->db->where('quid',$quid);
	 $this->db->update('exam_quiz',$userdata);
	 return true;
 }
 
 
 function question_list($limit,$cid='0',$lid='0'){
	 if($this->input->post('search')){
		 $search=$this->input->post('search');
		 $this->db->or_where('exam_qbank.qid',$search);
		 $this->db->or_like('exam_qbank.question',$search);
		 $this->db->or_like('exam_qbank.description',$search);

	 }
	 if($cid!='0'){
		  $this->db->where('exam_qbank.cid',$cid);
	 }
	 if($lid!='0'){
		  $this->db->where('exam_qbank.lid',$lid);
	 }
	 // if($logged_in['uid'] != '1'){
	 // $uid=$logged_in['uid'];
	 // $this->db->where('exam_qbank.inserted_by',$uid);
	 // }
		 $this->db->join('exam_cate','exam_cate.cid=exam_qbank.cid');
	 $this->db->join('exam_level','exam_level.lid=exam_qbank.lid');
	 $this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('exam_qbank.qid','desc');
		$query=$this->db->get('exam_qbank');
		return $query->result_array();
		
	 
 }
   function open_quiz($limit){
	  
	 
		$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('quid','desc');
		$query=$this->db->get('exam_quiz');
		return $query->result_array();
}
function quiz_list1(){
	 $this->db->order_by('quid','desc');
$query=$this->db->get('exam_quiz');	
return $query->result_array();	 
 }
 
function quiz_list($limit,$stat=''){
	  
	  
	 
			// $logged_in=$this->session->userdata('logged_in');
   //                      $acp=explode(',',$logged_in['quiz']);
			// if(!in_array('List_all',$acp)){
			// $gid=$logged_in['gid'];
			// $uid=$logged_in['uid'];
			// $query=$this->db->query("select * from savsoft_users where uid='$uid' ");
			// 	$user=$query->row_array();
			// 	$gid=explode(',',$user['gid']);
			// 	$vgid=implode('|',$gid);
			// // $where="FIND_IN_SET('".$gid."', gids) or FIND_IN_SET('".$uid."', uids)";  
			// $where='CONCAT(",",gids, ",") REGEXP ",('.$vgid.'),"';
			//  $this->db->where($where);			 
			// }	
			
	 if($this->input->post('search') && in_array('List_all',$acp)){
		 $search=$this->input->post('search');
		 $this->db->or_where('quid',$search);
		 $this->db->or_like('quiz_name',$search);
		 $this->db->or_like('description',$search);

	 }
	 
	 // if($logged_in['uid'] != '1' && $logged_in['inserted_by']!='0' ){
	 // $uid=$logged_in['inserted_by'];
	 // $this->db->where('exam_quiz.inserted_by',$uid);
	 // }
	    if($stat=="active"){
	  $where=' end_date >= "'.time().'" ';
	   $this->db->where($where);
	  }
	  if($stat=="archived"){
	  $where=' end_date < "'.time().'" ';
	   $this->db->where($where);
	  }
	  if($stat=="upcoming"){
	  $where=' start_date >= "'.time().'" ';
	   $this->db->where($where);
	  }
	 
		 $this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('quid','desc');
		$query=$this->db->get('exam_quiz');
		 return $query->result_array();
		
	 
 }
  function quizstat($stat){
	
	  // $logged_in=$this->session->userdata('logged_in');
	 
			// $logged_in=$this->session->userdata('logged_in');
   //                      $acp=explode(',',$logged_in['quiz']);
			// if(!in_array('List_all',$acp)){
			// $gid=$logged_in['gid'];
			// $uid=$logged_in['uid'];
			// $query=$this->db->query("select * from savsoft_users where uid='$uid' ");
			// 	$user=$query->row_array();
			// 	$gid=explode(',',$user['gid']);
			// 	$vgid=implode('|',$gid);
			// // $where="FIND_IN_SET('".$gid."', gids) or FIND_IN_SET('".$uid."', uids)";  
			// $where='CONCAT(",",gids, ",") REGEXP ",('.$vgid.'),"';
			//  $this->db->where($where);			 
			// }	
			
	 if($this->input->post('search') && in_array('List_all',$acp)){
		 $search=$this->input->post('search');
		 $this->db->or_where('quid',$search);
		 $this->db->or_like('quiz_name',$search);
		 $this->db->or_like('description',$search);

	 }
	 
	 // if($logged_in['uid'] != '1' && $logged_in['inserted_by']!='0' ){
	 // $uid=$logged_in['inserted_by'];
	 // $this->db->where('exam_quiz.inserted_by',$uid);
	 // }
	  if($stat=="active"){
	  $where=' end_date >= "'.time().'" ';
	  }
	  if($stat=="archived"){
	  $where=' end_date < "'.time().'" ';
	  }
	  if($stat=="upcoming"){
	  $where=' start_date >= "'.time().'" ';
	  }
	  $this->db->where($where);
	  
		 $this->db->order_by('quid','desc');
		$query=$this->db->get('exam_quiz');
		 return $query->num_rows();
		
		
	 
 }
 function remove_quiz($quid){
	 
	 $this->db->where('quid',$quid);
	 if($this->db->delete('exam_quiz')){
		 
		 return true;
	 }else{
		 
		 return false;
	 }
	 
	 
 }
 

// End add exam quesion


 //Quiz


 function insert_quiz(){
	 
	 $userdata=array(
	 'quiz_name'=>$this->input->post('quiz_name'),
	 'description'=>$this->input->post('description'),
	 'start_date'=>strtotime($this->input->post('start_date')),
	 'end_date'=>strtotime($this->input->post('end_date')),
	 'duration'=>$this->input->post('duration'),
	 'maximum_attempts'=>$this->input->post('maximum_attempts'),
	 'pass_percentage'=>$this->input->post('pass_percentage'),
	 'correct_score'=>$this->input->post('correct_score'),
	 'incorrect_score'=>$this->input->post('incorrect_score'),
	 'ip_address'=>$this->input->post('ip_address'),
	 'view_answer'=>$this->input->post('view_answer'),
	 'camera_req'=>$this->input->post('camera_req'),
	 'quiz_template'=>$this->input->post('quiz_template'),
	 'quiz_price'=>$this->input->post('quiz_price'),
	 'with_login'=>$this->input->post('with_login'),
	 'show_chart_rank'=>$this->input->post('show_chart_rank'),
	 'gids'=>implode(',',$this->input->post('gids')),
	 'uids'=>implode(',',$this->input->post('uids')),
	 'question_selection'=>$this->input->post('question_selection')
	 );
	 	$userdata['gen_certificate']=$this->input->post('gen_certificate'); 
	 	  $logged_in=$this->session->userdata('logged_in');
$uid='1';
	  $fname='Admin';
	  $userdata['inserted_by']=1;
	  $userdata['inserted_by_name']='Studymate';
 
	 if($this->input->post('certificate_text')){
		$userdata['certificate_text']=$this->input->post('certificate_text'); 
	 }
	  $this->db->insert('exam_quiz',$userdata);
	 $quid=$this->db->insert_id();
	return $quid;
	 
 }
 
  function get_quiz($quid){
	 $this->db->where('quid',$quid);
	 $query=$this->db->get('exam_quiz');
	 return $query->row_array();
	 
	 
 } 
 function open_result($quid,$uid){
	 $result_open=$this->lang->line('open');
		$query=$this->db->query("select * from exam_result  where exam_result.result_status='$result_open'  and exam_result.uid='$uid'  "); 
	if($query->num_rows() >= '1'){
		$result=$query->row_array();
return $result['rid'];		
	}else{
		return '0';
	}
	
	 
 }

 function count_result($quid,$uid){
	 
	 $this->db->where('quid',$quid);
	 $this->db->where('uid',$uid);
	$query=$this->db->get('exam_result');
	return $query->num_rows();
	 
 }
 function insert_result($quid,$uid){
	 
	 // get quiz info
	  $this->db->where('quid',$quid);
	 $query=$this->db->get('exam_quiz');
	$quiz=$query->row_array();
	 
	 if($quiz['question_selection']=='0'){
		 
	// get questions	
$noq=$quiz['noq'];	
	$qids=explode(',',$quiz['qids']);
	$categories=array();
	$category_range=array();

	$i=0;
	$wqids=implode(',',$qids);
	$noq=array();
	$query=$this->db->query("select * from exam_qbank join exam_cate on exam_cate.cid=exam_qbank.cid where qid in ($wqids) ORDER BY FIELD(qid,$wqids)  ");	
	$questions=$query->result_array();
	foreach($questions as $qk => $question){
	if(!in_array($question['category_name'],$categories)){
		if(count($categories)!=0){
			$i+=1;
		}
	$categories[]=$question['category_name'];
	$noq[$i]+=1;
	}else{
	$noq[$i]+=1;

	}
	}
	
	$categories=array();
	$category_range=array();

	$i=-1;
	foreach($questions as $qk => $question){
		if(!in_array($question['category_name'],$categories)){
		 $categories[]=$question['category_name'];
		$i+=1;	
		$category_range[]=$noq[$i];
		
		} 
	}
 
	
	}else{
	// randomaly select qids
	 $this->db->where('quid',$quid);
	 $query=$this->db->get('exam_qcl');
	 $qcl=$query->result_array();
	$qids=array();
	$categories=array();
	$category_range=array();
	
	foreach($qcl as $k => $val){
		$cid=$val['cid'];
		$lid=$val['lid'];
		$noq=$val['noq'];
		
		$i=0;
	$query=$this->db->query("select * from exam_qbank join exam_cate on exam_cate.cid=exam_qbank.cid where exam_qbank.cid='$cid' and lid='$lid' ORDER BY RAND() limit $noq ");	
	$questions=$query->result_array();
	foreach($questions as $qk => $question){
		$qids[]=$question['qid'];
		if(!in_array($question['category_name'],$categories)){
		$categories[]=$question['category_name'];
		$category_range[]=$i+$noq;
		}
	}
	}
	}
	$zeros=array();
	 foreach($qids as $qidval){
	 $zeros[]=0;
	 }
	 
	 
	 
	 $userdata=array(
	 'quid'=>$quid,
	 'uid'=>$uid,
	 'r_qids'=>implode(',',$qids),
	 'categories'=>implode(',',$categories),
	 'category_range'=>implode(',',$category_range),
	 'start_time'=>time(),
	 'individual_time'=>implode(',',$zeros),
	 'score_individual'=>implode(',',$zeros),
	 'attempted_ip'=>$_SERVER['REMOTE_ADDR'] 
	 );
	 
	 
	 $userdata['photo']="";
	 $this->db->insert('exam_result',$userdata);
	  $rid=$this->db->insert_id();
	return $rid;
 }
 function quiz_result($rid){
	 
	 
	$query=$this->db->query("select * from exam_result join exam_quiz on exam_result.quid=exam_quiz.quid where exam_result.rid='$rid' "); 
	return $query->row_array(); 
	 
 }
 function saved_answers($rid){
	 
	 
	$query=$this->db->query("select * from exam_answers  where exam_answers.rid='$rid' "); 
	return $query->result_array(); 
	 
 }
function submit_result(){
	 
	
	 $email=$this->session->email;
	 $rid=$this->session->userdata('rid');
	$query=$this->db->query("select * from exam_result 
	join exam_quiz on exam_result.quid=exam_quiz.quid 
	join users on users.userid=exam_result.uid 
	where exam_result.rid='$rid' "); 
	$quiz=$query->row_array(); 
	$score_ind=explode(',',$quiz['score_individual']);
	$r_qids=explode(',',$quiz['r_qids']);
	$qids_perf=array();
	$marks=0;
	$correct_score=explode(',',$quiz['correct_score']);
	$incorrect_score=explode(',',$quiz['incorrect_score']);
	$total_time=array_sum(explode(',',$quiz['individual_time']));
	$manual_valuation=0;
	
	foreach($score_ind as $mk => $score){
		$qids_perf[$r_qids[$mk]]=$score;
		
		
		
		if($score == 1){
			if(isset($correct_score[$mk])){
			$marks+=$correct_score[$mk];
			}else{
			$marks+=$correct_score[0];
			}
		}
		if($score == 2){
		
			if(isset($incorrect_score[$mk])){
			$marks+=$incorrect_score[$mk];
			}else{
			$marks+=$incorrect_score[0];
			}
			
		}
		
		if($score == 3){
			
			$manual_valuation=1;
		}
		
		
	}
	
	if(is_array($correct_score)){
	$percentage_obtained=($marks/(array_sum($correct_score)))*100;
	}else{
	$percentage_obtained=($marks/($quiz['noq']*$correct_score))*100;
	}
	if($percentage_obtained >= $quiz['pass_percentage']){
		$qr=$this->lang->line('pass');
	}else{
		$qr=$this->lang->line('fail');
		
	}
	 $userdata=array(
	  'total_time'=>$total_time,
	   'end_time'=>time(),
	  'score_obtained'=>$marks,
	 'percentage_obtained'=>$percentage_obtained,
	 'manual_valuation'=>$manual_valuation
	 );
	 if($manual_valuation == 1){
		 $userdata['result_status']=$this->lang->line('pending');
	}else{
		$userdata['result_status']=$qr;
	}
	 $this->db->where('rid',$rid);
	 $this->db->update('exam_result',$userdata);
	 
	 
	 foreach($qids_perf as $qp => $qpval){
		 $crin="";
		 if($qpval=='0'){
			$crin=", no_time_unattempted=(no_time_unattempted +1) "; 
		 }else if($qpval=='1'){
			$crin=", no_time_corrected=(no_time_corrected +1)"; 	 
		 }else if($qpval=='2'){
			$crin=", no_time_incorrected=(no_time_incorrected +1)"; 	 
		 }
		  $query_qp="update exam_qbank set no_time_served=(no_time_served +1)  $crin  where qid='$qp'  ";
	 $this->db->query($query_qp);
		 
	 }
	  
	return true;
 }



 function get_result($rid){
	$uid=getuserid();

		// if($logged_in['su']=='0'){
		// 	;
		// }
	$this->db->where('exam_result.uid',$uid);
		$this->db->where('exam_result.rid',$rid);
	 	$this->db->join('users','users.userid=exam_result.uid');
		$this->db->join('exam_quiz','exam_quiz.quid=exam_result.quid');
		$query=$this->db->get('exam_result');
		return $query->row_array();
	 
	 
 }
 function last_ten_result($quid){
		$this->db->order_by('percentage_obtained','desc');
		$this->db->limit(10);		
	 	$this->db->where('exam_result.quid',$quid);
	 	$this->db->join('users','users.userid=exam_result.uid'); 
		$this->db->join('exam_quiz','exam_quiz.quid=exam_result.quid');
		$query=$this->db->get('exam_result');
		return $query->result_array();
 }


    function get_percentile($quid,$uid,$score){
//   $logged_in =$this->session->userdata('logged_in');
// $gid= $logged_in['gid'];
$res=array();
	$this->db->select("exam_result.uid");
	$this->db->where("exam_result.quid",$quid);
	 $this->db->group_by("exam_result.uid");
	// $this->db->order_by("savsoft_result.score_obtained",'DESC');
	$query = $this -> db -> get('exam_result');
	$res[0]=$query -> num_rows();

	$this->db->select("exam_result.uid");
	
	$this->db->where("exam_result.quid",$quid);
	$this->db->where("exam_result.uid !=",$uid);
	$this->db->where("exam_result.score_obtained <=",$score);
	$this->db->group_by("exam_result.uid");
	// $this->db->order_by("savsoft_result.score_obtained",'DESC');
	$querys = $this -> db -> get('exam_result');
	$res[1]=$querys -> num_rows();
		
   return $res;
  
  
 }
  

 function no_attempt($quid,$uid){
	 
	$query=$this->db->query(" select * from exam_result where uid='$uid' and quid='$quid' ");
		return $query->num_rows(); 
 }
  function result_list($limit,$status='0'){
	$result_open=$this->lang->line('open');
	$uid=getuserid();
	  

		 $this->db->where('exam_result.result_status !=',$result_open);
	 	 
		$this->db->where('exam_result.uid',$uid);
		
	 	if($status !='0'){
			$this->db->where('exam_result.result_status',$status);
		}
		
		
		
		$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('rid','desc');
		$this->db->join('users','users.userid=exam_result.uid');
		$this->db->join('exam_quiz','exam_quiz.quid=exam_result.quid');
		$query=$this->db->get('exam_result');
		return $query->result_array();
		
	 
 }


 function get_questions($qids){
	 if($qids == ''){
		$qids=0; 
	 }else{
		 $qids=$qids;
	 }

	  
	 $query=$this->db->query("select * from exam_qbank join exam_cate on exam_cate.cid=exam_qbank.cid join exam_level on exam_level.lid=exam_qbank.lid 
	 where exam_qbank.qid in ($qids) order by FIELD(exam_qbank.qid,$qids) 
	 ");
	 return $query->result_array();
	 
	 
 }

 function get_options($qids){
	 
	 
	 $query=$this->db->query("select * from exam_options where qid in ($qids) order by FIELD(exam_options.qid,$qids)");
	 return $query->result_array();
	 
 }

function get_qcl($quid){
	
	 $this->db->where('quid',$quid);
	 $query=$this->db->get('exam_qcl');
	 return $query->result_array();
	
}

function update_quiz($quid){
	 
	 $userdata=array(
	 'quiz_name'=>$this->input->post('quiz_name'),
	 'description'=>$this->input->post('description'),
	 'start_date'=>strtotime($this->input->post('start_date')),
	 'end_date'=>strtotime($this->input->post('end_date')),
	 'duration'=>$this->input->post('duration'),
	 'maximum_attempts'=>$this->input->post('maximum_attempts'),
	 'pass_percentage'=>$this->input->post('pass_percentage'),
	 'correct_score'=>$this->input->post('correct_score'),
	 'incorrect_score'=>$this->input->post('incorrect_score'),
	 'ip_address'=>$this->input->post('ip_address'),
	 'view_answer'=>$this->input->post('view_answer'),
	 'camera_req'=>$this->input->post('camera_req'),
	 'quiz_template'=>$this->input->post('quiz_template'),
	 'quiz_price'=>$this->input->post('quiz_price'),
	 'with_login'=>$this->input->post('with_login'),
	 'show_chart_rank'=>$this->input->post('show_chart_rank'),
         'uids'=>implode(',',$this->input->post('uids')),
	 'gids'=>implode(',',$this->input->post('gids'))
	 );
	  	 	 
		$userdata['gen_certificate']=$this->input->post('gen_certificate'); 
	  
	 if($this->input->post('certificate_text')){
		$userdata['certificate_text']=$this->input->post('certificate_text'); 
	 }
 
	  $this->db->where('quid',$quid);
	  $this->db->update('exam_quiz',$userdata);
	  
	  $this->db->where('quid',$quid);
	  $query=$this->db->get('exam_quiz',$userdata);
	 $quiz=$query->row_array();
	 if($quiz['question_selection']=='1'){
		 
	  $this->db->where('quid',$quid);
	  $this->db->delete('exam_qcl');
                $correct_i=array();
        	 $incorrect_i=array();	 
	 foreach($_POST['cid'] as $ck => $val){
		 if(isset($_POST['noq'][$ck])){
			 if($_POST['noq'][$ck] >= '1'){
		 $userdata=array(
		 'quid'=>$quid,
		 'cid'=>$val,
		 'lid'=>$_POST['lid'][$ck],
		 'i_correct'=>$_POST['i_correct'][$ck],
		 'i_incorrect'=>$_POST['i_incorrect'][$ck],
		 'noq'=>$_POST['noq'][$ck]
		 );
		 $this->db->insert('exam_qcl',$userdata);
		  for($i=1; $i<=$_POST['noq'][$ck]; $i++){
$correct_i[]=$_POST['i_correct'][$ck];
$incorrect_i[]=$_POST['i_incorrect'][$ck];
}
		 }
		 }
	 }
		 $userdata=array(
		 'noq'=>array_sum($_POST['noq']),
		 'correct_score'=>implode(',',$correct_i),
		 'incorrect_score'=>implode(',',$incorrect_i)
	);
	 $this->db->where('quid',$quid);
	  $this->db->update('exam_quiz',$userdata);
	 }else{
			$correct_i=array();
			 $incorrect_i=array();
 foreach($_POST['i_correct'] as $ck =>$cv){
$correct_i[]=$_POST['i_correct'][$ck];
$incorrect_i[]=$_POST['i_incorrect'][$ck];
}

	 $userdata=array(
		 'correct_score'=>implode(',',$correct_i),
		  'incorrect_score'=>implode(',',$incorrect_i)
		 
			);
	  $this->db->where('quid',$quid);
	  $this->db->update('exam_quiz',$userdata);


}
	return $quid;
	 
 }


		 public function related($id)
		 {
            
			$this->db->select('*');
			$this->db->from('Blog');
			$this->db->where('blog_title',$id);
			$this->db->limit(2,1);
			$query=$this->db->get();
			return $query->result_array(); 
			
		 }
		  public function search($id)
		 {
            
			$this->db->select('*');
			$this->db->from('Blog');
			$this->db->like('blog_title',$id);
			$query=$this->db->get();
			return $query->result_array(); 
			
		 }
		 public function paginationten($tbl,$select,$limit,$offset)
		{
			$res= $this->db->select($select)->limit($limit,$offset)->get($tbl);
			return $res->result();
		}
		
		
		
		public function get_count() {
        return $this->db->count_all($this->table);
    }

		public function get_posts($limit, $start) {
       
		$this->db->limit($limit, $start);
        $query = $this->db->get($this->table);

        return $query->result_array();
		
		}
	
		
		
}