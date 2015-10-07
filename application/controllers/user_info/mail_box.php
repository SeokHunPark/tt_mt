<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail_box extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('gamedb');
		$this->load->model('user_info_m');
		$this->load->model('mail_m');
		$this->load->model('log_mail_m');
		
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		$this->load_mail_box();
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
	
	public function load_mail_box()
	{
		$this->output->enable_profiler(TRUE);
		
		#$_mail_list = $this->mail_m->get_mail_list(0, 60);
		
		$this->load->library('pagination');
		$size = 10;
		
		$mail_list = [];
		$mail_log_list = [];
		
		$mode = $this->uri->segment(4, 0);
		if ($mode == "date_search")
		{	
			$offset = $this->uri->segment(7, 0);
			$begin_date = $this->uri->segment(5, 0) . " 00:00:00";
			$end_date = $this->uri->segment(6, 0) . " 23:59:59";
			
			$_mail_list = $this->mail_m->get_list_with_date($begin_date, $end_date);
			$config['base_url'] = '/user_info/mail_box/load_mail_box/date_search/' . $this->uri->segment(5, 0) . '/' . $this->uri->segment(6, 0) . '/';
			$config['total_rows'] = count($_mail_list);
			$config['per_page'] = $size;
			$config['uri_segment'] = 7;
			$this->pagination->initialize($config);
			$mail_list = $this->make_view_data(array_splice($_mail_list, (int)$offset, (int)$size));
			
			$_mail_log_list = $this->log_mail_m->get_list_with_date($begin_date, $end_date);
		}
		else if ($mode == "user_search")
		{
			$offset = $this->uri->segment(6, 0);
			$user_id = $this->uri->segment(5, 0);
			
			$_mail_list = $this->mail_m->get_list_with_user_id($user_id);
			
			$config['base_url'] = '/user_info/mail_box/load_mail_box/user_search/' . $user_id . '/';
			$config['total_rows'] = count($_mail_list);
			$config['per_page'] = $size;
			$config['uri_segment'] = 6;
			$this->pagination->initialize($config);
			
			$offset = $this->uri->segment(6, 0);
			$mail_list = $this->make_view_data(array_splice($_mail_list, (int)$offset, (int)$size));
		}
		
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

				$_mail_list = $this->mail_m->get_list_with_date($begin_date, $end_date);
				
				$begin_date = $begin_year . "-" . $begin_month . "-" . $begin_day;
				$end_date = $end_year . "-" . $end_month . "-" . $end_day;
				
				$config['base_url'] = '/user_info/mail_box/load_mail_box/date_search/' . $begin_date . '/' . $end_date . '/';
				$config['total_rows'] = count($_mail_list);
				$config['per_page'] = $size;
				$config['uri_segment'] = 7;
				$this->pagination->initialize($config);
				
				$offset = $this->uri->segment(7, 0);
				$mail_list = $this->make_view_data(array_splice($_mail_list, (int)$offset, (int)$size));
			}
			else
			{
				alert("날짜를 입력하십시오.");
			}
		}
		else if (isset($_POST['week_search']))
		{			
			$time = time();
			$start_date = date("Y-m-d", $time);
			$end_date = date("Y-m-d", $time + (60 * 60 * 24 * 7));
			
			$_mail_list = $this->mail_m->get_list_with_date($begin_date . " 00:00:00", $end_date . " 23:59:59");
			
			$config['base_url'] = '/user_info/mail_box/load_mail_box/date_search/' . $begin_date . '/' . $end_date . '/';
			$config['total_rows'] = count($_mail_list);
			$config['per_page'] = $size;
			$config['uri_segment'] = 7;
			$this->pagination->initialize($config);
			
			$offset = $this->uri->segment(7, 0);
			$mail_list = $this->make_view_data(array_splice($_mail_list, (int)$offset, (int)$size));
		}
		else if (isset($_POST['user_search']))
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
			
			$_mail_list = $this->mail_m->get_list_with_user_id($user_id);
			
			$config['base_url'] = '/user_info/mail_box/load_mail_box/user_search/' . $user_id . '/';
			$config['total_rows'] = count($_mail_list);
			$config['per_page'] = $size;
			$config['uri_segment'] = 6;
			$this->pagination->initialize($config);
			
			$offset = $this->uri->segment(6, 0);
			$mail_list = $this->make_view_data(array_splice($_mail_list, (int)$offset, (int)$size));
		}
		
		$data['pagination'] = $this->pagination->create_links();
		$data['mail_list'] = $mail_list;
		$this->load->view('/user_info/mail_box_v', $data);
	}
	
	public function make_view_data($_mail_list)
	{
		$mail_list = [];
		for ($i = 0; $i < count($_mail_list); $i++)
		{
			$mail_list[$i]['mail_idx'] = $_mail_list[$i]->mail_idx;
			$item_string = $_mail_list[$i]->item_string;
			$item_array = explode(':', $item_string);
			$mail_list[$i]['item_name'] = $item_array[1];
			$mail_list[$i]['item_count'] = $item_array[2];
			$mail_list[$i]['sender'] = "";
			$mail_list[$i]['description'] = $_mail_list[$i]->title;
			$mail_list[$i]['reg_date'] = $_mail_list[$i]->reg_date;
			$mail_list[$i]['expire_date'] = $_mail_list[$i]->expire_date;
			
			$mail_list[$i]['recv_date'] = "";
			
			$time = time();
			$date_string = "%Y-%m-%d %h:%i:%s";
			$current_date = mdate($date_string, $time);
			if ($mail_list[$i]['expire_date'] > $current_date)
			{
				$mail_list[$i]['stats'] = "대기";
			}
			else
			{
				$mail_list[$i]['stats'] = "만료";
			}
		}
		
		return $mail_list;
	}
	
	public function get_mail_list_with_date($begin_date, $end_date, $start, $size)
	{
		$mail_list = [];
		$_mail_list = $this->mail_m->get_mail_list_with_date($begin_date, $end_date, $start, $size);
		
		for ($i = 0; $i < count($_mail_list); $i++)
		{
			$mail_list[$i]['mail_idx'] = $_mail_list[$i]->mail_idx;
			$item_string = $_mail_list[$i]->item_string;
			$item_array = explode(':', $item_string);
			$mail_list[$i]['item_name'] = $item_array[1];
			$mail_list[$i]['item_count'] = $item_array[2];
			$mail_list[$i]['sender'] = "";
			$mail_list[$i]['description'] = $_mail_list[$i]->title;
			$mail_list[$i]['reg_date'] = $_mail_list[$i]->reg_date;
			$mail_list[$i]['expire_date'] = $_mail_list[$i]->expire_date;
			
			$mail_list[$i]['recv_date'] = "";
			
			$time = time();
			$date_string = "%Y-%m-%d %h:%i:%s";
			$current_date = mdate($date_string, $time);
			if ($mail_list[$i]['expire_date'] > $current_date)
			{
				$mail_list[$i]['stats'] = "대기";
			}
			else
			{
				$mail_list[$i]['stats'] = "만료";
			}
		}
		
		return $mail_list;
	}
	
	public function get_mail_list($start, $size)
	{
		$mail_list = [];
		$_mail_list = $this->mail_m->get_mail_list($start, $size);
		
		for ($i = 0; $i < count($_mail_list); $i++)
		{
			$mail_list[$i]['mail_idx'] = $_mail_list[$i]->mail_idx;
			$item_string = $_mail_list[$i]->item_string;
			$item_array = explode(':', $item_string);
			$mail_list[$i]['item_name'] = $item_array[1];
			$mail_list[$i]['item_count'] = $item_array[2];
			$mail_list[$i]['sender'] = "";
			$mail_list[$i]['description'] = $_mail_list[$i]->title;
			$mail_list[$i]['reg_date'] = $_mail_list[$i]->reg_date;
			$mail_list[$i]['expire_date'] = $_mail_list[$i]->expire_date;
			
			$mail_list[$i]['recv_date'] = "";
			
			$time = time();
			$date_string = "%Y-%m-%d %h:%i:%s";
			$current_date = mdate($date_string, $time);
			if ($mail_list[$i]['expire_date'] > $current_date)
			{
				$mail_list[$i]['stats'] = "대기";
			}
			else
			{
				$mail_list[$i]['stats'] = "만료";
			}
			
		}
		
		return $mail_list;
	}
}