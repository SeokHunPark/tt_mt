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
		$this->load->model('user_purchase_items_m');
		$this->load->model('log_cstool_m');
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
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		#print "$admin_name 으로 로그인.";
		
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
		$account_info['rank_point'] = "";
		$account_info['account_level'] = "";
		$account_info['secession'] = "";
		$account_info['secession_date'] = "";
		$account_info['reacently_login'] = "";
		$account_info['is_connected'] = "";
		$account_info['sanction_type'] = "";
		$account_info['sanction_date'] = "";
		$account_info['release_date'] = "";
		$account_info['invite_count'] = "";
		$account_info['sub_item'] = "";
		$account_info['sub_begin_date'] = "";
		$account_info['sub_end_date'] = "";
		$account_info['user_type'] = "";
		
		$user_id = "";
		
		$user_id = $this->uri->segment(4, -1);
		
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
			else if ($_POST['kakao_id_text'] != "")
			{
				$kakao_id = $this->input->post('kakao_id_text', TRUE);
				
				$sql = "select `drag_gamedb`.`usf_secure_data`('E', 'K', ?) as pid;";
				$query = $this->db->query($sql, ($kakao_id));
				$result = $query->result();
				$pid = $result[0]->pid;
				
				$user_id = $this->user_info_m->get_user_id_with_pid($pid);
				if ($user_id != "")
				{
					$account_info = $this->get_account_info($user_id);
				}
			}
		}
		else if ($user_id > 0)
		{
			$account_info = $this->get_account_info($user_id);
		}
		
		$data['account_info'] = $account_info;
		$this->load->view('/user_info/account_lookup_v', $data);
	}
	
	public function get_account_info($user_id)
	{
		$user_info = $this->user_info_m->find_with_user_id($user_id);
		// if (count($user_info) == 0)
		// {
			// return array();
		// }
		
		$user_action = $this->user_action_m->find_with_user_id($user_id);
		$user_challenges = $this->user_challenges_m->find_with_user_id($user_id);
		$user_purchase_items = $this->user_purchase_items_m->find_with_user_id($user_id);
		
		$sql = "select `drag_gamedb`.`usf_secure_data`('D', 'K', ?) as kakao_id;";
		$query = $this->db->query($sql, ($user_info['platform_user_id']));
		$result = $query->result();
		$kakao_id = $result[0]->kakao_id;
		
		$account_info['kakao_id'] = $kakao_id;
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
		$account_info['rank_point'] = $user_action['rank_point'];
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
			if ($sanctions_user['code'] == '1')
			{
				$account_info['sanction_type'] = "1일 제재";
			}
			else if ($sanctions_user['code'] == '3')
			{
				$account_info['sanction_type'] = "3일 제재";
			}
			else if ($sanctions_user['code'] == '5')
			{
				$account_info['sanction_type'] = "5일 제재";
			}
			else if ($sanctions_user['code'] == '7')
			{
				$account_info['sanction_type'] = "7일 제재";
			}
			else if ($sanctions_user['code'] == '15')
			{
				$account_info['sanction_type'] = "15일 제재";
			}
			else if ($sanctions_user['code'] == '30')
			{
				$account_info['sanction_type'] = "30일 제재";
			}
			else if ($sanctions_user['code'] == '1000')
			{
				$account_info['sanction_type'] = "영구 제재";
			}
			$account_info['sanction_type'] = $sanctions_user['code'];
			$account_info['sanction_date'] = $sanctions_user['s_date'];
			$account_info['release_date'] = $sanctions_user['e_date'];
		}
		$account_info['invite_count'] = $user_action['invite_count'];
		
		$account_info['sub_item'] = "";
		$account_info['sub_begin_date'] = "";
		$account_info['sub_end_date'] = "";
		foreach ($user_purchase_items as $package)
		{
			if ($package->type == 'D')
			{
				if ($package->item_id == '1001')
				{
					#$account_info['sub_item'] = $package->item_id;
					$account_info['sub_item'] = '7일간의 질주';
					$account_info['sub_begin_date'] = date('Y-m-d',strtotime($package->start_date));
					$account_info['sub_end_date'] =  date('Y-m-d',strtotime($package->start_date.'+'.'6'.' days'));
					break;
				}
			}
		}
		$account_info['user_type'] = $user_info['user_type'];
		
		return $account_info;
	}
	
	public function modify_nickname()
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
			$user_id = $this->input->post('user_id_text', TRUE);
			$new_nickname = $this->input->post('new_nickname_text', TRUE);
			
			if ($new_nickname == "")
			{
				alert("닉네임을 입력하십시오");
			}
			else
			{
				$return = $this->user_info_m->modify_nickname($user_id, $new_nickname);
				if ($return)
				{
					$time = time();
					$date_string = "Y-m-d H:i:s";
					$reg_date = date($date_string, $time);
					$ip_address = $_SERVER['REMOTE_ADDR'];
					$action = '닉네임 수정';
					$item_id = NULL;
					$item_count = NULL;
					$memo = '';
					$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
					
					alert('닉네임 변경이 완료 되었습니다.', '/user_info/account_lookup/load_account_info/'. $user_id);
				}
			}
			
			#$data['account_info'] = $this->get_account_info($user_id);
			#$this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function secession()
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
			$user_id = $this->input->post('secession_user_id_text', TRUE);
			
			$time = time();
			$date_string = "Y-m-d H:i:s";
			$unreg_date = date($date_string, $time);
			
			$return = $this->user_info_m->leave_game($user_id, $unreg_date);
			if ($return)
			{
				$reg_date = $unreg_date;
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '회원 탈퇴';
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				
				alert('회원 탈퇴가 완료 되었습니다.', '/user_info/account_lookup/load_account_info/'. $user_id);
			}
			
			// $data['account_info'] = $this->get_account_info($user_id);
			// $this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function secession_recovery()
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
			$user_id = $this->input->post('secession_recovery_user_id_text', TRUE);
			
			$return = $this->user_info_m->leave_recovery_game($user_id);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '탈퇴 복구';
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				
				alert('탈퇴 복구가 완료 되었습니다.', '/user_info/account_lookup/load_account_info/'. $user_id);
			}
			
			// $data['account_info'] = $this->get_account_info($user_id);
			// $this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function modify_money()
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
			$user_id = $this->input->post('modify_money_user_id_text', TRUE);
			
			$gas = (int)$this->input->post('gas_text', TRUE);
			$coin = (int)$this->input->post('coin_text', TRUE);
			$gold = (int)$this->input->post('gold_text', TRUE);
			$vgold = (int)$this->input->post('vgold_text', TRUE);
			$chip = (int)$this->input->post('chip_text', TRUE);
			
			$add_gas = (int)$this->input->post('new_gas_count_text', TRUE);
			$add_coin = (int)$this->input->post('new_coin_count_text', TRUE);
			$add_gold = (int)$this->input->post('new_gold_count_text', TRUE);
			$add_vgold = (int)$this->input->post('new_vgold_count_text', TRUE);
			$add_chip = (int)$this->input->post('new_chip_count_text', TRUE);
			
			if ($add_gas != 0)
				$gas += $add_gas;
			if ($add_coin != 0)
				$coin += $add_coin;
			if ($add_gold != 0)
				$gold += $add_gold;
			if ($add_vgold != 0)
				$vgold += $add_vgold;
			if ($add_chip != 0)
				$chip += $add_chip;
			
			$return = $this->user_info_m->modify_money($user_id, $gas, $coin, $gold, $vgold, $chip);
			if ($return)
			{	
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '재화 수정';
				$memo = '';
				
				if ($add_gas !=0)
				{
					$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, '연료', $add_gas, $memo);
				}
				if ($add_coin !=0)
				{
					$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, '코인', $add_coin, $memo);
				}
				if ($add_gold !=0)
				{
					$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, '유료 다이아', $add_gold, $memo);
				}
				if ($add_vgold !=0)
				{
					$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, '무료 다이아', $add_vgold, $memo);
				}
				if ($add_chip !=0)
				{
					$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, '트로피', $add_chip, $memo);
				}
				
				alert('재화 수정이 완료 되었습니다.', '/user_info/account_lookup/load_account_info/'. $user_id);
			}
			
			// $data['account_info'] = $this->get_account_info($user_id);
			// $this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function modify_straight_wins()
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
			$user_id = $this->input->post('straight_wins_user_id_text', TRUE);
			$winning_count = $this->input->post('winning_count_text', TRUE);
			
			if ($winning_count == "")
			{
				alert("숫자를 입력하세요.");
			}
			else
			{
				$return = $this->user_action_m->modify_straight_wins($user_id, $winning_count);
				if ($return)
				{
					$time = time();
					$date_string = "Y-m-d H:i:s";
					$reg_date = date($date_string, $time);
					$ip_address = $_SERVER['REMOTE_ADDR'];
					$action = '연승 수정';
					$item_id = NULL;
					$item_count = NULL;
					$memo = '';
					$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
					
					alert('연승 수정이 완료 되었습니다.', '/user_info/account_lookup/load_account_info/'. $user_id);
				}
			}
			
			// $data['account_info'] = $this->get_account_info($user_id);
			// $this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function modify_mission_status()
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
			
			$return = $this->user_challenges_m->modify_stage($user_id, $mission_stage);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '미션 진행도 변경';
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				
				alert('미션 진행도 변경이 완료 되었습니다.', '/user_info/account_lookup/load_account_info/'. $user_id);
			}
			
			// $data['account_info'] = $this->get_account_info($user_id);
			// $this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function modify_level()
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
				$return = $this->load->user_info_m->modify_exp($user_id, $exp);
				if ($return)
				{
					$time = time();
					$date_string = "Y-m-d H:i:s";
					$reg_date = date($date_string, $time);
					$ip_address = $_SERVER['REMOTE_ADDR'];
					$action = '경험치 수정';
					$item_id = NULL;
					$item_count = NULL;
					$memo = '';
					$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
					
					alert('경험치 수정이 완료 되었습니다.', '/user_info/account_lookup/load_account_info/'. $user_id);
				}
			}
			
			// $data['account_info'] = $this->get_account_info($user_id);
			// $this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function user_sanctions()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if ($_POST['sanction_user_id_text'])
		{
			#print_r($_POST);
			$user_id = $this->input->post('sanction_user_id_text', TRUE);
			$sanctions_days = $this->input->post('sanctions_days');
			$sanction_type = "";
			
			$time = time();
			$date_string = "Y-m-d H:i:s";
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
			else if ($sanctions_days == '1000')
			{
				$sanction_type = "1000";
				$e_date = '3015-12-31';
			}
			
			$subject = "test";
			$reason = "abusing";
			$memo = "";
			$reg_user = "1";
			$reg_date = $s_date;
			
			$return = $this->sanction_m->reg_user($user_id, $sanction_type, $s_date, $e_date, $subject, $reason, $memo, $reg_user, $reg_date);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '제재. ' . '제재 유형 ' . $sanction_type;
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				
				alert('사용자 제재가 완료 되었습니다.', '/user_info/account_lookup/load_account_info/'. $user_id);
			}
			
			// $data['account_info'] = $this->get_account_info($user_id);
			// $this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function off_sanctions()
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
			$user_id = $this->input->post('sanction_user_id_text', TRUE);
			$return = $this->sanction_m->delete_user($user_id);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '제재 해제';
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				
				alert('제재 해제가 완료 되었습니다.', '/user_info/account_lookup/load_account_info/'. $user_id);
			}
			// $data['account_info'] = $this->get_account_info($user_id);
			// $this->load->view('/user_info/account_lookup_v', $data);
		}
	}
	
	public function sub_cancel()
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
			$user_id = $this->input->post('sub_user_id_text', TRUE);
			$item_id = $this->input->post('sub_item_id_text', TRUE);
			
			$return = $this->user_purchase_items_m->delete_purchase_item($user_id, $item_id);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '청약 해제(계정 조회)';
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				
				alert('청약 취소가 완료 되었습니다.', '/user_info/account_lookup/load_account_info/'. $user_id);
			}
		}
	}
	
	public function modify_user_type()
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
			$user_id = $this->input->post('user_type_user_id_text', TRUE);
			$user_type = $this->input->post('user_type_text', TRUE);
			
			$return = $this->user_info_m->modify_user_type($user_id, $user_type);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '계정 유형 변경';
				$item_id = NULL;
				$item_count = NULL;
				$memo = $user_type;
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				
				alert('계정 유형 변경이 완료 되었습니다.', '/user_info/account_lookup/load_account_info/'. $user_id);
			}
		}
	}
	
	public function modify_rp()
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
			$user_id = $this->input->post('rp_user_id_text', TRUE);
			$rank_point = $this->input->post('rp_text', TRUE);
			
			$return = $this->user_action_m->modify_rank_point($user_id, $rank_point);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '랭크 포인트 변경';
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				
				alert('랭크 포인트 변경이 완료 되었습니다.', '/user_info/account_lookup/load_account_info/'. $user_id);
			}
		}
	}

	public function button_event()
	{
		$this->output->enable_profiler(TRUE);
		
		if (isset($_POST['mail_box_button']))
		{
			$user_id = $this->input->post('shortcut_user_id_text', TRUE);
			redirect('/user_info/mail_box/load_mail_box/user_search/' . $user_id);
		}
		else if(isset($_POST['cars_button']))
		{
			$user_id = $this->input->post('shortcut_user_id_text', TRUE);
			redirect('/user_info/cars/load_car_list/'. $user_id);
		}
		else if(isset($_POST['parts_button']))
		{
			$user_id = $this->input->post('shortcut_user_id_text', TRUE);
			redirect('/user_info/parts/load_parts_list/'. $user_id);
		}
	}
}