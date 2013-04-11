<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('comment_model');
		if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			header('Location: '.$this->uri->config->item('base_url'));
			exit;
		}
	}
	
	public function index()
	{
		if(_is_create_comment($this)){
			ob_start();
			$this->load->view('comment/index_view');
			$content=ob_get_contents();
			ob_end_clean();
			echo json_encode(array('status'=>'OK','html'=>$content));
		}else{
			echo json_encode(array('status'=>'ERROR','message'=>'Access denied...'));
		}
		//$this->load->view('comment/index_view');
	}
	public function add()
	{
		if(_is_create_comment($this)){
			var_dump($this->input->post('id'));
			$this->form_validation->set_rules('comment', 'Comment', 'trim|required|xss_clean');
			if(false===$this->form_validation->run()){
				ob_start();
				$this->load->view('comment/index_view');
				$content=ob_get_contents();
				ob_end_clean();
				echo json_encode(array('status'=>'ERROR','html'=>$content));
			}else{
				/**
				$user
				$this->db->insert('comment', array(''));
				*/
				//var_dump($this->acl_model->acl_name_id(_if_auth($this)));exit;
				/**
				var_dump(_get_id_user_auth($this));exit;
				if(false!==_if_auth($this)){
					
				}
				*/
				if(NULL===_get_id_user_auth($this)){
					$array=array('text'=>$this->input->post('comment'));
				}else{
					$array=array('user'=>_get_id_user_auth($this),'text'=>$this->input->post('comment'));
				}
				$this->comment_model->insert($array);
				//$this->db->insert('comment', array(''));
				//$user=(false===($a=$this->acl_model->acl_name_id(_if_auth($this))))?NULL:$a;
				
				/**
				$this->db->select('user.nickname as user, comment.text as text, comment.id as id', false);
				$this->db->join("user", "user.id = comment.user", "inner");
				//$this->db->group_by("user.role");
				$this->db->order_by("id", "desc");
				
				var_dump($this->db->get('comment')->result_array());exit;
				*/
				
				$items=$this->comment_model->get_last_entries($this);
				//var_dump($items);exit;
				ob_start();
				$this->load->view('comment/list_view',array('items'=>$items));
				$content=ob_get_contents();
				ob_end_clean();
				echo json_encode(array('status'=>'OK','html'=>$content));
			}
		}else{
			echo json_encode(array('status'=>'ERROR','message'=>'Access denied...'));
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */