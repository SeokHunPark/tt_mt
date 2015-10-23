<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'Predis/Autoloader.php';
Predis\Autoloader::register();

class Hottime_event extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('gamedb');
		$this->load->model('event_hottime_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		print "hottime_event index()";
		$this->load_event();
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
		
		// package include.
		//$this->load->view('game_management/popup_market_popup_v');
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_event()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		$target_event = array();
		$target_event['event_no'] = "";
		$target_event['event_name'] = "";
		$target_event['event_type'] = "";
		$target_event['event_term'] = "";
		$target_event['begin_day'] = "";
		$target_event['begin_time'] = "";
		$target_event['end_day'] = "";
		$target_event['end_time'] = "";
		$target_event['gas'] = "";
		$target_event['chip'] = "";
		$target_event['gold'] = "";
		$target_event['coin'] = "";
		$data['target_event'] = $target_event;
		
		$_event_list = array();
		$_event_list = $this->event_hottime_m->get_event_list();
		$event_list = $this->make_view_data($_event_list);
		$data['event_list'] = $this->make_view_data($_event_list);
		$this->load->view('game_management/hottime_event_v', $data);
	}
	
	public function make_view_data($_event_list)
	{
		$event_list = array();
		
		for ($i = 0; $i < count($_event_list); $i++)
		{
			$event_list[$i]['event_no'] = $_event_list[$i]->event_no;
			$event_list[$i]['event_name'] = $_event_list[$i]->title;
			$event_list[$i]['event_type'] = $_event_list[$i]->type;
			$event_list[$i]['event_term'] = $_event_list[$i]->begin_date . ' ~ ' . $_event_list[$i]->end_date;
			$event_list[$i]['gas'] = "0";
			$event_list[$i]['chip'] = "0";
			$event_list[$i]['gold'] = "0";
			$event_list[$i]['coin'] = "0";
			$item_string_list = explode(',', $_event_list[$i]->item_string);
			foreach ($item_string_list as $item_string)
			{
				$item_info = explode(':', $item_string);
				if ($item_info[1] == '0')
				{
					$event_list[$i]['gas'] = $item_info[2];
				}
				else if($item_info[1] == '1')
				{
					$event_list[$i]['coin'] = $item_info[2];
				}
				else if($item_info[1] == '2')
				{
					$event_list[$i]['gold'] = $item_info[2];
				}
				else if($item_info[1] == '3')
				{
					$event_list[$i]['chip'] = $item_info[2];
				}
			}
			$event_list[$i]['is_used'] = $_event_list[$i]->used;
		}
		
		return $event_list;
	}
	
	public function button_event()
	{
		$this->output->enable_profiler(TRUE);
		
		$target_event = array();
		$target_event['event_no'] = "";
		$target_event['event_name'] = "";
		$target_event['event_type'] = "";
		$target_event['event_term'] = "";
		$target_event['begin_day'] = "";
		$target_event['begin_time'] = "";
		$target_event['end_day'] = "";
		$target_event['end_time'] = "";
		$target_event['gas'] = "";
		$target_event['chip'] = "";
		$target_event['gold'] = "";
		$target_event['coin'] = "";
		$data['target_event'] = $target_event;
		
		if (isset($_POST['modify']))
		{
			$target_event['event_no'] = $this->input->post('event_no', TRUE);
			$target_event['event_name'] = $this->input->post('event_name', TRUE);
			$target_event['event_type'] = $this->input->post('event_type', TRUE);
			
			$date_array = explode(' ~ ', $this->input->post('event_term', TRUE));
			$begin_date = explode(' ', $date_array[0]);
			$target_event['begin_day'] = $begin_date[0];
			$target_event['begin_time'] = $begin_date[1];
			$end_date = explode(' ', $date_array[1]);
			$target_event['end_day'] = $end_date[0];
			$target_event['end_time'] = $end_date[1];
			
			$target_event['event_term'] = $this->input->post('event_term', TRUE);
			$target_event['gas'] = $this->input->post('gas', TRUE);
			$target_event['chip'] = $this->input->post('chip', TRUE);
			$target_event['gold'] = $this->input->post('gold', TRUE);
			$target_event['coin'] = $this->input->post('coin', TRUE);
			$data['target_event'] = $target_event;
		}
		else if (isset($_POST['state']))
		{
			$event_no = $this->input->post('event_no', TRUE);
			$is_used = $this->input->post('is_used', TRUE);
			if ($is_used == 'N')
			{
				$is_used = 'Y';
			}
			else
			{
				$is_used = 'N';
			}
			$this->event_hottime_m->change_state($event_no, $is_used);
		}
		else if (isset($_POST['participant']))
		{
		}
		
		$_event_list = array();
		$_event_list = $this->event_hottime_m->get_event_list();
		$event_list = $this->make_view_data($_event_list);
		$data['event_list'] = $this->make_view_data($_event_list);
		$this->load->view('game_management/hottime_event_v', $data);
	}
	
	public function modify_event()
	{
		$this->output->enable_profiler(TRUE);
		
		$target_event = array();
		$target_event['event_no'] = "";
		$target_event['event_name'] = "";
		$target_event['event_type'] = "";
		$target_event['event_term'] = "";
		$target_event['begin_day'] = "";
		$target_event['begin_time'] = "";
		$target_event['end_day'] = "";
		$target_event['end_time'] = "";
		$target_event['gas'] = "";
		$target_event['chip'] = "";
		$target_event['gold'] = "";
		$target_event['coin'] = "";
		$data['target_event'] = $target_event;
		
		if (isset($_POST['modify']))
		{
			$event_no = $this->input->post('event_no_text', TRUE);
			$event_name = $this->input->post('event_name_text', TRUE);
			$event_type = $this->input->post('event_type_text', TRUE);
			
			#$date_array = explode(' ~ ', $this->input->post('event_term', TRUE));
			$begin_date = $this->input->post('begin_day_text', TRUE) . ' ' . $this->input->post('begin_time_text', TRUE);
			$end_date = $this->input->post('end_day_text', TRUE) . ' ' . $this->input->post('end_time_text', TRUE);
			
			$gas = $this->input->post('gas_text', TRUE);
			$chip = $this->input->post('chip_text', TRUE);
			$gold = $this->input->post('gold_text', TRUE);
			$coin = $this->input->post('coin_text', TRUE);
			$item_string = "";
			if ((int)$gas > 0)
			{
				$gas_string = '0:0:' . $gas;
				if ($item_string != "") $item_string .= ',';
				$item_string .= $gas_string;
			}
			if ((int)$chip)
			{
				$chip_string = '0:3:' . $chip;
				if ($item_string != "") $item_string .= ',';
				$item_string .= $chip_string;
			}
			if ((int)$gold)
			{
				$gold_string = '0:2:' . $gold;
				if ($item_string != "") $item_string .= ',';
				$item_string .= $gold_string;
			}
			if ((int)$coin)
			{
				$coin_string = '0:1:' . $coin;
				if ($item_string != "") $item_string .= ',';
				$item_string .= $coin_string;
			}
			
			$return = $this->event_hottime_m->modify_event($event_no, $event_name, $event_type, $begin_date, $end_date, $item_string);
			
			if ($return)
			{
				alert('수정되었습니다.', '/game_management/hottime_event');
			}
			else
			{
				alert('수정에 실패 하였습니다.', '/game_management/hottime_event');
			}
		}
		
		// $_event_list = array();
		// $_event_list = $this->event_hottime_m->get_event_list();
		// $event_list = $this->make_view_data($_event_list);
		// $data['event_list'] = $this->make_view_data($_event_list);
		// $this->load->view('game_management/hottime_event_v', $data);
		
		#$this->load_event();
	}
	
	public function add_event()
	{
		$this->output->enable_profiler(TRUE);
		
		$target_event = array();
		$target_event['event_no'] = "";
		$target_event['event_name'] = "";
		$target_event['event_type'] = "";
		$target_event['event_term'] = "";
		$target_event['begin_day'] = "";
		$target_event['begin_time'] = "";
		$target_event['end_day'] = "";
		$target_event['end_time'] = "";
		$target_event['gas'] = "";
		$target_event['chip'] = "";
		$target_event['gold'] = "";
		$target_event['coin'] = "";
		$data['target_event'] = $target_event;
		
		if (isset($_POST['add_event']))
		{
			
			$event_name = $this->input->post('event_name_text', TRUE);
			$event_type = $this->input->post('event_type_text', TRUE);
			
			#$date_array = explode(' ~ ', $this->input->post('event_term', TRUE));
			$begin_date = $this->input->post('begin_day_text', TRUE) . ' ' . $this->input->post('begin_time_text', TRUE);
			$end_date = $this->input->post('end_day_text', TRUE) . ' ' . $this->input->post('end_time_text', TRUE);
			
			$gas = $this->input->post('gas_text', TRUE);
			$chip = $this->input->post('chip_text', TRUE);
			$gold = $this->input->post('gold_text', TRUE);
			$coin = $this->input->post('coin_text', TRUE);
			$item_string = "";
			if ((int)$gas > 0)
			{
				$gas_string = '0:0:' . $gas;
				if ($item_string != "") $item_string .= ',';
				$item_string .= $gas_string;
			}
			if ((int)$chip)
			{
				$chip_string = '0:3:' . $chip;
				if ($item_string != "") $item_string .= ',';
				$item_string .= $chip_string;
			}
			if ((int)$gold)
			{
				$gold_string = '0:2:' . $gold;
				if ($item_string != "") $item_string .= ',';
				$item_string .= $gold_string;
			}
			if ((int)$coin)
			{
				$coin_string = '0:1:' . $coin;
				if ($item_string != "") $item_string .= ',';
				$item_string .= $coin_string;
			}
			
			$return = $this->event_hottime_m->add_event($event_name, $event_type, $begin_date, $end_date, $item_string);
			
			if ($return)
			{
				alert('등록 되었습니다.', '/game_management/hottime_event');
			}
			else
			{
				alert('등록에 실패 하였습니다.', '/game_management/hottime_event');
			}
		}
		
		// $_event_list = array();
		// $_event_list = $this->event_hottime_m->get_event_list();
		// $event_list = $this->make_view_data($_event_list);
		// $data['event_list'] = $this->make_view_data($_event_list);
		// $this->load->view('game_management/hottime_event_v', $data);
		#$this->load_event();
	}
	
	public function publish()
	{
		$this->output->enable_profiler(TRUE);
		
		$channel = "pubsub_contents";
		$message = "hottime";
		
		$redis_host =  $this->config->item('redis_host');
		#$redis_host =  $this->config->item('58.121.156.234');
		
		$redis = new Predis\Client('tcp://' . $redis_host);
		$redis->publish($channel, $message);
		
		$this->load_event();
	}
}