<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_action_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_lists()
	{
		$sql = "select * from drag_gamedb.user_action limit 20";
		
		$query = $this->db->query($sql);
		
		$result = $query->result();
		
		return $result;
	}
	
	function find_with_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('drag_gamedb.user_action');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->row_array();
		#return $query->result();
	}
	
	function update_user_action($user_id)
	{
		$this->db->where('user_id', $user_id);
		return $this->db->update('drag_gamedb.user_action');
	}
	
	function modify_straight_wins($user_id, $winning_count)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('winning_streak', $winning_count);
		return $this->db->update('drag_gamedb.user_action');
	}
}