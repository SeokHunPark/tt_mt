<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game_notice extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('globaldb');
		#$this->load->model('user_info_m');
		$this->load->model('notice_ingame_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		print "ingame notice index()";
		$this->load_notice();
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
		$this->load->view('/game_management/game_notice_popup_v');
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_notice()
	{
		$this->output->enable_profiler(TRUE);
		
		$_notice_list = $this->notice_ingame_m->get_notice_list();
		$data['notice_list'] = $this->make_view_data($_notice_list);
		
		$this->load->view('/game_management/game_notice_v', $data);
	}
	
	public function make_view_data($_notice_list)
	{
		$notice_list = array();
		for ($i = 0; $i < count($_notice_list); $i++)
		{
			$notice_list[$i]['notice_no'] = $_notice_list[$i]->notice_no;
			$notice_list[$i]['platform'] = $_notice_list[$i]->platform;
			$notice_list[$i]['title'] = $_notice_list[$i]->title;
			$notice_list[$i]['begin_date'] = $_notice_list[$i]->begin_date;
			$notice_list[$i]['end_date'] = $_notice_list[$i]->end_date;
			$notice_list[$i]['used'] = $_notice_list[$i]->used;
			if ($notice_list[$i]['used'] == 'Y')
			{
				$notice_list[$i]['state'] = "적용 중";
			}
			else
			{
				$notice_list[$i]['state'] = "종료";
			}
		}
		return $notice_list;
	}
	
	public function reg_notice()
	{
		$this->output->enable_profiler(TRUE);
		
		if (isset($_POST))
		{
			$platform = "0";
			$title = $this->input->post('title_text', TRUE);
			$begin_date = $this->input->post('begin_day_text', TRUE) . ' ' . $this->input->post('begin_time_text', TRUE);
			$end_date = $this->input->post('end_day_text', TRUE) . ' ' . $this->input->post('end_time_text', TRUE);
			$body = $this->input->post('body_text', TRUE);
			$used = "Y";
			
			if ($platform == "" || $begin_date == "" || $end_date == "" || $body == "")
			{
				alert("내용을 입력하십시오.");
			}
			
			$this->notice_ingame_m->reg_notice($platform, $title, $begin_date, $end_date, $body, $used);
		}
		
		$this->load_notice();
	}
	
	public function cancel_notice()
	{
		$this->output->enable_profiler(TRUE);
		
		if (isset($_POST))
		{
			$notice_no = $this->input->post('notice_no_text', TRUE);
			$this->notice_ingame_m->cancel_notice($notice_no);
		}
		
		$this->load_notice();
	}
}