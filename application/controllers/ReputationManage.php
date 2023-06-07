<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReputationManage extends CI_Controller 
{
	public function __contstruct()
	{
		parent::__construct();
	}
	function index()
	{
		$users=$this->App_model->getData('users',$resultType="all_array",$arg=['where'=>['status'=>1],'limit'=>[100,0],'select'=>['userid','votes'],'order'=>['col'=>'reputationUpdate','type'=>'asc']]);
		foreach ($users as $index=>$value)
		{
			$userid=$value['userid'];
			$date=date('Y-m');
			$date=$date."-01";
			$usersRecordCheck=$this->App_model->getData('reputationRecord',$resultType="count_array",$arg=['where'=>["on>="=>$date,"userid"=>$userid]]);
			if ($usersRecordCheck==0) {
				$this->App_model->insert('reputationRecord',['userid'=>$userid,'reputation'=>$value['votes'],'on'=>date('Y-m-d')],$batch=false);
				$repId=$this->db->insert_id();
				$this->App_model->insert('notifications',['for'=>$userid,'repId'=>$repId,'nsId'=>12],$batch=false);
			} else {
				$this->App_model->updateData('reputationRecord',['reputation'=>$value['votes'],'on'=>date('Y-m-d')],['userid'=>$userid]);
			}
			$this->App_model->updateData('users',['reputationUpdate'=>date('Y-m-d H:i:s')],['userid'=>$userid]);
		}
	}
}
	