<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_lookup extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('logdb');
		$this->load->model('log_cash_m');
		$this->load->model('user_info_m');
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
		
		$this->load->library('pagination');
		$size = 10;
		
		$order_list = array();
		
		$mode = $this->uri->segment(4, 0);

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

				$_order_list = $this->log_cash_m->get_list_with_date($begin_date, $end_date);
				
				$begin_date = $begin_year . "-" . $begin_month . "-" . $begin_day;
				$end_date = $end_year . "-" . $end_month . "-" . $end_day;
				
				$config['base_url'] = '/payment/order_lookup/load_order/date_search/' . $begin_date . '/' . $end_date . '/';
				$config['total_rows'] = count($_order_list);
				$config['per_page'] = $size;
				$config['uri_segment'] = 7;
				$this->pagination->initialize($config);
				
				$offset = $this->uri->segment(7, 0);
				$order_list = $this->make_view_data(array_splice($_order_list, (int)$offset, (int)$size));
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
			
			$_order_list = $this->log_cash_m->get_list_with_user_id($user_id);
			
			$config['base_url'] = '/payment/order_lookup/load_order/user_search/' . $user_id . '/';
			$config['total_rows'] = count($_order_list);
			$config['per_page'] = $size;
			$config['uri_segment'] = 6;
			$this->pagination->initialize($config);
			
			$offset = $this->uri->segment(6, 0);
			$order_list = $this->make_view_data(array_splice($_order_list, (int)$offset, (int)$size));
		}
		else
		{
			if (strcmp($mode, "date_search") == 0)
			{
				$offset = $this->uri->segment(7, 0);
				$begin_date = $this->uri->segment(5, 0) . " 00:00:00";
				$end_date = $this->uri->segment(6, 0) . " 23:59:59";
				
				$_order_list = $this->log_cash_m->get_list_with_date($begin_date, $end_date);
				$config['base_url'] = '/payment/order_lookup/load_order/date_search/' . $this->uri->segment(5, 0) . '/' . $this->uri->segment(6, 0) . '/';
				$config['total_rows'] = count($_order_list);
				$config['per_page'] = $size;
				$config['uri_segment'] = 7;
				$this->pagination->initialize($config);
				
				$order_list = $this->make_view_data(array_splice($_order_list, (int)$offset, (int)$size));
			}
			else if (strcmp($mode, "user_search") == 0)
			{
				$offset = $this->uri->segment(6, 0);
				$user_id = $this->uri->segment(5, 0);
				
				$_order_list = $this->log_cash_m->get_list_with_user_id($user_id);
				
				$config['base_url'] = '/payment/order_lookup/load_order/user_search/' . $user_id . '/';
				$config['total_rows'] = count($_order_list);
				$config['per_page'] = $size;
				$config['uri_segment'] = 6;
				$this->pagination->initialize($config);
				
				$offset = $this->uri->segment(6, 0);
				$order_list = $this->make_view_data(array_splice($_order_list, (int)$offset, (int)$size));
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
		
		$order_id = "";
		if (isset($_POST))
		{
			$order_id = $this->input->post('order_id_text', TRUE);
			$memo = $this->input->post('memo_text', TRUE);
			$this->log_cash_m->cancel_order($order_id, $memo);
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
		
		if (isset($_POST['recovery']))
		{
			
		}
	}
}