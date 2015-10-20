<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_viewer extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form', 'alert_helper'));
	}
	
	public function index()
	{
		print 'log_viewer index()';
		$this->load_log();
	}
	
	public function _remap($method)
	{
		// header include.
		$this->load->view('header_v');
		
		// nav include.
		$this->load->view('nav_v');
		
		// nav include.
		if (method_exists($this, $method))
		{
			$this->{"{$method}"}();
		}
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_log()
	{
		$this->output->enable_profiler(TRUE);
		
		#$data['log_connect_list'] = array();
		
		if (isset($_POST['log_connect_button']))
		{
			redirect('/log/log_connect');
		}
		else if (isset($_POST['log_consume_item_button']))
		{
			redirect('/log/log_consume_item');
		}
		else if (isset($_POST['log_consume_money_button']))
		{
			redirect('/log/log_consume_money');
		}
		else if (isset($_POST['log_gain_item_button']))
		{
			redirect('/log/log_gain_item');
		}
		else if (isset($_POST['log_gain_mail_button']))
		{
			redirect('/log/log_gain_mail');
		}
		else if (isset($_POST['log_gain_money_button']))
		{
			redirect('/log/log_gain_money');
		}
		else if (isset($_POST['log_game_play_button']))
		{
			redirect('/log/log_game_play');
		}
		else if (isset($_POST['log_game_room_button']))
		{
			redirect('/log/log_game_room');
		}
		else if (isset($_POST['log_leave_button']))
		{
			redirect('/log/log_leave');
		}
		else if (isset($_POST['log_levelup_button']))
		{
			redirect('/log/log_levelup');
		}
		else if (isset($_POST['log_mail_button']))
		{
			redirect('/log/log_mail');
		}
		else
		{
			$this->load->view('/log/log_viewer_v');
		}
	}
}