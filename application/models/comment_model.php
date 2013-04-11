<?php

class Comment_model extends CI_Model
{

	
  function __construct()
  {
    parent::__construct();

    $this->tableName = 'comment';
    
  }
  
  function get_last_entries($a)
  {	
  	$this->db->select('*');
  	$this->db->order_by("id", "desc");
  	$query = $this->db->get($this->tableName, 3);
  	$array=array();
  	foreach($query->result() as $key=>$items){
  		if($items->user===NULL){
  			$items->user=_find_user_from_id_auth($a,_get_id_guest_auth($a));
  		}else{
  			$items->user=_find_user_from_id_auth($a,$items->user);
  		}
  		array_push($array,$items);
  	}
  	return $array;
  }
  
  function insert($options=array()){
  	$options=array_change_key_case($options,CASE_LOWER);
  	if(isset($options['text']) && strlen(trim($options['text']))){
  		$this->db->insert('comment', $options);
  	}
  }

}

