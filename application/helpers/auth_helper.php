<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
if ( ! function_exists('_auth'))
{
	function _auth($a,$url=NULL)
	{
		if(NULL!==$url && strlen(trim($url)) && false!==($s=$a->session->userdata('auth')) && false!==($c=$a->input->cookie('test_auth')) && $s==$c){
			header('location: '.$url);
			exit;
		}
	}
}
if ( ! function_exists('_if_auth'))
{
	function _if_auth($a)
	{
		if(false!==($s=$a->session->userdata('auth')) && false!==($c=$a->input->cookie('test_auth')) && $s==$c){
			return TRUE;
		}
		return FALSE;
	}
}
if ( ! function_exists('_set_auth'))
{
	function _set_auth($a)
	{
		$auth=mt_rand().'-'.mt_rand().'-'.mt_rand().'-'.mt_rand();
		$a->input->set_cookie(
			array(
				'name'=>'auth',
				'value'=>$auth,
				'expire'=>'86500',
				'domain' => '',
				'path' => '/',
				'prefix' => 'test_',
				TRUE
			)
		);
		if(false!==$a->session->userdata('auth')){
			$a->session->unset_userdata('auth');
		}
		$a->session->set_userdata('auth', $auth);
		return $auth;
	}
}

/* End of file url_helper.php */
/* Location: ./system/helpers/url_helper.php */