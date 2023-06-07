<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Job extends CI_Model 
{
	function __construct() {
		parent::__construct();
	}
	public function job()
		 {
			$this->db->select('*');
			$this->db->from('Jobs');
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
}