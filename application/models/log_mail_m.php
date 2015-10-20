<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_mail_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_list_with_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('drag_logdb.log_mail');
		$this->db->where('user_id', $user_id);
		$this->db->order_by("reg_date", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_list_with_date($user_id, $begin_date, $end_date, $limit, $offset)
	{
		// $sql = "select * from drag_logdb.log_mail where reg_date between '$begin_date' and '$end_date' order by mail_idx desc";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
		
		$this->db->select('*');
		$this->db->from('drag_logdb.log_mail');
		if ($user_id != '-1')
			$this->db->where('user_id', $user_id);
		$this->db->where('reg_date >=', $begin_date);
		$this->db->where('reg_date <=', $end_date);
		$this->db->order_by("reg_date", "desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
	
	// function get_mail_log_list($offset, $size)
	// {
		// $sql = "select * from drag_logdb.log_mail limit $offset, $size";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
	// }
	
	// function get_list_with_user_id($user_id)
	// {
		// $sql = "select * from drag_logdb.log_mail where user_id = '$user_id' order by mail_idx desc";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
	// }
	
	// function get_list_with_date($begin_date, $end_date)
	// {
		// $sql = "select * from drag_logdb.log_mail where reg_date between '$begin_date' and '$end_date' order by mail_idx desc";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
	// }
	
	// function get_list_with_date_2($begin_date, $end_date, $offset, $size)
	// {
		// $sql = "select * from drag_logdb.log_mail where reg_date between '$begin_date' and '$end_date' order by mail_idx desc limit $offset, $size";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
	// }
}