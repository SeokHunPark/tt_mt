<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Popup_market extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('globaldb');
		$this->load->model('shop_promotion_m');
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
}