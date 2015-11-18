<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('globaldb');
		$this->load->model('cs_admin_m');
		$this->load->model('log_cstool_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		print "admins index()";
		$this->load_admin_list();
	}
	
	public function _remap($method)
	{
		// header include.
		$this->load->view('header_v');
		
		// nav include.
		$this->load->view('nav_v');
		
		if (method_exists($this, $method))
		{
			$this->{"{$method}"}();
		}
		
		// popup include.
		$this->load->view('/admin/admins_popup_v');

		// footer include.
		$this->load->view('footer_v');
	}

	public function load_admin_list()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');

		$admin_list = array();

		$_admin_list = $this->cs_admin_m->get_admin_list();
		$admin_list = $this->make_view_data($_admin_list);

		$data['admin_list'] = $admin_list;
		$this->load->view('/admin/admins_v', $data);
	}

	public function make_view_data($_admin_list)
	{
		$admin_list = array();
		for ($i = 0; $i < count($_admin_list); $i++)
		{
			$admin = (array)$_admin_list[$i];
			$admin_list[$i] = $admin;
		}
		return $admin_list;
	}

	public function delete_admin()
	{
		$this->output->enable_profiler(TRUE);

		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');

		if (isset($_POST['delete_admin_user_idx_text']))
		{
			$user_idx = $this->input->post('delete_admin_user_idx_text', TRUE);

			$return = $this->cs_admin_m->delete_admin($user_idx);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '관리자 삭제';
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_idx, $action, $item_id, $item_count, $memo);
				
				alert('관리자 삭제가 완료 되었습니다.', '/admin/admins/');
			}
		}
	}
}