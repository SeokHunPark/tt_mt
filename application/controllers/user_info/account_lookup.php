<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_lookup extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('gamedb');
		$this->load->model('user_info_m');
		$this->load->model('user_action_m');
		$this->load->model('user_challenges_m');
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
		
		// popup include.
		$this->load->view('user_info/account_lookup_popup_v');
		
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
		$account_info['vgold'] = "";
		$account_info['chip'] = "";
		$account_info['straight_wins'] = "";
		$account_info['current_challenge'] = "";
		$account_info['current_stage'] = "";
		$account_info['account_level'] = "";
		$account_info['secession'] = "";
		$account_info['secession_date'] = "";
		$account_info['reacently_login'] = "";
		$account_info['is_connected'] = "";
		$account_info['restriction_type'] = "";
		$account_info['account_block'] = "";
		$account_info['block_off'] = "";
		$account_info['sanction_date'] = "";
		$account_info['release_date'] = "";
		$account_info['invite_count'] = "";
		
		$user_id = "";
		
		if (isset($_POST['game_account_id_text']))
		{
			print "user info post \n<br>";
			$user_id = $this->input->post('game_account_id_text', TRUE);
		}
		
		#if (isset($_POST['game_account_id_text']))
		if ($user_id != "")
		{
			$data['account_info'] = $this->get_account_info($user_id);
			$this->load->view('user_info/account_lookup_v', $data);
		}
		else
		{
			print "user info \n<br>";
			$data['account_info'] = $account_info;
			$this->load->view('user_info/account_lookup_v', $data);
		}
	}
	
	public function get_account_info($user_id)
	{
		$user_info = $this->user_info_m->find_with_user_id($user_id);
		$user_action = $this->user_action_m->find_with_user_id($user_id);
		$user_challenges = $this->user_challenges_m->find_with_user_id($user_id);
		
		$account_info['kakao_id'] = $user_info['platform_user_id'];
		$account_info['nickname'] = $user_info['nickname'];
		$account_info['user_id'] = $user_info['user_id'];
		$account_info['reg_date'] = $user_info['create_date'];
		$account_info['gas'] = $user_info['gas'];
		$account_info['coin'] = $user_info['coin'];
		$account_info['gold'] = $user_info['gold'];
		$account_info['vgold'] = $user_info['vgold'];
		$account_info['chip'] = $user_info['chip'];
		$account_info['straight_wins'] = $user_action['winning_streak'];
		
		$stage = $user_challenges['stage'];
		$current_mission = strlen($stage) / 2;
		$current_stage = substr($stage, -2, 2);
		$account_info['current_challenge'] = $current_mission;
		$account_info['current_stage'] = $current_stage;
		
		$account_info['account_level'] = "";
		if ($user_info['unreg_date'] == "")
		{
			$account_info['secession'] = "이용중";
			$account_info['secession_date'] = "-";
		}
		else
		{
			$account_info['secession'] = "탈퇴";
			$account_info['secession_date'] = $user_info['unreg_date'];
		}
		
		$account_info['reacently_login'] = $user_action['recent_date'];
		$account_info['is_connected'] = "";
		$account_info['restriction_type'] = "";
		$account_info['account_block'] = "";
		$account_info['block_off'] = "";
		$account_info['sanction_date'] = "";
		$account_info['release_date'] = "";
		$account_info['invite_count'] = $user_action['invite_count'];
		
		return $account_info;
	}
	
	public function modify_nickname()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			print "POST Action!!!!";
			$user_id = $this->input->post('user_id_text', TRUE);
			$new_nickname = $this->input->post('new_nickname_text', TRUE);
			$this->user_info_m->modify_nickname($user_id, $new_nickname);
			
			$data['account_info'] = $this->get_account_info($user_id);
			$this->load->view('user_info/account_lookup_v', $data);
		}
	}
}