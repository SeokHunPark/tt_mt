<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'Predis/Autoloader.php';
Predis\Autoloader::register();

class Game_notice extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('globaldb');
		#$this->load->model('user_info_m');
		$this->load->model('notice_ingame_m');
		$this->load->model('log_cstool_m');
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
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
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
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
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
			
			$return = $this->notice_ingame_m->reg_notice($platform, $title, $begin_date, $end_date, $body, $used);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$user_id = NULL;
				$action = '공지 등록';
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				
				alert('공지 등록이 완료 되었습니다.', '/game_management/game_notice');
			}
		}
		
		#$this->load_notice();
	}
	
	public function cancel_notice()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if (isset($_POST))
		{
			$notice_no = $this->input->post('notice_no_text', TRUE);
			$return = $this->notice_ingame_m->cancel_notice($notice_no);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$user_id = NULL;
				$action = '공지 취소';
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				
				alert('공지가 취소 되었습니다.', '/game_management/game_notice');
			}
		}
		
		#$this->load_notice();
	}
	
	public function publish()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		$channel = "pubsub_contents";
		$message = "notice";
		
		$redis_host =  $this->config->item('redis_host');
		
		#print "redis_host : $redis_host";
		
		$redis = new Predis\Client('tcp://' . $redis_host);
		$return = $redis->publish($channel, $message);
		if ($return)
		{
			$time = time();
			$date_string = "Y-m-d H:i:s";
			$reg_date = date($date_string, $time);
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$user_id = NULL;
			$action = '게임 공지 변경 사항 적용';
			$item_id = NULL;
			$item_count = NULL;
			$memo = '';
			$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
			
			alert('변경 사항이 적용 되었습니다.', '/game_management/game_notice');
		}
		
		#$this->index();
	}
	
	public function spot_notice()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if (isset($_POST))
		{
			$spot_text = $this->input->post('body_text', TRUE);
			print $spot_text;
			if (strlen($spot_text) <= 0)
			{
				alert('공지 내용을 입력 하십시오.', '/game_management/game_notice');
			}
			// else if (strlen($spot_text) >= 200)
			// {
				// alert('200자(영문기준, 공백 포함) 이하로 입력하십시오.', '/game_management/game_notice');
			// }
			
			$return = $this->spot_publish($spot_text);
			#print "Return : $return";
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$user_id = NULL;
				$action = '스팟 공지 발송';
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				
				alert('스팟 공지가 발송 되었습니다.', '/game_management/game_notice');
			}
		}
		
		#$this->load_notice();
	}
	
	public function spot_publish($spot_text)
	{
		$this->output->enable_profiler(TRUE);
		
		$channel = "notice";
		$message = $spot_text;
		
		$redis_host =  $this->config->item('redis_host');
		
		#print "redis_host : $redis_host";
		
		$redis = new Predis\Client('tcp://' . $redis_host);
		return $redis->publish($channel, $message);
		
		#$this->index();
	}
}