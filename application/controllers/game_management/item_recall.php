<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_recall extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('gamedb');
		$this->load->model('user_info_m');
		$this->load->model('user_inven_m');
		$this->load->model('user_items_m');
		$this->load->model('user_supporters_m');
		$this->load->model('log_cstool_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		print "item recall index()";
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
		
		$result_string = $this->uri->segment(4, "");
		$data['result_string'] = $result_string;
		
		$this->load->view('/game_management/item_recall_v', $data);
	}
	
	public function recall_all_item()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if (isset($_POST['recall_button']))
		{
			$user_list_text = $this->input->post('user_list_text', TRUE);
			$item_list_text = $this->input->post('item_list_text', TRUE);
			$message = $this->input->post('message_text', TRUE);
			
			if ($user_list_text == '' || $item_list_text == '' || $message == '')
			{
				alert("입력하지 않은 항목이 있습니다.", '/game_management/item_recall');
				exit;
			}
			
			$nickname_list = explode("\n", $user_list_text);
			if (count($nickname_list) > 100)
			{
				alert("유저 닉네임을 100개 이하로 입력해 주십시오.", '/game_management/item_recall');
				exit;
			}
			$user_id_list = array();
			foreach ($nickname_list as $nickname)
			{
				$user_id = $this->user_info_m->get_user_id_with_nickname($nickname);
				if ($user_id != '')
				{
					array_push($user_id_list, $user_id);
				}
			}
			#print_r($user_id_list);
			
			$item_list = explode("\n", $item_list_text);
			if (count($item_list) > 10)
			{
				alert("아이템 종류를 10개 이하로 입력해 주십시오.", '/game_management/item_recall');
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
			
			#print_r($item_string_list);
			$result_string_all = "";
			foreach ($user_id_list as $user_id)
			{
				$user_info = $this->user_info_m->find_with_user_id($user_id);
				$user_inven = $this->user_inven_m->get_list($user_id);
				$user_items = $this->user_items_m->get_user_items($user_id);
				$user_supporters = $this->user_supporters_m->get_list($user_id);
				
				foreach ($item_string_list as $item_string)
				{
					$result = $this->recall_item($user_id, $item_string, $user_info, $user_inven, $user_items, $user_supporters, $admin_name, $message);
					$result_string_all .= $result;
				}
			}
			
			#print $result_string_all;
			alert("회수가 완료 되었습니다." , '/game_management/item_recall/load_view');
		}
	}
	
	public function recall_item($user_id, $item_string, $user_info, $user_inven, $user_items, $user_supporters, $admin_name, $message)
	{
		$item_info = explode(":", $item_string);
		$ip_address = $_SERVER['REMOTE_ADDR'];
		
		$categ = $item_info[0];
		$type = $item_info[1];
		$count = $item_info[2];
		$type_name = '';
		$result_string = "";
		if ($categ == '0')
		{
			if ($type == '0')
			{
				$type_name = 'gas';
			}
			else if ($type == '1')
			{
				$type_name = 'coin';
			}
			else if ($type == '2')
			{
				$type_name = 'vgold';
			}
			else if ($type == '3')
			{
				$type_name = 'chip';
			}
			
			if ($count > $user_info[$type_name])
			{
				$return = $this->user_info_m->set($user_id, $type_name, 0);
				$result_string .= "회수 할 " . $type_name . " 부족.";
				$result_string .= "\n";
				if ($return)
				{
					$time = time();
					$date_string = "Y-m-d H:i:s";
					$reg_date = date($date_string, $time);
					$action = '아이템 회수(재화) - 부족';
					$item_id = $type;
					$item_count = $count;
					$memo = $message;
					$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				}
			}
			else
			{
				$return = $this->user_info_m->set($user_id, $type_name, $user_info[$type_name] - $count);
				if ($return)
				{
					$time = time();
					$date_string = "Y-m-d H:i:s";
					$reg_date = date($date_string, $time);
					$action = '아이템 회수(재화)';
					$item_id = $type;
					$item_count = $count;
					$memo = $message;
					$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				}
			}
		}
		else if ($categ == '2')
		{
			foreach ($user_inven as $car)
			{
				if ($car->model_id == $type)
				{
					$return = $this->user_inven_m->delete_car($user_id, $type);
					if ($return)
					{
						$time = time();
						$date_string = "Y-m-d H:i:s";
						$reg_date = date($date_string, $time);
						$action = '아이템 회수(차량)';
						$item_id = $type;
						$item_count = '1';
						$memo = $message;
						$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
					}
					break;
				}
			}
		}
		else if ($categ == '3')
		{
			foreach ($user_items as $item)
			{
				if ($item->item_code == $type)
				{
					if ($count > $item->count)
					{
						$return = $this->user_items_m->modify_parts($user_id, $type, 0);
						$result_string .= "회수 할 카드 부족.";
						$result_string .= "\n";
						if ($return)
						{
							$time = time();
							$date_string = "Y-m-d H:i:s";
							$reg_date = date($date_string, $time);
							$action = '아이템 회수(부품 카드) - 부족';
							$item_id = $type;
							$item_count = $count;
							$memo = $message;
							$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
						}
					}
					else
					{
						$return = $this->user_items_m->modify_parts($user_id, $type, $item->count - $count);
						if ($return)
						{
							$time = time();
							$date_string = "Y-m-d H:i:s";
							$reg_date = date($date_string, $time);
							$action = '아이템 회수(부품 카드)';
							$item_id = $type;
							$item_count = $count;
							$memo = $message;
							$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
						}
					}
					break;
				}
			}
		}
		else if ($categ == '4')
		{
			foreach ($user_supporters as $supporter)
			{
				if ($supporter->model_id == $type)
				{
					$return = $this->user_supporters_m->delete_sup($user_id, $type);
					if ($return)
					{
						$time = time();
						$date_string = "Y-m-d H:i:s";
						$reg_date = date($date_string, $time);
						$action = '아이템 회수(서포터)';
						$item_id = $type;
						$item_count = '1';
						$memo = $message;
						$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
					}
					break;
				}
			}
		}
		
		return $result_string;
	}
	
	public function get_item_info($item_string)
	{
		$item_info = explode(":", $item_string);
		// return $item_info;
		
		$categ = $item_info[0];
		$type = $item_info[1];
		$count = $item_info[2];
		$type_name = '';
		$name = '';
		
		if ($categ == '0')
		{
			if ($type == '0')
			{
				$type_name = 'gas';
				$name = '연료';
			}
			else if ($type == '1')
			{
				$type_name = 'coin';
				$name = '코인';
			}
			else if ($type == '2')
			{
				$type_name = 'vgold';
				$name = '무료 다이아';
			}
			else if ($type == '3')
			{
				$type_name = 'chip';
				$name = '트로피';
			}
		}
		else if ($categ == '2')
		{
			// 차량
		}
		else if ($categ == '3')
		{
			// 부품
		}
		else if ($categ == '4')
		{
			// 서포터
		}
		
		$result = array();
		$result['categ'] = $item_info[0];
		$result['code'] = $item_info[1];
		$result['count'] = $item_info[2];
		$result['type_name'] = $type_name;
		$result['name'] = '';
		
		return $result;
	}
}