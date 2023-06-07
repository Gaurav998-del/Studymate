<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	public function loadUsers()
	{
		$limit=10;
		$getAllUsers=$this->App_model->getData('users',$resultType="all_array",$arg=['limit'=>[$limit,0],'where'=>['status'=>1],'order'=>['col'=>'votes','type'=>'desc']]);
		$this->load->model('UserModel');
		$totalUsers=$this->App_model->getData('users',$resultType="count",$arg=['where'=>['status'=>1]]);
		$data=$this->SiteModel->getSiteData();
		$data['title']="Users";
		$data['next']=$limit;
		$data['totalUsers']=$totalUsers;
		$data['fetchedUsersCount']=count($getAllUsers);
		$data['getAllUsers']=$getAllUsers;
		$this->load->view('usersList',$data);
	}
	
	public function loadMoreUsers()
	{
		$limit=10;
		$next=(int) secureInput($this->input->post('next'));
		$filters=secureInput($this->input->post('filters'));
		$search=secureInput($this->input->post('search'));
		
		$where=['status'=>1];
		$type="desc";
		if ($filters=="new") {
			$col="on";
		} else if ($filters=="voters") {
			$col="voted";
			$where['voted >']=0;
		} else {
			$col="votes";
		}
		$args=['where'=>$where];
		
		if (strlen($search)>0) {
			$args['like']=['col'=>'name','query'=>$search];
		}
		
		$totalUsers=$this->App_model->getData('users',$resultType="count",$arg=$args);
		
		$args['order']=['col'=>$col,'type'=>$type];
		$args['limit']=[$limit,$next];
		$getAllUsers=$this->App_model->getData('users',$resultType="all_array",$arg=$args);
		
		$this->load->model('UserModel');
		$users=$this->load->view('usersLM',['users'=>$getAllUsers],true);
		$next=$limit+$next;
		
		$result=[];
		$result['type']=1;
		$result['next']=$next;
		$result['loadMoreH']=$next>$totalUsers?1:0;
		$result['fetchedUsersCount']=count($getAllUsers);
		$result['result']=$users;
		echo json_encode($result);
	}
}