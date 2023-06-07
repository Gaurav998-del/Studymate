<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Badges extends CI_Controller 
{
	public function __contstruct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$badges=$this->App_model->getData('badges',$resultType="all_array",$arg=['select'=>['COUNT(awardedBadges.awardId) as totalAwarded','badges.name','badges.priority','badges.value','badges.description'],'group'=>['col'=>'badges.badgeId'],'join'=>['table'=>'awardedBadges','query'=>'awardedBadges.badgeId=badges.badgeId','type'=>'left'],'order'=>['col'=>'totalAwarded','type'=>'desc']]);
		$data=$this->SiteModel->getSiteData();
		$data['title']="Badges";
		$data['badges']=$badges;
		$this->load->view('badgesList',$data);
	}
}