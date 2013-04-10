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
  	$query = $this->db->get($this->tableName, 10);
  	return $query->result();
  }

}

