<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wall extends CI_Controller {

	
	function __construct()
	{
		parent::__construct();
	
		$this->load->model('post_model');
		
	}
	
	public function index()
	{
		$items=$this->post_model->get_last_ten_entries();
		//var_dump($items);exit;
		//$a=_is_create_comment($this);
		//var_dump($a);exit;
		$data='yes';
		$request=(object)array('items'=>$items,'data'=>$data);
		
		//$this->load->view('wall/index_view',$request);
		
		ob_start();
		$this->load->view('wall/index_view',$request);
		$content=ob_get_contents();
		ob_end_clean();
		$this->load->view('wall_layout',array('content'=>$content));
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */