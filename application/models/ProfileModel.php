<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ProfileModel extends CI_Model 
{
	function __construct() {
		parent::__construct();
	}
	function getUserCategoryStats($userid)
	{
		$this->db->where(['questions.userid'=>$userid]);
		$this->db->select(['sum(votes) as totalVotes','count(*) as totalPosts','categories.name as categoryName','categories.permalink as catperma']);
		$this->db->limit(6,0);
		$this->db->order_by('totalVotes','desc');
		$this->db->group_by('questions.catid');
		$this->db->join('categories','categories.catid=questions.catid','inner');
		return $this->db->get('questions')->result_array();
	}
	function manageCookieViews($cookieN,$urls,$userid)
	{
		$urls=json_encode($urls);
		setcookie($cookieN, $urls, time() + (86400 * 30), "/"); 
		$this->db->where('userid',$userid);
		$this->db->set('views','views+1',false);
		$this->db->set('peopleReached','peopleReached+1',false);
		$this->db->update('users');
	}
	function manageViews($userid)
	{
		$cookieN="uv-answiz";
		if (!isset($_COOKIE[$cookieN])) {
			$urls=[$userid];
			$this->manageCookieViews($cookieN,$urls,$userid);
			return true;
		} else {
			$cookie=$_COOKIE[$cookieN];
			$urls=json_decode($cookie,true);
			if (is_array($urls)) {
				if (count($urls)>0) {
					if (!in_array($userid,$urls)) {
						$urls[]=$userid;
						$this->manageCookieViews($cookieN,$urls,$userid);
						return true;
					}
				}
			}
		}
		return false;
	}
}