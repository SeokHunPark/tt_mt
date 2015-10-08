<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parts extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('gamedb');
		$this->load->model('user_info_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		print "Parts index()";
		#$this->load_car_list();
	}
	
	public function _remap($method)
	{
		// header include.
		$this->load->view('header_v');
		
		// nav include.
		$this->load->view('nav_v');
		
		// if (method_exists($this, $method))
		// {
			// $this->{"{$method}"}();
		// }
		
		// popup include.
		#$this->load->view('/user_info/account_lookup_popup_v');
		
		// footer include.
		$this->load->view('footer_v');
	}
}