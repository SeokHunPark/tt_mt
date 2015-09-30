<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_challenges_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_lists()
	{
		$sql = "select * from drag_gamedb.user_challenges limit 20";
		
		$query = $this->db->query($sql);
		
		$result = $query->result();
		
		return $result;
	}
	
	function find_with_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('user_challenges');
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
}