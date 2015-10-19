<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'Predis/Autoloader.php';
Predis\Autoloader::register();

class Ingame_event extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('globaldb');
		$this->load->model('event_ingame_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		print "ingame_event index()";
		$this->load_event();
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
		
		// package include.
		//$this->load->view('game_management/popup_market_popup_v');
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_event()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		$_event_list = $this->event_ingame_m->get_event_list();
		$data['event_list'] = $this->make_view_data($_event_list);
		$this->load->view('/game_management/ingame_event_v', $data);
	}
	
	public function make_view_data($_event_list)
	{
		$event_list = array();
		
		for ($i = 0; $i < count($_event_list); $i++)
		{
			$event = (array)$_event_list[$i];
			
			$event_list[$i]['event_no'] = $event['event_no'];
			$event_list[$i]['title'] = $event['title'];
			$event_list[$i]['begin_date'] = $event['begin_date'];
			$event_list[$i]['end_date'] = $event['end_date'];
			$event_list[$i]['open_date'] = $event['open_date'];
			$event_list[$i]['image_url'] = $event['image_url'];
			$event_list[$i]['link_url'] = $event['link_url'];
			$event_list[$i]['used'] = $event['used'];
			$event_list[$i]['body'] = $event['body'];
			
			$event_list[$i]['description'] = "";
			$bonus_gold = $event['bonus.gold'];
			$bonus_coin = $event['bonus.coin'];
			$bonus_gas = $event['bonus.gas'];
			$sale_car = $event['sale.car'];
			$sale_supporter = $event['sale.supporter'];
			$sale_gacha_0 = $event['sale.gacha.0'];
			$sale_gacha_1 = $event['sale.gacha.1'];
			$game_mode = $event['game_mode'];
			$game_players = $event['game_players'];
			$game_challenge = $event['game_challenge'];
			$gain_coin = $event['gain.coin'];
			$gain_exp = $event['gain.exp'];
			$gain_chip = $event['gain.chip'];
			$gain_gold = $event['gain.gold'];
			$gain_gold_prob = $event['gain.gold.prob'];
			
			if ((float)$bonus_gold > 0)
			{
				$event_list[$i]['description'] .= "\n<br>";
				$event_list[$i]['description'] .= "보너스 다이아 : ";
				$event_list[$i]['description'] .= $bonus_gold;
			}
			if ((float)$bonus_coin > 0)
			{
				$event_list[$i]['description'] .= "\n<br>";
				$event_list[$i]['description'] .= "보너스 코인 : ";
				$event_list[$i]['description'] .= $bonus_coin;
			}
			if ((float)$bonus_gas > 0)
			{
				$event_list[$i]['description'] .= "\n<br>";
				$event_list[$i]['description'] .= "보너스 연료 : ";
				$event_list[$i]['description'] .= $bonus_gas;
			}
			if ((float)$sale_car > 0)
			{
				$event_list[$i]['description'] .= "\n<br>";
				$event_list[$i]['description'] .= "차량 할인 : ";
				$event_list[$i]['description'] .= $sale_car;
			}
			if ((float)$sale_supporter > 0)
			{
				$event_list[$i]['description'] .= "\n<br>";
				$event_list[$i]['description'] .= "서포터 할인 : ";
				$event_list[$i]['description'] .= $sale_supporter;
			}
			if ((float)$sale_gacha_0 > 0)
			{
				$event_list[$i]['description'] .= "\n<br>";
				$event_list[$i]['description'] .= "A급 뽑기 확률 증가 : ";
				$event_list[$i]['description'] .= $sale_gacha_0;
			}
			if ((float)$sale_gacha_1 > 0)
			{
				$event_list[$i]['description'] .= "\n<br>";
				$event_list[$i]['description'] .= "S급 뽑기 확률 증가 : ";
				$event_list[$i]['description'] .= $sale_gacha_1;
			}
			$event_list[$i]['description'] .= "\n<br>";
			$event_list[$i]['description'] .= "게임 모드 : ";
			$event_list[$i]['description'] .= $game_mode;
			
			$event_list[$i]['description'] .= "\n<br>";
			$event_list[$i]['description'] .= "게임 플레이어 : ";
			$event_list[$i]['description'] .= $game_players;

			$event_list[$i]['description'] .= "\n<br>";
			$event_list[$i]['description'] .= "게임 챌린지 : ";
			$event_list[$i]['description'] .= $game_challenge;
			if ((float)$gain_coin > 0)
			{
				$event_list[$i]['description'] .= "\n<br>";
				$event_list[$i]['description'] .= "코인 획득량 증가 : ";
				$event_list[$i]['description'] .= $gain_coin;
			}
			if ((float)$gain_exp > 0)
			{
				$event_list[$i]['description'] .= "\n<br>";
				$event_list[$i]['description'] .= "연료 획득량 증가 : ";
				$event_list[$i]['description'] .= $gain_exp;
			}
			if ((float)$gain_gold > 0)
			{
				$event_list[$i]['description'] .= "\n<br>";
				$event_list[$i]['description'] .= "다이아 획득량 증가 : ";
				$event_list[$i]['description'] .= $gain_gold;
			}
			if ((float)$gain_gold_prob > 0)
			{
				$event_list[$i]['description'] .= "\n<br>";
				$event_list[$i]['description'] .= "다이아 획득량 증가2 : ";
				$event_list[$i]['description'] .= $gain_gold_prob;
			}
			$event_list[$i]['description'] .= "\n<br>\n<br>";
		}
		
		#print_r($event_list);
		
		return $event_list;
	}
	
	public function reg_event()
	{
		$this->output->enable_profiler(TRUE);
		
		if (isset($_POST['reg']))
		{
			$title = $this->input->post('event_name_text', TRUE);
			
			$begin_date = $this->input->post('begin_day_text', TRUE) . ' ' . $this->input->post('begin_time_text', TRUE);
			$end_date = $this->input->post('end_day_text', TRUE) . ' '. $this->input->post('end_time_text', TRUE);
			$open_date = $this->input->post('open_day_text', TRUE) . ' ' . $this->input->post('open_time_text', TRUE);
			
			$image_url = $this->input->post('image_url_text', TRUE);
			$link_url = $this->input->post('link_url_text', TRUE);
			
			$bonus_gold = $this->input->post('bonus_gold_text', TRUE);
			$bonus_coin = $this->input->post('bonus_coin_text', TRUE);
			$bonus_gas = $this->input->post('bonus_gas_text', TRUE);
			if ($bonus_gold == '') $bonus_gold = '0';
			if ($bonus_coin == '') $bonus_coin = '0';
			if ($bonus_gas == '') $bonus_gas = '0';
			
			$sale_gacha_1 = $this->input->post('sale_gacha_1_text', TRUE);
			$sale_gacha_0 = $this->input->post('sale_gacha_0_text', TRUE);
			$sale_car = $this->input->post('sale_car_text', TRUE);
			$sale_supporter = $this->input->post('sale_supporter_text', TRUE);
			if ($sale_gacha_1 == '') $sale_gacha_1 = '0';
			if ($sale_gacha_0 == '') $sale_gacha_0 = '0';
			if ($sale_car == '') $sale_car = '0';
			if ($sale_supporter == '') $sale_supporter = '0';
			
			$gain_coin = $this->input->post('gain_coin_text', TRUE);
			$gain_exp = $this->input->post('gain_exp_text', TRUE);
			$gain_chip = $this->input->post('gain_chip_text', TRUE);
			$gain_gold = $this->input->post('gain_gold_text', TRUE);
			$gain_gold_prob = $this->input->post('gain_gold_prob_text', TRUE);
			if ($gain_coin == '') $gain_coin = '0';
			if ($gain_exp == '') $gain_exp = '0';
			if ($gain_chip == '') $gain_chip = '0';
			if ($gain_gold == '') $gain_gold = '0';
			if ($gain_gold_prob == '') $gain_gold_prob = '0';
			
			$game_mode = $this->input->post('game_mode_text', TRUE);
			$game_players = $this->input->post('game_players_text', TRUE);
			$game_challenge = $this->input->post('game_challenge_text', TRUE);
			if ($game_mode == '') $game_mode = '-1';
			if ($game_players == '') $game_players = '-1';
			if ($game_challenge == '') $game_challenge = '-1';
			
			$this->event_ingame_m->reg_event($title, $begin_date, $end_date, $open_date, $image_url, $link_url, $bonus_gold, $bonus_coin, $bonus_gas,
				$sale_gacha_1, $sale_gacha_0, $sale_car, $sale_supporter, $gain_coin, $gain_exp, $gain_chip, $gain_gold , $gain_gold_prob,
				$game_mode, $game_players, $game_challenge);
		}
		
		$this->load_event();
	}
	
	public function button_event()
	{
		$this->output->enable_profiler(TRUE);
		$data = array();

		if (isset($_POST['modify']))
		{
			$event_no = $this->input->post('event_no', TRUE);
			$event = $this->event_ingame_m->get_event($event_no);
			print_r($event);
			
			// $target_event['event_no'] = $event['event_no'];
			// $target_event['title'] = $event['title'];
			// $target_event['begin_date'] = $event['begin_date'];
			// $target_event['end_date'] = $event['end_date'];
			// $target_event['open_date'] = $event['open_date'];
			// $target_event['image_url'] = $event['image_url'];
			// $target_event['link_url'] = $event['link_url'];
			// $target_event['used'] = $event['used'];
			// $target_event['body'] = $event['body'];
			
			// $target_event['bonus.gold'] = $event['bonus.gold'];
			// $target_event'[bonus.coin'] = $event['bonus.coin'];
			// $target_event['bonus.gas'] = $event['bonus.gas'];
			// $target_event['sale.car'] = $event['sale.car'];
			// $target_event['sale.supporter'] = $event['sale.supporter'];
			// $target_event['sale.gacha.0'] = $event['sale.gacha.0'];
			// $target_event['sale.gacha.1'] = $event['sale.gacha.1'];
			// $target_event['game_mode'] = $event['game_mode'];
			// $target_event['game_players'] = $event['game_players'];
			// $target_event['game_challenge'] = $event['game_challenge'];
			// $target_event['gain.coin'] = $event['gain.coin'];
			// $target_event['gain.exp'] = $event['gain.exp'];
			// $target_event['gain.chip'] = $event['gain.chip'];
			// $target_event['gain.gold'] = $event['gain.gold'];
			// $target_event['gain.gold.prob'] = $event['gain.gold.prob'];
			
			$begin_date = explode(' ', $event['begin_date']);
			$end_date = explode(' ', $event['end_date']);
			$open_date = explode(' ', $event['open_date']);
			$event['begin_day'] = $begin_date[0];
			$event['begin_time'] = $begin_date[1];
			$event['end_day'] = $end_date[0];
			$event['end_time'] = $end_date[1];
			$event['open_day'] = $open_date[0];
			$event['open_time'] = $open_date[1];
			
			$data['target_event'] = $event;
		}
		else if (isset($_POST['delete']))
		{
			$event_no = $this->input->post('event_no', TRUE);
			$this->event_ingame_m->delete_event($event_no);
		}
		
		$_event_list = $this->event_ingame_m->get_event_list();
		$data['event_list'] = $this->make_view_data($_event_list);
		$this->load->view('/game_management/ingame_event_v', $data);
	}
	
	public function save_event()
	{
		$this->output->enable_profiler(TRUE);

		if (isset($_POST['save']))
		{
			$title = $this->input->post('event_name_text', TRUE);
				
			$begin_date = $this->input->post('begin_day_text', TRUE) . ' ' . $this->input->post('begin_time_text', TRUE);
			$end_date = $this->input->post('end_day_text', TRUE) . ' '. $this->input->post('end_time_text', TRUE);
			$open_date = $this->input->post('open_day_text', TRUE) . ' ' . $this->input->post('open_time_text', TRUE);
			
			$image_url = $this->input->post('image_url_text', TRUE);
			$link_url = $this->input->post('link_url_text', TRUE);
			
			$bonus_gold = $this->input->post('bonus_gold_text', TRUE);
			$bonus_coin = $this->input->post('bonus_coin_text', TRUE);
			$bonus_gas = $this->input->post('bonus_gas_text', TRUE);
			if ($bonus_gold == '') $bonus_gold = '0';
			if ($bonus_coin == '') $bonus_coin = '0';
			if ($bonus_gas == '') $bonus_gas = '0';
			
			$sale_gacha_1 = $this->input->post('sale_gacha_1_text', TRUE);
			$sale_gacha_0 = $this->input->post('sale_gacha_0_text', TRUE);
			$sale_car = $this->input->post('sale_car_text', TRUE);
			$sale_supporter = $this->input->post('sale_supporter_text', TRUE);
			if ($sale_gacha_1 == '') $sale_gacha_1 = '0';
			if ($sale_gacha_0 == '') $sale_gacha_0 = '0';
			if ($sale_car == '') $sale_car = '0';
			if ($sale_supporter == '') $sale_supporter = '0';
			
			$gain_coin = $this->input->post('gain_coin_text', TRUE);
			$gain_exp = $this->input->post('gain_exp_text', TRUE);
			$gain_chip = $this->input->post('gain_chip_text', TRUE);
			$gain_gold = $this->input->post('gain_gold_text', TRUE);
			$gain_gold_prob = $this->input->post('gain_gold_prob_text', TRUE);
			if ($gain_coin == '') $gain_coin = '0';
			if ($gain_exp == '') $gain_exp = '0';
			if ($gain_chip == '') $gain_chip = '0';
			if ($gain_gold == '') $gain_gold = '0';
			if ($gain_gold_prob == '') $gain_gold_prob = '0';
			
			$game_mode = $this->input->post('game_mode_text', TRUE);
			$game_players = $this->input->post('game_players_text', TRUE);
			$game_challenge = $this->input->post('game_challenge_text', TRUE);
			if ($game_mode == '') $game_mode = '-1';
			if ($game_players == '') $game_players = '-1';
			if ($game_challenge == '') $game_challenge = '-1';
			
			$event_no = $this->input->post('event_no_text', TRUE);
			
			if ($event_no != "")
			{
				$this->event_ingame_m->save_event($title, $begin_date, $end_date, $open_date, $image_url, $link_url, $bonus_gold, $bonus_coin, $bonus_gas,
					$sale_gacha_1, $sale_gacha_0, $sale_car, $sale_supporter, $gain_coin, $gain_exp, $gain_chip, $gain_gold , $gain_gold_prob,
					$game_mode, $game_players, $game_challenge, $event_no);
			}
		}
		
		$this->load_event();
	}
	
	public function publish()
	{
		$this->output->enable_profiler(TRUE);
		
		$channel = "pubsub_contents";
		$message = "ingame";
		
		$redis_host =  $this->config->item('redis_host');
		
		$redis = new Predis\Client('tcp://' . $redis_host);
		$redis->publish($channel, $message);
		
		$this->load_event();
	}
}