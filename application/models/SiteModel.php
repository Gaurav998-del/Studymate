<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SiteModel extends CI_Model 
{
	function __construct() {
		parent::__construct();
	}
	function getSiteData()
	{
		$siteSettings=$this->App_model->getData('siteSettings',$resultType="row_array",$arg=[]);
		$totalQuestions=$this->App_model->getData('questions',$resultType="count_array",$arg=[]);
		
		$totalUsers=$this->App_model->getData('users',$resultType="count_array",$arg=[]);
		$totalAnswers=$this->App_model->getData('awnsers',$resultType="count_array",$arg=[]);
		$totalVotedAnswers=$this->App_model->getData('awnsers',$resultType="count_array",$arg=['where'=>['votes >'=>0]]);
		
		$stats=['totalQuestions'=>$totalQuestions,'totalAnswers'=>$totalAnswers,'totalVotedAnswers'=>$totalVotedAnswers,'totalUsers'=>$totalUsers];
		
		return ['stats'=>$stats,'siteSettings'=>$siteSettings,'notifications'=>$this->getNotifcationsHeader()];
	}
	function getNotifcationsHeader()
	{
		$notifications=[];
		
		if(checksession())
		{
			$userid=getuserid();
			$notifications=$this->getNotifications($userid,$limit=10);
		}
		
		return $notifications;
	}
	function getNotifications($userid,$limit,$start=0)
	{
		$this->db->where('notifications.for',$userid);
		$this->db->join('notificationSchema','notificationSchema.nsId=notifications.nsId','inner');
		$this->db->join('questions','questions.qid=notifications.qid','left');
		$this->db->join('badges','badges.badgeId=notifications.badgeId','left');
		$this->db->join('reputationRecord','reputationRecord.repId=notifications.repId','left');
		$this->db->select(['notifications.for','notifications.qid','notificationSchema.title','notificationSchema.description','notificationSchema.permalink as nPerma','notifications.on','questions.title as questionTitle','questions.permalink','badges.name as badgeName','reputationRecord.reputation']);
		$this->db->limit($limit,$start);
		$this->db->order_by('notifications.on','desc');
		return $this->db->get('notifications')->result_array();
	}
}