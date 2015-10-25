<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_leave extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('log_leave_m');
		$this->load->model('user_info_m');
		$this->load->helper(array('url', 'form', 'alert_helper'));
	}
	
	public function index()
	{
		print 'log_leave index()';
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
		$mode = $this->uri->segment(4, 0);
		$offset = $this->uri->segment(8, 0);
		$size = 10;
		$max_rows = 1000;
		
		if (isset($_POST['date_search']))
		{
			$begin_year = $this->input->post('begin_year', TRUE);
			$begin_month = $this->input->post('begin_month', TRUE);
			$begin_day = $this->input->post('begin_day', TRUE);
			$end_year = $this->input->post('end_year', TRUE);
			$end_month = $this->input->post('end_month', TRUE);
			$end_day = $this->input->post('end_day', TRUE);
			
			$user_id = "-1";
			if ($_POST['game_account_id_text'] != "")
			{
				$user_id = $this->input->post('game_account_id_text', TRUE);
			}
			else if ($_POST['nickname_text'] != "")
			{
				$nickname = $this->input->post('nickname_text', TRUE);
				$user_id = $this->user_info_m->get_user_id_with_nickname($nickname);
			}
			
			if ($begin_year != "" && $begin_month != "" && $begin_day != "" &&
				$end_year != "" && $end_month != "" && $end_day != "")
			{
				$begin_date = $begin_year . "-" . $begin_month . "-" . $begin_day . " 00:00:00";
				$end_date = $end_year . "-" . $end_month . "-" . $end_day . " 23:59:59";

				$_log_list = $this->log_leave_m->get_list_with_date($user_id, $begin_date, $end_date, $size, $offset);
				
				$begin_date = $begin_year . "-" . $begin_month . "-" . $begin_day;
				$end_date = $end_year . "-" . $end_month . "-" . $end_day;
				
				$config['base_url'] = '/log/log_leave/load_log/date_search/' . $user_id . '/' . $begin_date . '/' . $end_date . '/';
				$config['total_rows'] = $max_rows;
				$config['per_page'] = $size;
				$config['uri_segment'] = 8;
				$this->pagination->initialize($config);
				
				$log_list = $this->make_view_data($_log_list);
			}
			else
			{
				alert("날짜를 입력하십시오.");
			}
		}
		else
		{
			if (strcmp($mode, "date_search") == 0)
			{
				$offset = $this->uri->segment(8, 0);
				$user_id = $this->uri->segment(5, -1);
				$begin_date = $this->uri->segment(6, 0) . " 00:00:00";
				$end_date = $this->uri->segment(7, 0) . " 23:59:59";
				
				$_log_list = $this->log_leave_m->get_list_with_date($user_id, $begin_date, $end_date, $size, $offset);
				$config['base_url'] = '/log/log_leave/load_log/date_search/' . $user_id . '/' . $this->uri->segment(6, 0) . '/' . $this->uri->segment(7, 0) . '/';
				$config['total_rows'] = $max_rows;
				$config['per_page'] = $size;
				$config['uri_segment'] = 8;
				$this->pagination->initialize($config);
				
				$log_list = $this->make_view_data($_log_list);
			}
		}
		
		$data['log_list'] = $log_list;
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('/log/log_leave_v', $data);
	}
	
	public function make_view_data($_log_list)
	{
		$log_list = array();
		for ($i = 0; $i < count($_log_list); $i++)
		{
			$log = (array)$_log_list[$i];
			$log_list[$i] = $log;
		}
		return $log_list;
	}
}