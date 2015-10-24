<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'Predis/Autoloader.php';
Predis\Autoloader::register();

class Popup_market extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('globaldb');
		$this->load->model('shop_promotion_m');
		$this->load->model('log_cstool_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		$this->load_current_promotion();
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
		//$this->load->view('game_management/popup_market_popup_v');
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_current_promotion()
	{
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		$target_promo['promotion_no'] = "";
		$target_promo['title'] = "";
		$target_promo['package'] = "";
		$target_promo['expose_int'] = "";
		$target_promo['reexpose_buy'] = "";
		$target_promo['expose_limit'] = "";
		$target_promo['expose_prob'] = "";
		$data['target_promo'] = $target_promo;
		
		$promotion_list = $this->shop_promotion_m->get_promotion_list();
		#print_r($promotion_list);
		$data['promotion_list'] = $promotion_list;
		$this->load->view('game_management/popup_market_v', $data);
	}
	
	public function modify_promotion()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$target_promo['promotion_no'] = $this->input->post('promotion_no', TRUE);
			$target_promo['title'] = $this->input->post('title', TRUE);
			$target_promo['package'] = $this->input->post('package', TRUE);
			$target_promo['expose_int'] = $this->input->post('expose_int', TRUE);
			$target_promo['reexpose_buy'] = $this->input->post('reexpose_buy', TRUE);
			$target_promo['expose_limit'] = $this->input->post('expose_limit', TRUE);
			$target_promo['expose_prob'] = $this->input->post('expose_prob', TRUE);
			$data['target_promo'] = $target_promo;
			
			$promotion_list = $this->shop_promotion_m->get_promotion_list();
			$data['promotion_list'] = $promotion_list;
			$this->load->view('game_management/popup_market_v', $data);
		}
	}
	
	public function save_promotion()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if ($_POST)
		{
			$promotion_no = $this->input->post('promotion_no_new_text', TRUE);
			$title = $this->input->post('title_new_text', TRUE);
			$package = $this->input->post('package_new_text', TRUE);
			$expose_int = $this->input->post('expose_int_new_text', TRUE);
			$reexpose_buy = $this->input->post('reexpose_buy_new_text', TRUE);
			$expose_limit = $this->input->post('expose_limit_new_text', TRUE);
			$expose_prob = $this->input->post('expose_prob_new_text', TRUE);
			
			$return = $this->shop_promotion_m->save_promotion($promotion_no, $title, $package, $expose_int, $reexpose_buy, $expose_limit, $expose_prob);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$user_id = NULL;
				$action = '프로모션 수정';
				$item_id = $promotion_no;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				
				alert('프로모션 수정이 완료 되었습니다.', '/game_management/popup_market');
			}
			#$this->index();
		}
	}
	
	public function publish()
	{
		$this->output->enable_profiler(TRUE);
		
		$channel = "pubsub_contents";
		$message = "package";
		
		$redis_host =  $this->config->item('redis_host');
		
		#print "redis_host : $redis_host";
		
		$redis = new Predis\Client('tcp://' . $redis_host);
		$redis->publish($channel, $message);
		
		$this->load_current_promotion();
	}
}