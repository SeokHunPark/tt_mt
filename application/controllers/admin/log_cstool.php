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
				print_r($_log_list);
				$begin_date = $begin_year . "-" . $begin_month . "-" . $begin_day;
				$end_date = $end_year . "-" . $end_month . "-" . $end_day;
				
				$config['base_url'] = '/admin/log_cstool/load_log/date_search/' . $begin_date . '/' . $end_date . '/';
				$config['total_rows'] = count($_log_list);
				$config['per_page'] = $size;
				$config['uri_segment'] = 7;
				$this->pagination->initialize($config);
				
				$offset = $this->uri->segment(7, 0);
				#$log_list = $this->make_view_data(array_splice($_log_list, (int)$offset, (int)$size));
				$log_list = $_log_list;
				print_r($log_list);
			}
			else
			{
				alert("날짜를 입력하십시오.");
			}
		}
		
		$data['log_list'] = $log_list;
		#$data['log_list'] = array();
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('/admin/log_cstool_v', $data);
	}
}