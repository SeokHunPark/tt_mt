﻿<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_gain_mail_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_log_list()
	{
		// $sql = "select * from drag_gamedb.user_info limit 20";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
		
		$this->db->select('*');
		$this->db->from('drag_logdb.log_gain_mail');
		$this->db->order_by("reg_date", "desc");
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_list_with_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('drag_logdb.log_gain_mail');
		$this->db->where('user_id', $user_id);
		$this->db->order_by("reg_date", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_list_with_date($user_id, $begin_date, $end_date, $limit, $offset)
	{
		// $sql = "select * from drag_logdb.log_gain_mail where reg_date between '$begin_date' and '$end_date' order by mail_idx desc";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
		
		$this->db->select('*');
		$this->db->from('drag_logdb.log_gain_mail');
		if ($user_id != '-1')
			$this->db->where('user_id', $user_id);
		$this->db->where('reg_date >=', $begin_date);
		$this->db->where('reg_date <=', $end_date);
		$this->db->order_by("reg_date", "desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
	
	function insert_log($partkey_month, $user_id, $sender_id, $mail_type, $title, $item_string, $categ, $reg_date)
	{
		$this->db->set('partkey_month', $partkey_month);
		$this->db->set('user_id', $user_id);
		$this->db->set('sender_id', $sender_id);
		$this->db->set('mail_type', $mail_type);
		$this->db->set('title', $title);
		$this->db->set('item_string', $item_string);
		$this->db->set('categ', $categ);
		$this->db->set('reg_date', $reg_date);
		return $this->db->insert('drag_logdb.log_gain_mail');
	}
}