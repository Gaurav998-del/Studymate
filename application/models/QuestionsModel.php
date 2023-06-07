<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class QuestionsModel extends CI_Model 
{
	function __construct() {
		parent::__construct();
	}
	
	function getAllQuestions($limit,$start,$type="def",$tag="",$catid="",$search=""){
		$this->db->where('questions.status',1);
		$this->db->join('categories','categories.catid=questions.catid','inner');
		$this->db->select(['questions.qid','questions.votes','questions.awnsers','questions.views','questions.on','questions.permalink','questions.title','questions.tags','categories.name as categoryName','categories.permalink as catperma']);
		if (strlen($type)>0) {
			if ($type=="hot") {
				$this->db->where('questions.votes >',0);
				$this->db->order_by('questions.votes','desc');
			} else if ($type=="unanswered") {
				$this->db->where('questions.awnsers',0);
				$this->db->order_by('questions.on','desc');
			} else if ($type=="def") {
				$this->db->order_by('questions.on','desc');
			}
		}
		
		if (strlen($tag)>0) {
			$this->db->like('questions.tags',$tag);
		}
		if (strlen($search)>0) {
			$this->db->like('questions.title',$search);
		}
		
		if ($catid!=null) {
			$this->db->where('questions.catid',$catid);
		}
		$this->db->limit($limit,$start);
		return $this->db->get('questions')->result_array();
	}
	
function adsearch()
{
	$this->db->select(['title']);
	return $this->db->get('qt')->result_array();
}
	function getPopularQuestions($limit=3)
	{
		$this->db->where('questions.status',1);
		$this->db->where('questions.votes >',0);
		$this->db->select(['qid','title','votes','permalink','awnsers']);
		$this->db->order_by('votes','desc');
		$this->db->limit($limit,0);
		return $this->db->get('questions')->result_array();
	}
	function getRelatedQuestions($limit=3,$catid,$qid)
	{
		$this->db->where('questions.status',1);
		$this->db->where('questions.qid !=',$qid); 
		$this->db->where('questions.catid',$catid);
		$this->db->select(['qid','title','votes','permalink','awnsers']);
		$this->db->order_by('votes','desc');
		$this->db->limit($limit,0);
		return $this->db->get('questions')->result_array();
	}
	function getPopularQuestionsTags($limit=3)
	{
		$this->db->where('questions.status',1);
		$this->db->select(['tags']);
		$this->db->order_by('votes','desc');
		$this->db->limit($limit);
		return $this->db->get('questions')->result_array();
	}
	function getSiteStatsSidebar()
	{
		$totalQuestions=$this->App_model->getData('questions',$resultType="count_array",$arg=[]);
		$totalAnswers=$this->App_model->getData('questions',$resultType="row_array",$arg=['select'=>['sum(awnsers) as total']]);
		$totalAnswers=$totalAnswers['total'];	
		$totalVotedAnswers=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['votes >'=>0]]);
		$totalUsers=$this->App_model->getData('users',$resultType="count_array",$arg=[]);
		return ['totalQuestions'=>$totalQuestions,'totalAnswers'=>$totalAnswers,'totalVotedAnswers'=>$totalVotedAnswers,'totalUsers'=>$totalUsers];
	}
	function incAwnser($qid)
	{
		$this->db->where('qid',$qid);
		$this->db->set('awnsers','awnsers+1',false);
		$this->db->update('questions');
	}
	
	function decAwnser($qid)
	{
		$this->db->where('qid',$qid);
		$this->db->set('awnsers','awnsers-1',false);
		$this->db->update('questions');
	}
	
	function incQ($where,$column,$table)
	{
		$this->db->where($where);
		$this->db->set($column,"$column+1",false);
		$this->db->update($table);
	}
	
	function decQ($where,$column,$table)
	{
		$this->db->where($where);
		$this->db->set($column,"$column-1",false);
		$this->db->update($table);
	}
	
	function getanswerreplies($answerId,$limit,$start=0)
	{
		return $this->App_model->getData('awnserReplies',$resultType="all_array",$arg=['select'=>['awnserReplies.arid','awnserReplies.votes','awnserReplies.on','awnserReplies.reply','users.name','users.userid'],'limit'=>[$limit,$start],'where'=>['awnserReplies.qaid'=>$answerId],'order'=>['col'=>'on','type'=>'desc'],'join'=>['table'=>'users','query'=>'users.userid=awnserReplies.userid','type'=>'inner']]);
	}

	function getanswerrepliescount($answerId)
	{
		return $this->App_model->getData('awnserReplies',$resultType="count_array",$arg=['where'=>['qaid'=>$answerId]]);
	}
	function answerRepliesVotesReports($answerReplies)
	{
		$votedAnswerReplies=[];
		$reportedAnswerRepliesIds=[];
		if (checksession()){
			$userid=getuserid();
			if (count($answerReplies)>0) {
				$replyIds=array_column($answerReplies,'arid');
				$votedAnswerRepliesR=$this->App_model->getData('votedAReplies',$resultType="all_array",$arg=['select'=>['arid'],'where'=>['by'=>$userid],'wherein'=>['column'=>'arid','data'=>$replyIds]]);
				if (count($votedAnswerRepliesR)>0) {
					$votedAnswerReplies=array_column($votedAnswerRepliesR,'arid');
				}
				
				$reportedAnswerReplies=$this->App_model->getData('reportedReplies',$resultType="all_array",$arg=['select'=>['arid'],'where'=>['userid'=>$userid],'wherein'=>['column'=>'arid','data'=>$replyIds]]);
				if (count($reportedAnswerReplies)>0) {
					$reportedAnswerRepliesIds=array_column($reportedAnswerReplies,'arid');
				}
			}
		}
		return ['votedAnswerReplies'=>$votedAnswerReplies,'reportedAnswerRepliesIds'=>$reportedAnswerRepliesIds];
	}
	function manageCookieViews($cookieN,$urls,$qid)
	{
		$urls=json_encode($urls);
		setcookie($cookieN, $urls, time() + (86400 * 30), "/"); 
		$this->db->where('qid',$qid);
		$this->db->set('views','views+1',false);
		$this->db->update('questions');
	}
	function manageViews($qid)
	{
		$cookieN="qa-answiz";
		if (!isset($_COOKIE[$cookieN])) {
			$urls=[$qid];
			$this->manageCookieViews($cookieN,$urls,$qid);
			return true;
		} else {
			$cookie=$_COOKIE["qa-answiz"];
			$urls=json_decode($cookie,true);
			if (is_array($urls)) {
				if (count($urls)>0) {
					if (!in_array($qid,$urls)) {
						$urls[]=$qid;
						$this->manageCookieViews($cookieN,$urls,$qid);
						return true;
					}
				}
			}
		}
		return false;
	}
	
	function searchAllQuestions($limit,$start,$search,$catid="",$type="def",$tag=""){
		
		$this->db->where('questions.status',1);
		$this->db->join('categories','categories.catid=questions.catid','inner');
		$this->db->select(['questions.qid','questions.votes','questions.awnsers','questions.views','questions.on','questions.permalink','questions.title','questions.tags','categories.name as categoryName','categories.permalink as catperma']);
		if (strlen($type)>0) {
			if ($type=="hot") {
				$this->db->where('questions.votes >',0);
				$this->db->order_by('questions.votes','desc');
			} else if ($type=="unanswered") {
				$this->db->where('questions.awnsers',0);
				$this->db->order_by('questions.on','desc');
			} else if ($type=="def") {
				$this->db->order_by('questions.on','desc');
			}
		}
		
		if (strlen($tag)>0) {
			$this->db->like('questions.tags',$tag);
		}
		if (strlen($search)>0) {
			$this->db->like('questions.title',$search);
		}
		
		if ($catid!=null) {
			$this->db->where('questions.catid',$catid);
		}
		$this->db->limit($limit,$start);
		return $this->db->get('questions')->result_array();
	}
	
	function getAllJobs($limit,$start){
		$this->db->select(['Jobs.id','Jobs.job_title','Jobs.job_category','Jobs.technologies','Jobs.salary','Jobs.companyname','Jobs.companylocation']);
	
		$this->db->limit($limit,$start);
		return $this->db->get('Jobs')->result_array();
	}
}