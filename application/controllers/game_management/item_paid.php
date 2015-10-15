<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_paid extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('gamedb');
		$this->load->model('user_info_m');
		$this->load->model('mail_m');
		
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
		
		$this->load->view('/game_management/item_paid_v');
	}
	
	public function send_all_item()
	{
		$this->output->enable_profiler(TRUE);
		
		if (isset($_POST['send_button']))
		{
			$user_list_text = $this->input->post('user_list_text', TRUE);
			$item_list_text = $this->input->post('item_list_text', TRUE);
			$message = $this->input->post('message_text', TRUE);
			
			$nickname_list = explode("\n", $user_list_text);
			$user_id_list = array();
			foreach ($nickname_list as $nickname)
			{
				$user_id = $this->user_info_m->get_user_id_with_nickname($nickname);
				if ($user_id != '')
				{
					array_push($user_id_list, $user_id);
				}
			}
			print_r($user_id_list);
			
			$temp = explode("\n", $item_list_text);
			$item_string_list = array();
			foreach ($temp as $t)
			{
				if ($t != '')
				{
					array_push($item_string_list, $t);
				}
			}
			
			$send_ts = time();
			$reg_date = date("Y-m-d H:i:s", $send_ts);
			
			foreach ($user_id_list as $user_id)
			{
				foreach ($item_string_list as $item_string)
				{
					$this->send_item($user_id, $send_ts, $message, $message, $item_string, $reg_date);
				}
			}
			
			alert("아이템 지급이 완료되었습니다.", '/game_management/item_paid');
		}
	}
	
	public function send_item($user_id, $send_ts, $title, $message, $item_string, $reg_date)
	{
		$mail_type = 'G';
		$sender_id = 0;
		$is_received = 0;
		$categ = 'P';
		$expire_date = $reg_date;
		
		$this->mail_m->insert_mail($user_id, $sender_id, $mail_type, $send_ts, $title, $message, $is_received, $item_string, $categ, $reg_date, $expire_date);
	}
}