<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sanction_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function find_with_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('drag_gamedb.sanction');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->row_array();
		#return $query->result();
	}
	
	function update($user_id)
	{
		$this->db->where('user_id', $user_id);
		return $this->db->update('user_action');
	}
	
	function reg_user($user_id, $sanction_type, $s_date, $e_date, $subject, $reason, $memo, $reg_user, $reg_date)
	{
		$this->db->set('user_id', $user_id);
		$this->db->set('sanction_type', $sanction_type);
		$this->db->set('s_date', $s_date);
		$this->db->set('e_date', $e_date);
		$this->db->set('subject', $subject);
		$this->db->set('reason', $reason);
		if ($memo != "")
			$this->db->set('memo', $memo);
		$this->db->set('reg_user', $reg_user);
		$this->db->set('reg_date', $reg_date);
		$this->db->update('drag_gamedb.sanction');
	}
	
	function modify_stage($user_id, $stage)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('stage', $stage);
		$this->db->update('drag_gamedb.user_challenges');
	}
	
	function delete_user($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete('drag_gamedb.sanction');
	}
}