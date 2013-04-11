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

if ( ! function_exists('_comment_get_last_entries'))
{
	function _comment_get_last_entries($a)
	{
		return $a->comment_model->get_last_entries($a);		
	}
}
/* End of file auth_helper.php */
/* Location: ./application/helpers/auth_helper.php */