<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminModel extends CI_Model 
{
	function __construct() {
		parent::__construct();
	}
	
	function getReportedAnswers($limit,$start){
		$this->db->join('reportSchema','reportSchema.rsid=reportedAnswers.rsid','left');
		$this->db->join('awnsers','awnsers.qaid=reportedAnswers.qaid','inner');
		$this->db->join('questions','awnsers.qid=questions.qid','inner');
		$this->db->select(['questions.qid','questions.permalink','awnsers.description','reportedAnswers.*','reportSchema.name as reportSchemaName','reportSchema.description as reportSchemaDescription']);
		$this->db->limit($limit,$start);
		return $this->db->get('reportedAnswers')->result_array();
	}
	function getReportedAnswersReplies($limit,$start){
		$this->db->join('reportSchema','reportSchema.rsid=reportedReplies.rsid','left');
		$this->db->join('awnserReplies','awnserReplies.arid=reportedReplies.arid','inner');
		$this->db->join('questions','awnserReplies.qid=questions.qid','inner');
		$this->db->select(['questions.qid','questions.permalink','awnserReplies.reply','reportedReplies.*','reportSchema.name as reportSchemaName','reportSchema.description as reportSchemaDescription']);
		$this->db->limit($limit,$start);
		return $this->db->get('reportedReplies')->result_array();
	}
	function getReportedQuestionReplies($limit,$start){
		$this->db->join('reportSchema','reportSchema.rsid=reportedReplies.rsid','left');
		$this->db->join('questionsReplies','questionsReplies.qrid=reportedReplies.qrid','inner');
		$this->db->join('questions','questionsReplies.qid=questions.qid','inner');
		$this->db->select(['questions.qid','questions.permalink','questionsReplies.reply','reportedReplies.*','reportSchema.name as reportSchemaName','reportSchema.description as reportSchemaDescription']);
		$this->db->limit($limit,$start);
		return $this->db->get('reportedReplies')->result_array();
	}
	
}