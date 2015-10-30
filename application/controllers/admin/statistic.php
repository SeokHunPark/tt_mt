<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistic extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		#$this->load->model('log_cstool_m');
		$this->load->model('user_info_m');
		$this->load->model('log_cu_m');
		$this->load->helper(array('url', 'form', 'alert_helper'));
	}
	
	public function index()
	{
		print 'statistics index()';
		$this->load_statistic();
	}
	
	// public function _remap($method)
	// {
		// // header include.
		// $this->load->view('header_v');
		
		// // nav include.
		// $this->load->view('nav_v');
		
		// // nav include.
		// if (method_exists($this, $method))
		// {
			// $this->{"{$method}"}();
		// }
		
		// // footer include.
		// $this->load->view('footer_v');
	// }
	
	public function load_statistic()
	{
		#$this->output->enable_profiler(TRUE);
		
		// if (@$this->session->userdata('logged_in') != TRUE)
		// {
			// alert('로그인 후 사용 가능합니다.', '/auth');
			// exit;
		// }
		// $admin_name = $this->session->userdata('username');
		
		$cu_info = $this->log_cu_m->get_recent_row();
		
		$data['cu_info'] = $cu_info[0];
		$this->load->view('/admin/statistic_v', $data);
	}
	
	public function make_view_data()
	{
		$order_list = array();
		for ($i = 0; $i < count($_order_list); $i++)
		{
			$order = (array)$_order_list[$i];
			$order_list[$i] = $order;
		}
		return $order_list;
	}
}