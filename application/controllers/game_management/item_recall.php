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
		
		if (isset($_POST['recall_button']))
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
			#print_r($user_id_list);
			
			$item_list = explode("\n", $item_list_text);
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
				$user_items = $this->user_items_m->get_user_items($user_id);
				
				foreach ($item_string_list as $item_string)
				{
					$result = $this->recall_item($user_id, $item_string, $user_info, $user_items);
					$result_string_all .= $result;
				}
			}
			
			#print $result_string_all;
			alert("회수가 완료 되었습니다." , '/game_management/item_recall/load_view');
		}
	}
	
	public function recall_item($user_id, $item_string, $user_info, $user_items)
	{
		$item_info = explode(":", $item_string);
		
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
				#$this->user_info_m->modify_gas($user_id, 0);
				$this->user_info_m->set($user_id, $type_name, 0);
				$result_string .= "회수 할 " . $type_name . " 부족.";
				$result_string .= "\n";
			}
			else
			{
				$this->user_info_m->set($user_id, $type_name, $user_info[$type_name] - $count);
			}
		}
		else if ($categ == '2')
		{
			$this->user_inven_m->delete_car($user_id, $type);
		}
		else if ($categ == '3')
		{
			foreach ($user_items as $item)
			{
				if ($item->item_code == $type)
				{
					if ($count > $item->count)
					{
						$this->user_items_m->modify_parts($user_id, $type, 0);
						$result_string .= "회수 할 카드 부족.";
						$result_string .= "\n";
					}
					else
					{
						$this->user_items_m->modify_parts($user_id, $type, $item->count - $count);
					}
					break;
				}
			}
		}
		else if ($categ == '4')
		{
			$this->user_supporters_m->delete_sup($user_id, $type);
		}
		
		return $result_string;
	}
}