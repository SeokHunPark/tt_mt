<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_history_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_list()
	{
		// $sql = "select * from drag_gamedb.user_info limit 20";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
		
		$this->db->select('*');
		$this->db->from('drag_gamedb.purchase_history');
		$this->db->order_by("apply_date", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function insert_history($partkey_month, $sku, $order_id, $apply_date, $user_id, $market)
	{
		$this->db->set('partkey_month', $partkey_month);
		$this->db->set('sku', $sku);
		$this->db->set('order_id', $order_id);
		$this->db->set('apply_date', $apply_date);
		$this->db->set('user_id', $user_id);
		$this->db->set('market', $market);
		return $this->db->insert('drag_gamedb.purchase_history');
	}
}