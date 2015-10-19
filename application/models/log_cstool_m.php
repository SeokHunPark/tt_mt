<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_cstool_m extends CI_Model
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
		$this->db->from('drag_logdb.log_cstool');
		$this->db->order_by("log_cstool_idx", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_list_with_date($begin_date, $end_date)
	{
		$this->db->select('*');
		$this->db->from('drag_logdb.log_cstool');
		$this->db->where('reg_date >=', $begin_date);
		$this->db->where('reg_Date <=', $end_date);
		$this->db->order_by("log_cstool_idx", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_list_with_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('drag_logdb.log_cstool');
		$this->db->where('user_id', $user_id);
		$this->db->order_by("log_cstool_idx", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_list_with_admin_name($admin_name)
	{
		$this->db->select('*');
		$this->db->from('drag_logdb.log_cstool');
		$this->db->where('admin_name', $admin_name);
		$this->db->order_by("log_cstool_idx", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo)
	{
		$this->db->set('reg_date', $reg_date);
		$this->db->set('ip_address', $ip_address);
		$this->db->set('admin_name', $admin_name);
		$this->db->set('user_id', $user_id);
		$this->db->set('action', $action);
		$this->db->set('item_id', $item_id);
		$this->db->set('item_count', $item_count);
		$this->db->set('memo', $memo);
		return $this->db->insert('drag_logdb.log_cstool');
	}
	
	
}