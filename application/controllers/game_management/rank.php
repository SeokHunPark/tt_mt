<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rank extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('logdb');
		$this->load->model('log_rank_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		print "top 300 index()";
		$this->load_ranking();
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
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_ranking()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		$rank_info_list = array();
		
		$this->load->library('pagination');
		$mode = $this->uri->segment(4, 0);
		$offset = $this->uri->segment(6, 0);
		$size = 50;
		$max_rows = 300;
		
		if (isset($_POST['date_search']))
		{
			$reg_year = $this->input->post('reg_year', TRUE);
			$reg_month = $this->input->post('reg_month', TRUE);
			$reg_day = $this->input->post('reg_day', TRUE);
			
			if ($reg_year != "" && $reg_month != "" && $reg_day != "")
			{
				$reg_date = $reg_year . "-" . $reg_month . "-" . $reg_day . " 00:00:00";

				$_rank_info_list = $this->log_rank_m->get_list_with_reg_date($reg_date, $size, $offset);
				
				$reg_date = $reg_year . "-" . $reg_month . "-" . $reg_day;
				
				$config['base_url'] = '/game_management/rank/load_ranking/date_search/' . $reg_date . '/';
				$config['total_rows'] = $max_rows;
				$config['per_page'] = $size;
				$config['uri_segment'] = 6;
				$this->pagination->initialize($config);
				
				$rank_info_list = $this->make_view_data($_rank_info_list);
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
				$reg_date = $this->uri->segment(5, 0) . " 00:00:00";
				
				$_rank_info_list = $this->log_rank_m->get_list_with_reg_date($reg_date, $size, $offset);
				$config['base_url'] = '/game_management/rank/load_ranking/date_search/' . $this->uri->segment(5, 0) . '/';
				$config['total_rows'] = $max_rows;
				$config['per_page'] = $size;
				$config['uri_segment'] = 6;
				$this->pagination->initialize($config);
				
				$rank_info_list = $this->make_view_data($_rank_info_list);
			}
		}
		
		$data['rank_info_list'] = $rank_info_list;
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('/game_management/rank_v', $data);
	}
	
	public function make_view_data($_rank_info_list)
	{
		$rank_info_list = array();
		for ($i = 0; $i < count($_rank_info_list); $i++)
		{
			$log = (array)$_rank_info_list[$i];
			$rank_info_list[$i] = $log;
		}
		return $rank_info_list;
	}
}