<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
		$this->db->order_by("pub_date", "desc");
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
	
	function get_list_with_user_id_2($user_id, $limit, $offset)
	{
		$this->db->select('*');
		$this->db->from('drag_logdb.log_cash');
		$this->db->where('user_id', $user_id);
		$this->db->order_by("log_cash_idx", "desc");
		$this->db->limit($limit, $offset);
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
		$this->db->where('pub_date >=', $begin_date);
		$this->db->where('pub_Date <=', $end_date);
		$this->db->order_by("log_cash_idx", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_list_with_date_2($begin_date, $end_date, $limit, $offset)
	{
		$this->db->select('*');
		$this->db->from('drag_logdb.log_cash');
		// if ($user_id != '-1')
			// $this->db->where('user_id', $user_id);
		$this->db->where('pub_date >=', $begin_date);
		$this->db->where('pub_date <=', $end_date);
		$this->db->order_by("pub_date", "desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
	
	function search_order($user_id, $begin_date, $end_date, $limit, $offset)
	{
		$this->db->select('*');
		$this->db->from('drag_logdb.log_cash');
		if ($user_id != '-1')
			$this->db->where('user_id', $user_id);
		$this->db->where('pub_date >=', $begin_date);
		$this->db->where('pub_date <=', $end_date);
		$this->db->order_by("pub_date", "desc");
		$this->db->limit($limit, $offset);
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
	
	function insert_order($partkey_month, $user_id, $categ, $item_id, $real_cash, $real_cash_kr, $receipt_key, $inc_gold, $market, $country, $currency_type,
		$memo, $reg_date, $pub_date, $status)
	{
		$this->db->set('partkey_month', $partkey_month);
		$this->db->set('user_id', $user_id);
		$this->db->set('categ', $categ);
		$this->db->set('item_id', $item_id);
		$this->db->set('real_cash', $real_cash);
		$this->db->set('real_cash_kr', $real_cash_kr);
		$this->db->set('receipt_key', $receipt_key);
		$this->db->set('inc_gold', $inc_gold);
		$this->db->set('market', $market);
		$this->db->set('country', $country);
		$this->db->set('currency_type', $currency_type);
		$this->db->set('memo', $memo);
		$this->db->set('reg_date', $reg_date);
		$this->db->set('pub_date', $pub_date);
		$this->db->set('status', $status);
		return $this->db->insert('drag_logdb.log_cash');
	}
}