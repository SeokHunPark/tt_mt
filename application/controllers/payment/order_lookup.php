<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_lookup extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('logdb');
		$this->load->model('log_cash_m');
		$this->load->model('user_info_m');
		$this->load->model('mail_m');
		$this->load->model('log_gain_mail_m');
		$this->load->model('shop_package_m');
		$this->load->model('purchase_history_m');
		$this->load->model('user_purchase_items_m');
		$this->load->model('log_cstool_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		print "order lookup index()";
		$this->load_order();
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
		$this->load->view('/payment/order_lookup_popup_v');
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_order()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		$this->load->library('pagination');
		$size = 50;
		$mode = $this->uri->segment(4, 0);
		$max_rows = 1000;
		$order_list = array();

		// if (isset($_POST['date_search']))
		// {
			// $begin_day = $this->input->post('begin_day', TRUE);
			// $end_day = $this->input->post('end_day', TRUE);
			
			// $kakao_id = $this->input->post('kakao_id_text', TRUE);
			// $user_id = $this->input->post('game_account_id_text', TRUE);
			// $nickname = $this->input->post('nickname_text', TRUE);
			// $order_id = $this->input->post('order_id_text', TRUE);
			
			// $is_date = False;
			// if ($begin_day != "" && $end_day != "")
			// {
				// $is_date = True;
			// }
			
			// if ($user_id != '')
			// {
			// }
			// else if ($nickname != '')
			// {
				// $user_id = $this->user_info_m->get_user_id_with_nickname($nickname);
			// }
			// else
			// {
				// $user_id = '-1';
			// }
			
			// if ($order_id == '')
			// {
				// $order_id = '-1';
			// }
			
			// $begin_date = '-1';
			// $end_date = '-1';
			// if ($begin_day != "" && $end_day != "")
			// {
				// $begin_date = $begin_day . " 00:00:00";
				// $end_date = $end_day . " 23:59:59";
			// }
			
			// $offset = $this->uri->segment(7, 0);
			// $_order_list = $this->log_cash_m->search_order($user_id, $order_id, $begin_date, $end_date, $size, $offset);
			
			// print_r($_order_list);
		// }
		
		if (isset($_POST['date_search']))
		{
			$begin_day = $this->input->post('begin_day', TRUE);
			$end_day = $this->input->post('end_day', TRUE);
			
			if ($begin_day != "" && $end_day != "")
			{
				$begin_date = $begin_day . " 00:00:00";
				$end_date = $end_day . " 23:59:59";

				$offset = $this->uri->segment(7, 0);
				#$_order_list = $this->log_cash_m->get_list_with_date($begin_date, $end_date);
				$_order_list = $this->log_cash_m->get_list_with_date_2($begin_date, $end_date, $size, $offset);
				
				$config['base_url'] = '/payment/order_lookup/load_order/date_search/' . $begin_day . '/' . $end_day . '/';
				$config['total_rows'] = $max_rows;
				$config['per_page'] = $size;
				$config['uri_segment'] = 7;
				$this->pagination->initialize($config);

				$order_list = $this->make_view_data($_order_list);
			}
			else
			{
				alert("날짜를 입력하십시오.");
			}
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
			// else if ($_POST['kakao_id_text'] != "")
			// {
				// $kakao_id = $this->input->post('kakao_id_text', TRUE);
				
				// $sql = "select `drag_gamedb`.`usf_secure_data`('E', 'K', ?) as pid;";
				// $query = $this->db->query($sql, ($kakao_id));
				// $result = $query->result();
				// $pid = $result[0]->pid;
				
				// $user_id = $this->user_info_m->get_user_id_with_pid($pid);
			// }
			
			$offset = $this->uri->segment(6, 0);
			#$_order_list = $this->log_cash_m->get_list_with_user_id($user_id);
			$_order_list = $this->log_cash_m->get_list_with_user_id_2($user_id, $size, $offset);
			
			$config['base_url'] = '/payment/order_lookup/load_order/user_search/' . $user_id . '/';
			$config['total_rows'] = $max_rows;
			$config['per_page'] = $size;
			$config['uri_segment'] = 6;
			$this->pagination->initialize($config);
			
			$order_list = $this->make_view_data($_order_list);
		}
		else if (isset($_POST['order_id_search']))
		{
			$order_id = $this->input->post('order_id_text', TRUE);
			
			$offset = $this->uri->segment(6, 0);
			$_order_list = $this->log_cash_m->find_order($order_id);
			
			$config['base_url'] = '/payment/order_lookup/load_order/order_id_search/' . $order_id . '/';
			$config['total_rows'] = $max_rows;
			$config['per_page'] = $size;
			$config['uri_segment'] = 6;
			$this->pagination->initialize($config);
			
			$order_list = $this->make_view_data($_order_list);
		}
		else
		{
			if (strcmp($mode, "date_search") == 0)
			{
				$offset = $this->uri->segment(7, 0);
				$begin_date = $this->uri->segment(5, 0) . " 00:00:00";
				$end_date = $this->uri->segment(6, 0) . " 23:59:59";
				
				#$_order_list = $this->log_cash_m->get_list_with_date_2($begin_date, $end_date);
				$_order_list = $this->log_cash_m->get_list_with_date_2($begin_date, $end_date, $size, $offset);
				$config['base_url'] = '/payment/order_lookup/load_order/date_search/' . $this->uri->segment(5, 0) . '/' . $this->uri->segment(6, 0) . '/';
				$config['total_rows'] = $max_rows;
				$config['per_page'] = $size;
				$config['uri_segment'] = 7;
				$this->pagination->initialize($config);
				
				$order_list = $this->make_view_data($_order_list);
			}
			else if (strcmp($mode, "user_search") == 0)
			{
				$offset = $this->uri->segment(6, 0);
				$user_id = $this->uri->segment(5, 0);
				
				#$_order_list = $this->log_cash_m->get_list_with_user_id($user_id);
				$_order_list = $this->log_cash_m->get_list_with_user_id_2($user_id, $size, $offset);
				
				$config['base_url'] = '/payment/order_lookup/load_order/user_search/' . $user_id . '/';
				$config['total_rows'] = $max_rows;
				$config['per_page'] = $size;
				$config['uri_segment'] = 6;
				$this->pagination->initialize($config);
				
				$order_list = $this->make_view_data($_order_list);
			}
		}
		
		$data['order_list'] = $order_list;
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('/payment/order_lookup_v', $data);
	}
	
	public function make_view_data($_order_list)
	{
		$order_list = array();
		for ($i = 0; $i < count($_order_list); $i++)
		{
			$order = (array)$_order_list[$i];
			$order_list[$i] = $order;
		}
		return $order_list;
	}
	
	public function cancel_order()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		$order_id = "";
		if (isset($_POST))
		{
			$order_id = $this->input->post('order_id_text', TRUE);
			$user_id = $this->input->post('user_id_text', TRUE);
			$message = $this->input->post('memo_text', TRUE);
			$return = $this->log_cash_m->cancel_order($order_id, $message);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '결제 취소';
				$item_count = NULL;
				$memo = $message;
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $order_id, $item_count, $memo);
			}
		}
		
		$_order_list = $this->log_cash_m->find_order($order_id);
		$data['order_list'] = $this->make_view_data($_order_list);
		$data['pagination'] = "";
		$this->load->view('/payment/order_lookup_v', $data);
		#$this->load_order();
	}
	
	public function recovery()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if (isset($_POST['recovery']))
		{
			$item_id = $this->input->post('item_id_text', TRUE);
			$event_bonus = $this->input->post('event_bonus_text', TRUE);
			$user_id = $this->input->post('game_account_id_text', TRUE);
			$order_day = $this->input->post('order_day_text', TRUE);
			$order_time = $this->input->post('order_time_text', TRUE);
			$order_id = $this->input->post('order_id_text', TRUE);
			
			if ($item_id != "" && $user_id != "" && $order_day != "" && $order_time != "" && $order_id != "")
			{
				$item_info = $this->check_item_id($item_id, $event_bonus);
				if ($item_info['item_id'] == "")
				{
					alert("존재하지 않는 상품입니다.", '/payment/order_lookup');
					exit;
				}
				$user_info = $this->check_user_id($user_id);
				if (count($user_info) == 0)
				{
					alert("존재하지 않는 사용자입니다.", '/payment/order_lookup');
					exit;
				}
				$order_info = $this->check_order_id($order_id);
				if (count($order_info) > 0)
				{
					alert("이미 지급된 주문입니다.", '/payment/order_lookup');
					exit;
				}
				
				$send_ts = time();
				
				$partkey_month = substr($order_day, 5, 2);
				$categ = 'B';	// 구매
				$real_cash = $item_info['item_price'];
				$real_cash_kr = $item_info['item_price'];
				$receipt_key = $order_id;
				$inc_gold = $item_info['gold'];
				$market = '12'; // Android
				$country = 'kr';
				$currency_type = '2'; // 원
				$memo = "결제 오류 아이템 지급";
				$reg_date = date("Y-m-d H:i:s", $send_ts);
				$expire_date = date("Y-m-d H:i:s", $send_ts + (60 * 60 * 24 * 7));
				$pub_date = $order_day . ' ' . $order_time;
				$status = 'N';
				
				$log_cash_return = $this->log_cash_m->insert_order($partkey_month, $user_id, $categ, $item_id, $real_cash, $real_cash_kr, $receipt_key, $inc_gold, $market, $country,
														$currency_type, $memo, $reg_date, $pub_date, $status);
				
				$sku = $item_info['sku'];
				$purchase_history_return = $this->purchase_history_m->insert_history($partkey_month, $sku, $order_id, $reg_date, $user_id, $market);
				
				$purchase_items_return = true;
				if ((int)$item_info['item_id'] < 9000)
				{
					// 패키지 아이템
					$event_id = '0';
					$type = 'D';
					$max_count = '0';
					if ($item_info['param'] == 'period')
					{
						$type = 'D';
						$max_count = $item_info['arg'];
					}
					else if ($item_info['param'] == 'limit')
					{
						$type = 'H';
						$max_count = '0';
					}
					$item_string = $item_info['item_string'];
					$count = '1';
					$used = 'Y';
					
					$purchase_items = $this->user_purchase_items_m->find_items_by_uid_sku($user_id, $sku);
					if (count($purchase_items) == 1)
					{
						$purchase_items_return = $this->user_purchase_items_m->update_purchase_item($user_id, $sku, $item_id, $event_id, $type, $reg_date, $reg_date, $item_string, 																		$count, $max_count, $used);
					}
					else
					{
						$purchase_items_return = $this->user_purchase_items_m->insert_purchase_item($user_id, $sku, $item_id, $event_id, $type, $reg_date, $reg_date, $item_string, 																		$count, $max_count, $used);
					}
				}
				
				if ($log_cash_return && $purchase_history_return && $purchase_items_return)
				{
					$partkey_month = date("m", $send_ts);
					$title = "결제 오류 아이템 지급";
					$message = "결제 오류 아이템 지급";
					$item_string_all = $item_info['item_string_all'];
					
					$item_string_list = explode(',', $item_string_all);
					foreach ($item_string_list as $item)
					{
						$this->send_item($partkey_month, $user_id, $send_ts, $title, $message, $item, $reg_date, $expire_date);
					}					
					
					$ip_address = $_SERVER['REMOTE_ADDR'];
					$action = '결제 오류 복구';
					$item_count = NULL;
					$memo = '';
					$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $order_id, $item_count, $memo);
					
					alert("복구 완료 되었습니다.", '/payment/order_lookup');
					
				}
				else
				{
					alert("주문 기록에 실패하였습니다.", '/payment/order_lookup');
				}
			}
			else
			{
				alert("정보를 모두 입력하십시오.", '/payment/order_lookup');
			}
		}
	}
	
	public function check_item_id($item_id, $event_bonus)
	{
		$item_info = array();
		$item_info['item_id'] = '';
		
		if ((int)$item_id > 9000)
		{
			if ($item_id == "9001")
			{
				$item_info['item_id'] = '9001';
				$item_info['sku'] = 'com.ftt.dragracer_gl_4kakao_cash_01';
				$item_info['item_name'] = '다이아 30개';
				$item_info['item_price'] = '3300';
				$item_info['gold'] = '30';
				$item_info['item_string'] = '0:2:30';
				$item_info['item_string_all'] = '0:2:30';
			}
			else if ($item_id == "9002")
			{
				$item_info['item_id'] = '9002';
				$item_info['sku'] = 'com.ftt.dragracer_gl_4kakao_cash_02';
				$item_info['item_name'] = '다이아 50개';
				$item_info['item_price'] = '5500';
				$item_info['gold'] = '50';
				$item_info['item_string'] = '0:2:50';
				$item_info['item_string_all'] = '0:2:50';
			}
			else if ($item_id == "9003")
			{
				$item_info['item_id'] = '9003';
				$item_info['sku'] = 'com.ftt.dragracer_gl_4kakao_cash_03';
				$item_info['item_name'] = '다이아 110개';
				$item_info['item_price'] = '9900';
				$item_info['gold'] = '110';
				$item_info['item_string'] = '0:2:110';
				$item_info['item_string_all'] = '0:2:110';
			}
			else if ($item_id == "9004")
			{
				$item_info['item_id'] = '9004';
				$item_info['sku'] = 'com.ftt.dragracer_gl_4kakao_cash_04';
				$item_info['item_name'] = '다이아 345개';
				$item_info['item_price'] = '33000';
				$item_info['gold'] = '345';
				$item_info['item_string'] = '0:2:345';
				$item_info['item_string_all'] = '0:2:345';
			}
			else if ($item_id == "9005")
			{
				$item_info['item_id'] = '9005';
				$item_info['sku'] = 'com.ftt.dragracer_gl_4kakao_cash_05';
				$item_info['item_name'] = '다이아 600개';
				$item_info['item_price'] = '55000';
				$item_info['gold'] = '600';
				$item_info['item_string'] = '0:2:600';
				$item_info['item_string_all'] = '0:2:600';
			}
			
			if ($item_info['item_id'] != '')
			{
				if ($event_bonus != '')
				{
					$bonus_rate = (int)$event_bonus * 0.01;
					$gold = (int)$item_info['gold'];
					$add_gold = ceil($bonus_rate * $gold);
					$total_gold = $gold + $add_gold;
					$item_info['item_string'] = '0:2:' . $total_gold;
					$item_info['item_string_all'] = '0:2:' . $total_gold;
					$item_info['gold'] = $total_gold;
				}
			}
		}
		else
		{
			$result = $this->shop_package_m->find_with_package_no($item_id);
			
			if (count($result) > 0)
			{
				$package_info = $result[0];
				
				$item_info['item_id'] = $package_info->package_no;
				$item_info['sku'] = $package_info->sku;
				$item_info['param'] = $package_info->param;
				$item_info['arg'] = $package_info->arg;
				$item_info['item_name'] = $package_info->sku;
				$item_info['item_price'] = $package_info->price;
				$item_info['gold'] = $package_info->gold;
				$item_info['item_string'] = $package_info->item_string;
				$item_info['item_string_all'] = $package_info->item_string;
				if ($package_info->gas != '0')
				{
					if ($item_info['item_string_all'] != '') $item_info['item_string_all'] .= ',';
					$item_info['item_string_all'] .= '0:0:';
					$item_info['item_string_all'] .= $package_info->gas;
				}
				if ($package_info->gold != '0')
				{
					if ($item_info['item_string_all'] != '') $item_info['item_string_all'] .= ',';
					$item_info['item_string_all'] .= '0:2:';
					$item_info['item_string_all'] .= $package_info->gold;
				}
				if ($package_info->coin != '0')
				{
					if ($item_info['item_string_all'] != '') $item_info['item_string_all'] .= ',';
					$item_info['item_string_all'] .= '0:1:';
					$item_info['item_string_all'] .= $package_info->coin;
				}
			}
		}
		
		return $item_info;
	}
	
	public function check_user_id($user_id)
	{
		return $this->user_info_m->find_with_user_id($user_id);
	}
	
	public function check_order_id($order_id)
	{
		return $this->log_cash_m->find_order($order_id);
	}
	
	public function send_item($partkey_month, $user_id, $send_ts, $title, $message, $item_string, $reg_date, $expire_date)
	{
		$mail_type = 'G';
		$sender_id = 0;
		$is_received = 0;
		$categ = 'P';
		
		$this->log_gain_mail_m->insert_log($partkey_month, $user_id, $sender_id, $mail_type, $title, $item_string, $categ, $reg_date);
		return $this->mail_m->insert_mail($user_id, $sender_id, $mail_type, $send_ts, $title, $message, $is_received, $item_string, $categ, $reg_date, $expire_date);
	}
}