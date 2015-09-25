<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_lookup extends CI_Controller
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
		$this->load_account_info();
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
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_account_info()
	{
		$this->output->enable_profiler(TRUE);
		
		print "load_account_info \n<br>";
		
		#print_r($_POST);
		
		$account_info['kakao_id'] = "";
		$account_info['nickname'] = "";
		$account_info['user_id'] = "";
		$account_info['reg_date'] = "";
		$account_info['gas'] = "";
		$account_info['coin'] = "";
		$account_info['gold'] = "";
		$account_info['trophy'] = "";
		$account_info['straight_wins'] = "";
		$account_info['mission_stats'] = "";
		$account_info['account_level'] = "";
		$account_info['secession'] = "";
		$account_info['secession_day'] = "";
		$account_info['reacently_login'] = "";
		$account_info['is_connected'] = "";
		$account_info['restriction_type'] = "";
		$account_info['account_block'] = "";
		$account_info['block_off'] = "";
		$account_info['sanction_date'] = "";
		$account_info['release_date'] = "";
		$account_info['invite_count'] = "";
		
		
		if (isset($_POST['game_account_id_text']))
		{
			print "user info post \n<br>";
			$user_id = $this->input->post('game_account_id_text', TRUE);
			
			$user_info = $this->user_info_m->find_user_with_user_id($user_id);
			$account_info['nickname'] = "";
			#print_r($data['user_info']);
			$data['account_info'] = $account_info;
			
			$this->load->view('user_info/account_lookup_v', $data);
		}
		else
		{
			print "user info \n<br>";
			$data['account_info'] = $account_info;
			$this->load->view('user_info/account_lookup_v', $data);
		}
	}
}