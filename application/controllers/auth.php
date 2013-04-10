<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	
function __construct()
   {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('acl_model');
   }
	
	public function index()
	{
		_auth($this, $this->uri->config->item('base_url'));
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', 'Remember me', 'integer');
			if(false===$this->form_validation->run()){
				ob_start();
				$this->load->view('auth/login_view');
				$content=ob_get_contents();
				ob_end_clean();
				echo json_encode(array('status'=>'ERROR','html'=>$content));
				exit;
			}else{
				if(!$this->acl_model->find_user($this->input->post('login'),$this->input->post('password'))){
					ob_start();
					$this->load->view('auth/login_view',array('form_error'=>'Incorrectly typed or user name or password'));
					$content=ob_get_contents();
					ob_end_clean();
					echo json_encode(array('status'=>'ERROR','html'=>$content));
					exit;
				}
				//return $query->result();
				//var_dump($this->input->post('login'));
				_set_auth($this);
				echo json_encode(array('status'=>'OK'));
				exit;
			}
		}else{
        	ob_start();
        	$this->load->view('auth/login_view');
        	$content=ob_get_contents();
        	ob_end_clean();
        	$this->load->view('auth_layout',array('content'=>$content));
		}
	}
	
	/**
    * Register user on the site
    *
    * @return void
    */
   function register()
   {
      if ($this->tank_auth->is_logged_in()) {                           // logged in
         redirect('');

      } elseif ($this->tank_auth->is_logged_in(FALSE)) {                  // logged in, not activated
         redirect('/auth/send_again/');

      } elseif (!$this->config->item('allow_registration', 'tank_auth')) {   // registration is off
         $this->_show_message($this->lang->line('auth_message_registration_disabled'));
         return;

      } else {
         $use_username = $this->config->item('use_username', 'tank_auth');
         /*if ($use_username) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']|alpha_dash');
         }*/
         $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
         $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
         $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
         $this->form_validation->set_rules('firstname', 'First name', 'trim|required|xss_clean');
         $this->form_validation->set_rules('lastname', 'Last name', 'trim|required|xss_clean');
         $this->form_validation->set_rules('street_address', 'Street Address 1', 'trim|required|xss_clean');
         $this->form_validation->set_rules('street_address_opt', 'Street Address 2', 'trim|xss_clean');
         $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
         $this->form_validation->set_rules('state_province', 'State/province', 'trim|required|xss_clean');
         $this->form_validation->set_rules('zip_code', 'Zip code', 'trim|required|xss_clean');
         $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
         $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|xss_clean');

         $captcha_registration   = $this->config->item('captcha_registration', 'tank_auth');
         $use_recaptcha         = $this->config->item('use_recaptcha', 'tank_auth');
         if ($captcha_registration) {
            if ($use_recaptcha) {
               $this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
            } else {
               $this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
            }
         }
         $data['errors'] = array();

         $email_activation = $this->config->item('email_activation', 'tank_auth');

         if ($this->form_validation->run()) {                        // validation ok
            if (!is_null($data = $this->tank_auth->create_user(
                  $use_username ? $this->form_validation->set_value('email') : '',
                  $this->form_validation->set_value('email'),
                  $this->form_validation->set_value('password'),
                  current($this->option_model->retrieve('default_points')),
                  $email_activation ))) {                           // success

               $data['site_name'] = $this->config->item('website_name', 'tank_auth');

               $user_profile['firstname'] = $this->form_validation->set_value('firstname');
               $user_profile['lastname'] = $this->form_validation->set_value('lastname');
               $user_profile['street_address'] = $this->form_validation->set_value('street_address');
               $user_profile['street_address_opt'] = $this->form_validation->set_value('street_address_opt');
               $user_profile['city'] = $this->form_validation->set_value('city');
               $user_profile['state_province'] = $this->form_validation->set_value('state_province');
               $user_profile['zip_code'] = $this->form_validation->set_value('zip_code');
               $user_profile['country'] = $this->form_validation->set_value('country');
               $user_profile['phone_number'] = $this->form_validation->set_value('phone_number');
               $user_profile['website'] = $data['site_name'];
               $user_profile['user_id'] = $data['user_id'];

                if (!$email_activation)
                  $this->users->update_profile($data['user_id'], $user_profile);
                else
                 $this->users->create_profile(null, $user_profile);

               if ($email_activation) {                           // send "activate" email
                  $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

                  $this->_send_email('activate', $data['email'], $data);
                  $callback_msg = $this->lang->line('auth_message_registration_completed_1');
               } else {
                  if ($this->config->item('email_account_details', 'tank_auth')) {   // send "welcome" email

                     $this->_send_email('welcome', $data['email'], $data);
                  }
                  $callback_msg = $this->lang->line('auth_message_registration_completed_2');
                  //$this->bring_your_friend($data['user_id'], $callback_msg);
               }
               $this->session->set_userdata('registration_user_id', $data['user_id']);
               $this->session->set_userdata('registration_callback_msg', $callback_msg);
               unset($data['password']); // Clear password (just for any case)
               redirect(base_url('/auth/bring_your_friend'));
               return;
            } else {
               $errors = $this->tank_auth->get_error_message();
               foreach ($errors as $k => $v)   $data['errors'][$k] = $this->lang->line($v);
            }
         }
         if ($captcha_registration) {
            if ($use_recaptcha) {
               $data['recaptcha_html'] = $this->_create_recaptcha();
            } else {
               $data['captcha_html'] = $this->_create_captcha();
            }
         }

         $data['countries'] = $this->db->get('countries')->result_array();
         $data['states'] = $this->db->get('states')->result_array();
         $data['use_username'] = $use_username;
         $data['captcha_registration'] = $captcha_registration;
         $data['use_recaptcha'] = $use_recaptcha;

         $data['page'] = (object) array( 'current_page' => 'register' );
         $this->load->view('common/register', $data);
      }
   }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */