<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_ingame_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_event_list()
	{
		// $sql = "select * from drag_gamedb.user_info limit 20";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
		
		$this->db->select('*');
		$this->db->from('drag_globaldb.event_ingame');
		$this->db->order_by("event_no", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_event($event_no)
	{
		$this->db->select('*');
		$this->db->from('drag_globaldb.event_ingame');
		$this->db->where('event_no', $event_no);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	function reg_event($title, $categ, $begin_date, $end_date, $open_date, $image_url, $link_url, $bonus_gold, $bonus_coin, $bonus_gas,
				$sale_gacha_1, $sale_gacha_0, $sale_car, $sale_supporter, $gain_coin, $gain_exp, $gain_chip, $gain_gold , $gain_gold_prob,
				$game_mode, $game_players, $game_challenge)
	{
		// $this->db->set('title', $title);
		// $this->db->set('begin_date', $begin_date);
		// $this->db->set('end_date', $end_date);
		// $this->db->set('open_date', $open_date);
		// $this->db->set('image_url', $image_url);
		// $this->db->set('link_url', $link_url);
		// $this->db->set('bonus.gold', $bonus_gold);
		// $this->db->set('bonus.coin', $bonus_coin);
		// $this->db->set('bonus.gas', $bonus_gas);
		// $this->db->set('sale.gacha.1', $sale_gacha_1);
		// $this->db->set('sale.gacha.0', $sale_gacha_0);
		// $this->db->set('sale.car', $sale_car);
		// $this->db->set('sale.supporter', $sale_supporter);
		// $this->db->set('gain.coin', $gain_coin);
		// $this->db->set('gain.exp', $gain_exp);
		// $this->db->set('gain.chip', $gain_chip);
		// $this->db->set('gain.gold', $gain_gold);
		// $this->db->set('gain.gold.prob', $gain_gold_prob);
		// $this->db->set('game_mode', $game_mode);
		// $this->db->set('game_players', $game_players);
		// $this->db->set('game_challenge', $game_challenge);
		// return $this->db->insert('drag_globaldb.event_ingame');
		
		$query = "INSERT INTO `drag_globaldb`.`event_ingame` (`title`, `categ`, `begin_date`, `end_date`, `open_date`, `image_url`, `link_url`, `bonus.gold`, `bonus.coin`, `bonus.gas`, `sale.gacha.1`, `sale.gacha.0`, `sale.car`, `sale.supporter`, `gain.coin`, `gain.exp`, `gain.chip`, `gain.gold`, `gain.gold.prob`, `game_mode`, `game_players`, `game_challenge`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$this->db->query($query, array($title, $categ, $begin_date, $end_date, $open_date, $image_url, $link_url, $bonus_gold, $bonus_coin, $bonus_gas,
				$sale_gacha_1, $sale_gacha_0, $sale_car, $sale_supporter, $gain_coin, $gain_exp, $gain_chip, $gain_gold , $gain_gold_prob,
				$game_mode, $game_players, $game_challenge));
	}
	
	function save_event($title, $categ, $begin_date, $end_date, $open_date, $image_url, $link_url, $bonus_gold, $bonus_coin, $bonus_gas,
				$sale_gacha_1, $sale_gacha_0, $sale_car, $sale_supporter, $gain_coin, $gain_exp, $gain_chip, $gain_gold , $gain_gold_prob,
				$game_mode, $game_players, $game_challenge, $event_no)
	{
		$query = "UPDATE `drag_globaldb`.`event_ingame` SET `title` = ?, `categ` = ?, `begin_date` = ?, `end_date` = ?, `open_date` = ?, `image_url` = ?, `link_url` = ?, `bonus.gold` = ?, `bonus.coin` = ?, `bonus.gas` = ?, `sale.gacha.1` = ?, `sale.gacha.0` = ?, `sale.car` = ?, `sale.supporter` = ?, `gain.coin` = ?, `gain.exp` = ?, `gain.chip` = ?, `gain.gold` = ?, `gain.gold.prob` = ?, `game_mode` = ?, `game_players` = ?, `game_challenge` = ? WHERE `event_no` = ?";
		$this->db->query($query, array($title, $categ, $begin_date, $end_date, $open_date, $image_url, $link_url, $bonus_gold, $bonus_coin, $bonus_gas,
				$sale_gacha_1, $sale_gacha_0, $sale_car, $sale_supporter, $gain_coin, $gain_exp, $gain_chip, $gain_gold , $gain_gold_prob,
				$game_mode, $game_players, $game_challenge, $event_no));
	}
	
	function delete_event($event_no)
	{		
		$this->db->where('event_no', $event_no);
		$this->db->delete('drag_globaldb.event_ingame');
	}
}