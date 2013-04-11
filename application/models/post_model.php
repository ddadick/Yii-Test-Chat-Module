<?php

class Post_model extends CI_Model
{

	
  function __construct()
  {
    parent::__construct();

    $this->tableName = 'post';
    
  }
  
  function get_last_ten_entries()
  {
  	
  	$this->db->select('*');
  	$this->db->order_by("id", "desc");
  	$query = $this->db->get($this->tableName, 3);
  	$array=array();
  	foreach($query->result() as $key=>$items){
  		if($items->user===NULL){
  			$items->user=_find_user_from_id_auth($this,_get_id_guest_auth($this));
  		}else{
  			$items->user=_find_user_from_id_auth($this,$items->user);
  		}
  		array_push($array,$items);
  	}
  	return $array;
  	
  	/**
  	$query = $this->db->get($this->tableName, 10);
  	return $query->result();
  	*/
  }

}

