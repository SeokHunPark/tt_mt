﻿<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_cash_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_order_list()
	{
		// $sql = "select * from drag_gamedb.user_info limit 20";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
		
		$this->db->select('*');
		$this->db->from('drag_logdb.log_cash');
		$this->db->order_by("log_cash_idx", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function find_order($order_id)
	{
		$this->db->select('*');
		$this->db->from('drag_logdb.log_cash');
		$this->db->where('receipt_key', $order_id);
		$this->db->order_by("log_cash_idx", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_list_with_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('drag_logdb.log_cash');
		$this->db->where('user_id', $user_id);
		$this->db->order_by("log_cash_idx", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_list_with_date($begin_date, $end_date)
	{
		// $sql = "select * from drag_logdb.log_cash where reg_date between '$begin_date' and '$end_date' order by mail_idx desc";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
		
		$this->db->select('*');
		$this->db->from('drag_logdb.log_cash');
		$this->db->where('reg_date >=', $begin_date);
		$this->db->where('reg_Date <=', $end_date);
		$this->db->order_by("log_cash_idx", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function cancel_order($order_id, $memo)
	{
		$this->db->where('receipt_key', $order_id);
		$this->db->set('status', 'C');
		$this->db->set('memo', $memo);
		return $this->db->update('drag_logdb.log_cash');
	}
}