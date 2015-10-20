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
	
	function insert_mail($user_id, $sender_id, $mail_type, $send_ts, $title, $message, $is_received, $item_string, $categ, $reg_date, $expire_date)
	{
		$this->db->set('user_id', $user_id);
		$this->db->set('sender_id', $sender_id);
		$this->db->set('mail_type', $mail_type);
		$this->db->set('send_ts', $send_ts);
		$this->db->set('title', $title);
		$this->db->set('message', $message);
		$this->db->set('is_received', $is_received);
		$this->db->set('item_string', $item_string);
		$this->db->set('categ', $categ);
		$this->db->set('reg_date', $reg_date);
		$this->db->set('expire_date', $expire_date);
		return $this->db->insert('drag_gamedb.mail');
	}
	
	function delete_mail($mail_idx)
	{
		$this->db->where('mail_idx', $mail_idx);
		return $this->db->delete('drag_gamedb.mail');
	}
}