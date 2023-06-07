<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BadgesAward extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('BadgesAwardModel');
	}
	function questionsAward()
	{
		$users=$this->App_model->getData('users',$resultType="all_array",$arg=['where'=>['status'=>1],'limit'=>[3,0],'select'=>['userid'],'order'=>['col'=>'badgesUpdateQ','type'=>'asc']]);
		$badges=$this->App_model->getData('badges',$resultType="all_array",$arg=[]);
		$Usercols=['badgesGold','badgesGold','badgesSilver','badgesBronze'];
		foreach ($users as $index => $value) {
			$userid=$value['userid'];
			$awardedBadges=$this->App_model->getData('awardedBadges',$resultType="all_array",$arg=['where'=>['userid'=>$userid],'select'=>['badgeId']]);
			$awardedBadgesId=array_column($awardedBadges,'badgeId');
			
			foreach ($badges as $index => $badge) {
				$badgeId=$badge['badgeId'];
				if (in_array($badgeId,$awardedBadgesId)) {
					continue;
				}
				
				if ($badgeId==1 || $badgeId==2 || $badgeId==3 || $badgeId==4) {
					$awardedBadges=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['userid'=>$userid,'votes>='=>$badge['value']]]);
					if ($awardedBadges>0) {
						$UsercolsP=$Usercols[$badge['priority']];
						$this->BadgesAwardModel->manageAwardedBadgeDB($badgeId,$UsercolsP,$userid);
					}
				} else if ($badgeId==5) {
					$awardedBadgesV=$this->App_model->getData('questions',$resultType="count_array",$arg=['where'=>['userid'=>$userid,'views>='=>$badge['value']]]);
					if ($awardedBadgesV>0) {
						$UsercolsP=$Usercols[$badge['priority']];
						$this->BadgesAwardModel->manageAwardedBadgeDB($badgeId,$UsercolsP,$userid);
					}
				} else if ($badgeId==7) {
					$awardedBadgesF=$this->App_model->getData('questions',$resultType="row_array",$arg=['select'=>['votes'],'limit'=>[1,0],'order'=>['col'=>'on','type'=>'asc'],'where'=>['userid'=>$userid]]);
					
					if (count($awardedBadgesF)>0) {
						if ($awardedBadgesF['votes']>$badge['value']) {
							$UsercolsP=$Usercols[$badge['priority']];
							$this->BadgesAwardModel->manageAwardedBadgeDB($badgeId,$UsercolsP,$userid);
						}
					}
				}
				
				$this->App_model->updateData('users',['badgesUpdateQ'=>date('Y-m-d H:i:s')],['userid'=>$userid]);
			}
		}
	}
	function answersAward()
	{
		$users=$this->App_model->getData('users',$resultType="all_array",$arg=['where'=>['status'=>1],'limit'=>[3,0],'select'=>['userid'],'order'=>['col'=>'badgesUpdateA','type'=>'asc']]);
		$badges=$this->App_model->getData('badges',$resultType="all_array",$arg=[]);
		$Usercols=['badgesGold','badgesGold','badgesSilver','badgesBronze'];
		foreach ($users as $index => $value) {
			$userid=$value['userid'];
			$awardedBadges=$this->App_model->getData('awardedBadges',$resultType="all_array",$arg=['where'=>['userid'=>$userid],'select'=>['badgeId']]);
			$awardedBadgesId=array_column($awardedBadges,'badgeId');
			
			foreach ($badges as $index => $badge) {
				$badgeId=$badge['badgeId'];
				if (in_array($badgeId,$awardedBadgesId)) {
					continue;
				}
				
				if ($badgeId==9 || $badgeId==10 || $badgeId==11 || $badgeId==12 || $badgeId==14) {
					$awardedBadges=$this->App_model->getData('awnsers',$resultType="count_array",$arg=['where'=>['userid'=>$userid,'votes>='=>$badge['value']]]);
					if ($awardedBadges>0) {
						$UsercolsP=$Usercols[$badge['priority']];
						$this->BadgesAwardModel->manageAwardedBadgeDB($badgeId,$UsercolsP,$userid);
					}
				} else if ($badgeId==13) {
					$badgeOwn=$this->App_model->getData('awnsers',$resultType="all_array",$arg=['where'=>['awnsers.userid'=>$userid,'questions.userid'=>$userid,'awnsers.votes>='=>$badge['value']],'join'=>['table'=>'questions','query'=>'questions.qid=awnsers.qid','type'=>'inner']]);
					
					if (count($badgeOwn)>0) {
						$UsercolsP=$Usercols[$badge['priority']];
						$this->BadgesAwardModel->manageAwardedBadgeDB($badgeId,$UsercolsP,$userid);
					}
				}
				
				$this->App_model->updateData('users',['badgesUpdateA'=>date('Y-m-d H:i:s')],['userid'=>$userid]);
			}
		}
	}
	function participationAward()
	{
		$users=$this->App_model->getData('users',$resultType="all_array",$arg=['where'=>['status'=>1],'limit'=>[3,0],'select'=>['userid'],'order'=>['col'=>'badgesUpdateP','type'=>'asc']]);
		$badges=$this->App_model->getData('badges',$resultType="all_array",$arg=[]);
		$Usercols=['badgesGold','badgesGold','badgesSilver','badgesBronze'];
		
		foreach ($users as $index => $value)
		{
			$userid=$value['userid'];
			$awardedBadges=$this->App_model->getData('awardedBadges',$resultType="all_array",$arg=['where'=>['userid'=>$userid],'select'=>['badgeId']]);
			$awardedBadgesId=array_column($awardedBadges,'badgeId');
			
			foreach ($badges as $index => $badge) {
				$badgeId=$badge['badgeId'];
				if (in_array($badgeId,$awardedBadgesId))
				continue;
				
				if ($badgeId==16) {
					$commentsCheck=$this->App_model->getData('awnserReplies',$resultType="count_array",$arg=['where'=>['userid'=>$userid]]);
					if ($commentsCheck>=$badge['value']) {
						$UsercolsP=$Usercols[$badge['priority']];
						$this->BadgesAwardModel->manageAwardedBadgeDB($badgeId,$UsercolsP,$userid);
					}
				} else if ($badgeId==17) {
					$commentsCheck=$this->App_model->getData('awnserReplies',$resultType="count_array",$arg=['where'=>['userid'=>$userid,'votes>='=>5]]);
					if ($commentsCheck>=$badge['value']) {
						$UsercolsP=$Usercols[$badge['priority']];
						$this->BadgesAwardModel->manageAwardedBadgeDB($badgeId,$UsercolsP,$userid);
					} else {
						$commentsCheck=$this->App_model->getData('questionsReplies',$resultType="count_array",$arg=['where'=>['userid'=>$userid,'votes>='=>5]]);
						if ($commentsCheck>=$badge['value']) {
							$UsercolsP=$Usercols[$badge['priority']];
							$this->BadgesAwardModel->manageAwardedBadgeDB($badgeId,$UsercolsP,$userid);
						}
					}
				} else if ($badgeId==15) {
					$aboutmeCheck=$this->App_model->getData('users',$resultType="count_array",$arg=['where'=>['userid'=>$userid,'LENGTH(description)>'=>0]]);
					if ($aboutmeCheck>0) {
						$UsercolsP=$Usercols[$badge['priority']];
						$this->BadgesAwardModel->manageAwardedBadgeDB($badgeId,$UsercolsP,$userid);
					}
				} else if ($badgeId==19) {
					$yearlyCheck=$this->BadgesAwardModel->checkActiveMemberYear($badge['value'],$userid);
					if ($yearlyCheck>0) {
						$UsercolsP=$Usercols[$badge['priority']];
						$this->BadgesAwardModel->manageAwardedBadgeDB($badgeId,$UsercolsP,$userid);
					}
				}
				
				$this->App_model->updateData('users',['badgesUpdateP'=>date('Y-m-d H:i:s')],['userid'=>$userid]);
			}
		}
	}
	
}