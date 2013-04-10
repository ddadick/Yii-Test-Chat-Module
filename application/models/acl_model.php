<?php

class Acl_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();

    
  }
  
  function get_roles(){ 	
  	$this->db->select('user.nickname as orders, roles.name as type, roles.comment as comment, roles.post as post', false);
  	$this->db->join("user", "user.role = roles.order", "inner");
  	$this->db->group_by("user.role");
  	$this->db->order_by("orders", "desc");
  	$user_role=$this->db->get('roles')->result_array();
  	foreach($user_role as $key=>$items){
  		$user_role[$key]=(object)$user_role[$key];
  	}
  	foreach($user_role as $key=>$items){
  		$items=(object)$items;
  		$array=array();
  		$tok = strtok($items->comment, "/");
  		while ($tok !== false) {
  			array_push($array,$tok);
  			$tok = strtok("/");
		}
		$user_role[$key]->comment=(object)$array;
		$array=array();
		$tok = strtok($items->post, "/");
		while ($tok !== false) {
			array_push($array,$tok);
			$tok = strtok("/");
		}
		$user_role[$key]->post=(object)$array;
  	}
  	return $user_role;
  }
  
  function find_user($user=NULL,$pass=NULL){
  	$this->db->select('*', false);
  	$this->db->where(array('nickname'=>$user,'passnocesret'=>$pass));
  	return (count($a=$this->db->get('user')->result_array()))?$a:false;
  	
  }
  
}

