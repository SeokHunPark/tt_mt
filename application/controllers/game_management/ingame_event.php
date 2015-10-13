<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
			$event_list[$i]['used'] = $event['used'];
			$event_list[$i]['body'] = $event['body'];
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
			
			$event_list[$i]['event_no'] = $event['event_no'];
			$event_list[$i]['title'] = $event['title'];
			$event_list[$i]['begin_date'] = $event['begin_date'];
			$event_list[$i]['end_date'] = $event['end_date'];
			$event_list[$i]['open_date'] = $event['open_date'];
			$event_list[$i]['image_url'] = $event['image_url'];
			$event_list[$i]['link_url'] = $event['link_url'];
			$event_list[$i]['description'] = "";
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
			if ((float)$game_mode > 0)
			{
				$event_list[$i]['description'] .= "\n<br>";
				$event_list[$i]['description'] .= "게임 모드 : ";
				$event_list[$i]['description'] .= $game_mode;
			}
			if ((float)$game_players > 0)
			{
				$event_list[$i]['description'] .= "\n<br>";
				$event_list[$i]['description'] .= "게임 플레이어 : ";
				$event_list[$i]['description'] .= $game_players;
			}
			if ((float)$game_challenge > 0)
			{
				$event_list[$i]['description'] .= "\n<br>";
				$event_list[$i]['description'] .= "게임 챌린지 : ";
				$event_list[$i]['description'] .= $game_challenge;
			}
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
}