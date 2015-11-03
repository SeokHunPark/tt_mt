<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_paid extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('gamedb');
		$this->load->model('user_info_m');
		$this->load->model('mail_m');
		$this->load->model('log_gain_mail_m');
		$this->load->model('log_cstool_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		print "item paid index()";
		$this->load_view();
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
		#$this->load->view('/user_info/mail_box_popup_v');
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_view()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		$this->load->view('/game_management/item_paid_v');
	}
	
	public function send_all_item()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if (isset($_POST['send_button']))
		{
			$user_list_text = $this->input->post('user_list_text', TRUE);
			$item_list_text = $this->input->post('item_list_text', TRUE);
			$message = $this->input->post('message_text', TRUE);
			
			if (!isset($_POST['mode_radio']))
			{
				alert("입력 형식을 선택해야 합니다.", '/game_management/item_paid');
				exit;
			}
			
			if ($user_list_text == '' || $item_list_text == '' || $message == '')
			{
				alert("입력하지 않은 항목이 있습니다.", '/game_management/item_paid');
				exit;
			}
			
			$max_size = 5000;
			$user_id_list = array();
			if ($_POST['mode_radio'] == 'radio_nickname')
			{
				$nickname_list = explode("\n", $user_list_text);
				if (count($nickname_list) > $max_size)
				{
					alert("유저 닉네임을 5000개 이하로 입력해 주십시오.", '/game_management/item_paid');
					exit;
				}
				
				foreach ($nickname_list as $nickname)
				{
					$user_id = $this->user_info_m->get_user_id_with_nickname($nickname);
					if ($user_id != '')
					{
						array_push($user_id_list, $user_id);
					}
				}
			}
			else if ($_POST['mode_radio'] == 'radio_user_id')
			{
				$id_list = explode("\n", $user_list_text);
				if (count($id_list) > $max_size)
				{
					alert("유저 아이디를 5000개 이하로 입력해 주십시오.", '/game_management/item_paid');
					exit;
				}
				
				foreach ($id_list as $user_id)
				{
					if ($user_id != '')
					{
						array_push($user_id_list, $user_id);
					}
				}
			}
			
			$item_list = explode("\n", $item_list_text);
			if (count($item_list) > 10)
			{
				alert("아이템 종류를 10개 이하로 입력해 주십시오.", '/game_management/item_paid');
				exit;
			}
			$item_string_list = array();
			foreach ($item_list as $item)
			{
				if ($item != '')
				{
					array_push($item_string_list, $item);
				}
			}
			
			$send_ts = time();
			$partkey_month = date("m", $send_ts);
			$reg_date = date("Y-m-d H:i:s", $send_ts);
			$expire_date = date("Y-m-d H:i:s", $send_ts + (60 * 60 * 24 * 7));
			
			foreach ($item_string_list as $item_string)
			{
				$item_info = $this->get_item_info($item_string);
				if (count($item_info) != 3)
				{
					alert("잘못된 아이템 문자열이 포함되어 있습니다.", '/game_management/item_paid');
					exit;
				}
			}
			
			foreach ($user_id_list as $user_id)
			{
				foreach ($item_string_list as $item_string)
				{
					$return = $this->send_item($partkey_month, $user_id, $send_ts, $message, $message, $item_string, $reg_date, $expire_date);
					if ($return)
					{
						$ip_address = $_SERVER['REMOTE_ADDR'];
						$action = '아이템 지급';
						$item_info = $this->get_item_info($item_string);
						$item_id = $item_info[1];
						$item_count = $item_info[2];
						$memo = $message;
						$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
					}
				}
			}
			
			alert("아이템 지급이 완료되었습니다.", '/game_management/item_paid');
		}
	}
	
	public function send_item($partkey_month, $user_id, $send_ts, $title, $message, $item_string, $reg_date, $expire_date)
	{
		$mail_type = 'G';
		$sender_id = 0;
		$is_received = 0;
		$categ = 'T';
		
		$this->log_gain_mail_m->insert_log($partkey_month, $user_id, $sender_id, $mail_type, $title, $item_string, $categ, $reg_date);
		return $this->mail_m->insert_mail($user_id, $sender_id, $mail_type, $send_ts, $title, $message, $is_received, $item_string, $categ, $reg_date, $expire_date);
	}
	
	public function get_item_info($item_string)
	{
		$item_info = explode(":", $item_string);
		return $item_info;
	}
}