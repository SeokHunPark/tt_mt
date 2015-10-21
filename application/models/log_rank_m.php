<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_rank_m extends CI_Model
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
		$this->db->from('drag_logdb.log_rank');
		$this->db->order_by("reg_date", "desc");
		$this->db->order_by("rank", "asc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_list_with_reg_date($reg_date, $limit, $offset)
	{
		$this->db->select('*');
		$this->db->from('drag_logdb.log_rank');
		$this->db->where('reg_date', $reg_date);
		$this->db->order_by("reg_date", "desc");
		$this->db->order_by("rank", "asc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_list_with_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('drag_logdb.log_rank');
		$this->db->where('user_id', $user_id);
		$this->db->order_by("reg_date", "desc");
		$this->db->order_by("rank", "asc");
		$query = $this->db->get();
		return $query->result();
	}
}