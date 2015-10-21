<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_purchase_items_m extends CI_Model
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
		$this->db->from('drag_gamedb.user_purchase_items');
		$query = $this->db->get();
		return $query->result();
	}
	
	function find_with_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('drag_gamedb.user_purchase_items');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function insert_purchase_item($user_id, $sku, $item_id, $event_id, $type, $start_date, $recent_date, $item_string, $count, $max_count, $used)
	{
		$this->db->set('user_id', $user_id);
		$this->db->set('sku', $sku);
		$this->db->set('item_id', $item_id);
		$this->db->set('event_id', $event_id);
		$this->db->set('type', $type);
		$this->db->set('start_date', $start_date);
		$this->db->set('recent_date', $recent_date);
		$this->db->set('item_string', $item_string);
		$this->db->set('count', $count);
		$this->db->set('max_count', $max_count);
		$this->db->set('used', $used);
		return $this->db->insert('drag_gamedb.user_purchase_items');
	}
	
	function delete_purchase_item($user_id, $item_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('item_id', $item_id);
		return $this->db->delete('drag_gamedb.user_purchase_items');
	}
}