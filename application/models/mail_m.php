<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_list_with_user_id($user_id)
	{
		$sql = "select * from drag_gamedb.mail where user_id = '$user_id' order by mail_idx desc";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	function get_list_with_date($begin_date, $end_date)
	{
		$sql = "select * from drag_gamedb.mail where reg_date between '$begin_date' and '$end_date' order by mail_idx desc";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	function get_list_with_date_2($begin_date, $end_date, $offset, $size)
	{
		$sql = "select * from drag_gamedb.mail where reg_date between '$begin_date' and '$end_date' order by mail_idx desc limit $offset, $size";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	
}