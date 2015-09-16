<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_SimpleLog {

	public function __construct()
	{
		$CI = & get_instance();
		$CI->load->helper('date');
		$CI->load->database('dev');
	}
	
	public function write_log($admin_id, $action)
	{
		$CI = & get_instance();
		
		$date_string = "%Y-%m-%d %h:%i:%s";
		$time = mdate($date_string, time());
		#echo $time;
		#$log_info['date'] = standard_date('DATE_ATOM', time());
		$log_info['date'] = $time;
		$log_info['ip'] = $CI->input->ip_address();;
		$log_info['admin_id'] = $admin_id;
		$log_info['action'] = $action;
		$CI->db->insert('test.log_admin_action', $log_info);
	}
}

/* End of file SimpleLog.php */