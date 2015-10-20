<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_connect_m extends CI_Model
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
		$this->db->from('drag_logdb.log_connect');
		$this->db->order_by("login_date", "desc");
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_list_with_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('drag_logdb.log_connect');
		$this->db->where('user_id', $user_id);
		$this->db->order_by("login_date", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_list_with_date($user_id, $begin_date, $end_date, $limit, $offset)
	{
		// $sql = "select * from drag_logdb.log_connect where reg_date between '$begin_date' and '$end_date' order by mail_idx desc";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
		
		$this->db->select('*');
		$this->db->from('drag_logdb.log_connect');
		$this->db->where('user_id', $user_id);
		$this->db->where('login_date >=', $begin_date);
		$this->db->where('login_date <=', $end_date);
		$this->db->order_by("login_date", "desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
}