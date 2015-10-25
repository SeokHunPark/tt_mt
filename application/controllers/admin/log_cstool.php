<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_cstool extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('log_cstool_m');
		$this->load->helper(array('url', 'form', 'alert_helper'));
	}
	
	public function index()
	{
		print 'log_cstool index()';
		$this->load_log();
	}
	
	public function _remap($method)
	{
		// header include.
		$this->load->view('header_v');
		
		// nav include.
		$this->load->view('nav_v');
		
		// nav include.
		if (method_exists($this, $method))
		{
			$this->{"{$method}"}();
		}
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_log()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		$log_list = array();
		
		$this->load->library('pagination');
		$size = 10;
		$max_rows = 1000;
		$mode = $this->uri->segment(4, 0);
		
		if (isset($_POST['date_search']))
		{
			$begin_year = $this->input->post('begin_year', TRUE);
			$begin_month = $this->input->post('begin_month', TRUE);
			$begin_day = $this->input->post('begin_day', TRUE);
			$end_year = $this->input->post('end_year', TRUE);
			$end_month = $this->input->post('end_month', TRUE);
			$end_day = $this->input->post('end_day', TRUE);
			
			if ($begin_year != "" && $begin_month != "" && $begin_day != "" &&
				$end_year != "" && $end_month != "" && $end_day != "")
			{
				$begin_date = $begin_year . "-" . $begin_month . "-" . $begin_day . " 00:00:00";
				$end_date = $end_year . "-" . $end_month . "-" . $end_day . " 23:59:59";

				$_log_list = $this->log_cstool_m->get_list_with_date($begin_date, $end_date);
				
				$begin_date = $begin_year . "-" . $begin_month . "-" . $begin_day;
				$end_date = $end_year . "-" . $end_month . "-" . $end_day;
				
				$config['base_url'] = '/admin/log_cstool/load_log/date_search/' . $begin_date . '/' . $end_date . '/';
				$config['total_rows'] = count($_log_list);
				$config['per_page'] = $size;
				$config['uri_segment'] = 7;
				$this->pagination->initialize($config);
				
				$offset = $this->uri->segment(7, 0);
				#$log_list = $this->make_view_data(array_splice($_log_list, (int)$offset, (int)$size));
				$log_list = array_splice($_log_list, (int)$offset, (int)$size);
			}
			else
			{
				alert("날짜를 입력하십시오.");
			}
		}
		else if (isset($_POST['user_search']))
		{
			if ($_POST['admin_name_text'] != "")
			{
				$admin_id = $this->input->post('admin_name_text', TRUE);
				$_log_list = $this->log_cstool_m->get_list_with_admin_name($admin_id);
				
				$config['base_url'] = '/admin/log_cstool/load_log/admin_search/' . $admin_id . '/';
				$config['total_rows'] = count($_log_list);
				$config['per_page'] = $size;
				$config['uri_segment'] = 6;
				$this->pagination->initialize($config);
				
				$offset = $this->uri->segment(6, 0);
				$log_list = array_splice($_log_list, (int)$offset, (int)$size);
			}
			else
			{
				$user_id = "";
				if ($_POST['game_account_id_text'] != "")
				{
					$user_id = $this->input->post('game_account_id_text', TRUE);
				}
				else if ($_POST['nickname_text'] != "")
				{
					$nickname = $this->input->post('nickname_text', TRUE);
					$user_id = $this->user_info_m->get_user_id_with_nickname($nickname);
				}
				
				$_log_list = $this->log_cstool_m->get_list_with_user_id($user_id);
				
				$config['base_url'] = '/admin/log_cstool/load_log/user_search/' . $user_id . '/';
				$config['total_rows'] = count($_log_list);
				$config['per_page'] = $size;
				$config['uri_segment'] = 6;
				$this->pagination->initialize($config);
				
				$offset = $this->uri->segment(6, 0);
				#$log_list = $this->make_view_data(array_splice($_log_list, (int)$offset, (int)$size));
				$log_list = array_splice($_log_list, (int)$offset, (int)$size);
			}
		}
		else
		{
			if (strcmp($mode, "date_search") == 0)
			{
				$offset = $this->uri->segment(7, 0);
				$begin_date = $this->uri->segment(5, 0) . " 00:00:00";
				$end_date = $this->uri->segment(6, 0) . " 23:59:59";
				
				$_log_list = $this->log_cstool_m->get_list_with_date($begin_date, $end_date);
				$config['base_url'] = '/admin/log_cstool/load_log/date_search/' . $this->uri->segment(5, 0) . '/' . $this->uri->segment(6, 0) . '/';
				$config['total_rows'] = count($_log_list);
				$config['per_page'] = $size;
				$config['uri_segment'] = 7;
				$this->pagination->initialize($config);
				
				$log_list = array_splice($_log_list, (int)$offset, (int)$size);
			}
			else if (strcmp($mode, "user_search") == 0)
			{
				$offset = $this->uri->segment(6, 0);
				$user_id = $this->uri->segment(5, 0);
				
				$_log_list = $this->log_cstool_m->get_list_with_user_id($user_id);
				
				$config['base_url'] = '/admin/log_cstool/load_log/user_search/' . $user_id . '/';
				$config['total_rows'] = count($_log_list);
				$config['per_page'] = $size;
				$config['uri_segment'] = 6;
				$this->pagination->initialize($config);
				
				$offset = $this->uri->segment(6, 0);
				$log_list = array_splice($_log_list, (int)$offset, (int)$size);
			}
			else if (strcmp($mode, "admin_search") == 0)
			{
				$offset = $this->uri->segment(6, 0);
				$admin_id = $this->uri->segment(5, 0);
				
				$_log_list = $this->log_cstool_m->get_list_with_admin_name($admin_id);
				
				$config['base_url'] = '/admin/log_cstool/load_log/admin_search/' . $admin_id . '/';
				$config['total_rows'] = count($_log_list);
				$config['per_page'] = $size;
				$config['uri_segment'] = 6;
				$this->pagination->initialize($config);
				
				$offset = $this->uri->segment(6, 0);
				$log_list = array_splice($_log_list, (int)$offset, (int)$size);
			}
		}
		
		$data['log_list'] = $log_list;
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('/admin/log_cstool_v', $data);
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