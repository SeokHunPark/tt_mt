<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_lookup extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('logdb');
		$this->load->library('calendar');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		#echo $this->calendar->generate();
	}
}