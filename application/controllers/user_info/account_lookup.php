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
		$this->load->model('sanction_m');
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
		$this->load->view('/user_info/account_lookup_popup_v');
		
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
		$account_info['sanction_type'] = "";
		$account_info['sanction_date'] = "";
		$account_info['release_date'] = "";
		$account_info['invite_count'] = "";
		
		$user_id = "";
		
		if (isset($_POST['game_account_id_text']) || isset($_POST['nickname_text']))
		{
			if ($_POST['game_account_id_text'] != "")
			{
				$user_id = $this->input->post('game_account_id_text', TRUE);
				$user_info = $this->user_info_m->find_with_user_id($user_id);
				if (count($user_info) > 0)
				{
					$account_info = $this->get_account_info($user_id);
				}
			}
			else if ($_POST['nickname_text'] != "")
			{
				$nickname = $this->input->post('nickname_text', TRUE);
				$user_id = $this->user_info_m->get_user_id_with_nickname($nickname);
				if ($user_id != "")
				{
					$account_info = $this->get_account_info($user_id);
				}
			}
		}
		
		print "user info \n<br>";
		$data['account_info'] = $account_info;
		$this->load->view('/user_info/account_lookup_v', $data);
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
		
		$exp = $user_info['exp'];
		$level = (int)sqrt((int)$exp / 4);
		$account_info['account_level'] = $exp;
		
		#N:정상, U:탈퇴, E:영구제재, P:기간제재\n',
		if ($user_info['status'] == "N")
		{
			$account_info['secession'] = "이용중";
			$account_info['secession_date'] = "-";
		}
		else if ($user_info['status'] == "U")
		{
			$account_info['secession'] = "탈퇴";
			$account_info['secession_date'] = $user_info['unreg_date'];
		}
		else if ($user_info['status'] == "E")
		{
			$account_info['secession'] = "영구제재";
		}
		else if ($user_info['status'] == "P")
		{
			$account_info['secession'] = "기간제재";
		}
		
		$account_info['reacently_login'] = $user_action['recent_date'];
		$account_info['is_connected'] = "";
		
		$sanctions_user = $this->sanction_m->find_with_user_id($user_id);
		#print_r($sanctions_user);
		if (count($sanctions_user) == 0)
		{
			$account_info['sanction_type'] = "";
			$account_info['sanction_date'] = "";
			$account_info['release_date'] = "";
		}
		else
		{
			$account_info['sanction_type'] = $sanctions_user['sanction_type'];
			$account_info['sanction_date'] = $sanctions_user['s_date'];
			$account_info['release_date'] = $sanctions_user['e_date'];
		}
		$account_info['invite_count'] = $user_action['invite_count'];
		
		return $account_info;
	}
	
	public function modify_nickname()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$user_id = $this->input->post('user_id_text', TRUE);
			$new_nickname = $this->input->post('new_nickname_text', TRUE);
			
			if ($new_nickname == "")
			{
				alert("닉네임을 입력하십시오");
			}
			else
			{
				$this->user_info_m->modify_nickname($user_id, $new_nickname);
			}
			
			$data['account_info'] = $this->get_account_info($user_id);
			$this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function secession()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$user_id = $this->input->post('secession_user_id_text', TRUE);
			
			$time = time();
			$date_string = "%Y-%m-%d %H:%i:%s";
			$unreg_date = mdate($date_string, $time);
			
			$this->user_info_m->leave_game($user_id, $unreg_date);
			
			$data['account_info'] = $this->get_account_info($user_id);
			$this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function secession_recovery()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$user_id = $this->input->post('secession_recovery_user_id_text', TRUE);
			
			$this->user_info_m->leave_recovery_game($user_id);
			
			$data['account_info'] = $this->get_account_info($user_id);
			$this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function modify_money()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$user_id = $this->input->post('modify_money_user_id_text', TRUE);
			$gas = $this->input->post('gas_text', TRUE);
			$coin = $this->input->post('coin_text', TRUE);
			$gold = $this->input->post('gold_text', TRUE);
			$vgold = $this->input->post('vgold_text', TRUE);
			$chip = $this->input->post('chip_text', TRUE);
			
			if ($this->input->post('new_gas_count_text', TRUE) != "")
				$gas = $this->input->post('new_gas_count_text', TRUE);
			if ($this->input->post('new_coin_count_text', TRUE) != "")
				$coin = $this->input->post('new_coin_count_text', TRUE);
			if ($this->input->post('new_gold_count_text', TRUE) != "")
				$gold = $this->input->post('new_gold_count_text', TRUE);
			if ($this->input->post('new_vgold_count_text', TRUE) != "")
				$vgold = $this->input->post('new_vgold_count_text', TRUE);
			if ($this->input->post('new_chip_count_text', TRUE) != "")
				$chip = $this->input->post('new_chip_count_text', TRUE);
			
			$this->user_info_m->modify_money($user_id, $gas, $coin, $gold, $vgold, $chip);
			
			$data['account_info'] = $this->get_account_info($user_id);
			$this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function modify_straight_wins()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$user_id = $this->input->post('straight_wins_user_id_text', TRUE);
			$winning_count = $this->input->post('winning_count_text', TRUE);
			
			if ($winning_count == "")
			{
				alert("숫자를 입력하세요.");
			}
			else
			{
				$this->user_action_m->modify_straight_wins($user_id, $winning_count);
			}
			
			$data['account_info'] = $this->get_account_info($user_id);
			$this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function modify_mission_status()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$user_id = $this->input->post('mission_status_user_id_text', TRUE);
			$mission = $this->input->post('mission_text', TRUE);
			$stage = $this->input->post('stage_text', TRUE);
			
			$mission_stage = "";
			for ($i = 0; $i < (int)$mission - 1; $i++)
			{
				$mission_stage .= "05";
			}
			$mission_stage .= $stage;
			#print "mission_stage : $mission_stage";
			
			$this->user_challenges_m->modify_stage($user_id, $mission_stage);
			
			$data['account_info'] = $this->get_account_info($user_id);
			$this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function modify_level()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			print_r($_POST);
			$user_id = $this->input->post('level_user_id_text', TRUE);
			$new_level = $this->input->post('level_text', TRUE);
			
			if ($new_level == "")
			{
				alert("레벨을 입력하세요.");
			}
			else
			{
				$exp = $new_level;
				#$exp = ((int)$new_level * (int)$new_level) * 4;
				$this->load->user_info_m->modify_exp($user_id, $exp);
			}
			
			$data['account_info'] = $this->get_account_info($user_id);
			$this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function user_sanctions()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			print_r($_POST);
			$user_id = $this->input->post('sanction_user_id_text', TRUE);
			$sanctions_days = $this->input->post('sanctions_days');
			$sanction_type = "";
			
			$time = time();
			$date_string = "Y-m-d h:i:s";
			$s_date = date($date_string, $time);
			$e_date = "";
			
			if ($sanctions_days == '1')
			{
				$sanction_type = "1";
				$e_date = date($date_string, $time + (60 * 60 * 24 * 1));
			}
			else if ($sanctions_days == '3')
			{
				$sanction_type = "3";
				$e_date = date($date_string, $time + (60 * 60 * 24 * 3));
			}
			else if ($sanctions_days == '5')
			{
				$sanction_type = "5";
				$e_date = date($date_string, $time + (60 * 60 * 24 * 5));
			}
			else if ($sanctions_days == '7')
			{
				$sanction_type = "7";
				$e_date = date($date_string, $time + (60 * 60 * 24 * 7));
			}
			else if ($sanctions_days == '15')
			{
				$sanction_type = "15";
				$e_date = date($date_string, $time + (60 * 60 * 24 * 15));
			}
			else if ($sanctions_days == '30')
			{
				$sanction_type = "30";
				$e_date = date($date_string, $time + (60 * 60 * 24 * 30));
			}
			else if ($sanctions_days == 'inf')
			{
				$sanction_type = "1000";
				$e_date = "INF";
			}
			
			$subject = "test";
			$reason = "abusing";
			$memo = "";
			$reg_user = "1";
			$reg_date = $s_date;
			
			$this->sanction_m->reg_user($user_id, $sanction_type, $s_date, $e_date, $subject, $reason, $memo, $reg_user, $reg_date);
			
			$data['account_info'] = $this->get_account_info($user_id);
			$this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function off_sanctions()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$user_id = $this->input->post('sanction_user_id_text', TRUE);
			$this->sanction_m->delete_user($user_id);
			$data['account_info'] = $this->get_account_info($user_id);
			$this->load->view('/user_info/account_lookup_v', $data);
		}
	}
}