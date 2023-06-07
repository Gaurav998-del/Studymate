<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class App_model extends CI_Model 
{
	function __construct() {
		parent::__construct();
	}
	public function getData($table,$resultType="all_array",$arg=[])
	{
		if (isset($arg['select'])) {
			$this->db->select($arg['select']);
		}
		if (isset($arg['where'])) {
			$this->db->where($arg['where']);
		}
		if (isset($arg['where2'])) {
			$this->db->where($arg['where2']);
		}
		if (isset($arg['wherein2'])) {
			$this->db->where_in($arg['wherein2']['column'],$arg['wherein2']['data']);
		}
		if (isset($arg['wherein'])) {
			$this->db->where_in($arg['wherein']['column'],$arg['wherein']['data']);
		}
		if (isset($arg['wherentin'])) {
			$this->db->where_not_in($arg['wherentin']['column'],$arg['wherentin']['data']);
		}
		if (isset($arg['limit'])) {
			$this->db->limit($arg['limit'][0],$arg['limit'][1]);
		}
		
		if (isset($arg['like'])) {
			$this->db->like($arg['like']['col'],$arg['like']['query']);
		}
		if (isset($arg['like2'])) {
			$this->db->like($arg['like2']['col'],$arg['like2']['query']);
		}
		if (isset($arg['order'])) {
			$this->db->order_by($arg['order']['col'],$arg['order']['type']);
		}
		if (isset($arg['group'])) {
			$this->db->group_by($arg['group']['col']);}
		if (isset($arg['distinct'])) {
			$this->db->distinct($arg['distinct']);
		}
		if (isset($arg['join'])) {
			$this->db->join($arg['join']['table'], $arg['join']['query'], $arg['join']['type']);
		}
		$return = NULL;
		if ($resultType=="all_array") {
			$return=$this->db->get($table)->result_array();
		} else if ($resultType=="row_array") {
			$return=$this->db->get($table)->row_array();
		} else {
			$return=$this->db->count_all_results($table);
		}
		return $return;
	}
	
	public function insert($table,$data,$batch=false) {
		if (!$batch){
			return $this->db->insert($table,$data);
		} else {
		
			return $this->db->insert_batch($table,$data);
		}
	}
	
	public function insert_id($table,$data)
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id();	
	}
	
	function deleteData($table,$where=false)
	{
		if ($where!==false) {
			$this->db->where($where);
		}
		return $this->db->delete($table);
	}
	
	function updateData($table,$data,$where=null)
	{
		
		if (isset($where)) {
			$this->db->where($where);
		}
		return $this->db->update($table,$data);
	}


	function checkquestion($question)
	{

$this->db->select('*');
$this->db->from('questions');
$this->db->where('title', $question);
$query = $this->db->get();
return $query;
	}
	function checkabuseword($question)
	{

$this->db->select('*');
$this->db->from('abuseword');
$this->db->like('a_word', $question);
$query = $this->db->get();
return $query;
	}


	function findsubcat($catid)
	{
$this->db->select('*');
$this->db->from('subcategories');
$this->db->where('catid', $catid);
$query = $this->db->get()->result_array();
return $query;
	}
}