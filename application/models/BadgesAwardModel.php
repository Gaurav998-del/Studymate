<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BadgesAwardModel extends CI_Model 
{
	function __construct() {
		parent::__construct();
	}

	function incQ($where,$column,$table)
	{
		$this->db->where($where);
		$this->db->set($column,"$column+1",false);
		$this->db->update($table);
	}
	function checkActiveMemberYear($votes,$userid)
	{
		$this->db->where("YEAR('on') = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))");
		$this->db->where('userid',$userid);
		$this->db->where('votes>=',$votes);
		return $this->db->count_all_results('users');
	}
	function manageAwardedBadgeDB($badgeId,$UsercolsP,$userid)
	{
		$this->App_model->insert('awardedBadges',['userid'=>$userid,'badgeId'=>$badgeId],$batch=false);
		$this->BadgesAwardModel->incQ(['userid'=>$userid],$UsercolsP,"users");
		
		$this->App_model->insert('notifications',['for'=>$userid,'badgeId'=>$badgeId,'nsId'=>11],$batch=false);
	}
}