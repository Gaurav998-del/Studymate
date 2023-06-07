<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserModel extends CI_Model 
{
	function __construct() {
		parent::__construct();
	}
	function getUserCategoryNames($userid)
	{
		$this->db->where(['questions.userid'=>$userid]);
		$this->db->distinct('questions.catid');
		$this->db->select(['categories.name','categories.permalink','questions.votes']);
		$this->db->limit(3,0);
		$this->db->order_by('questions.votes','desc');
		$this->db->join('categories','categories.catid=questions.catid','inner');
		return $this->db->get('questions')->result_array();
	}
}