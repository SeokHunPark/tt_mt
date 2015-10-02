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
}