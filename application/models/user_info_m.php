<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_info_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_lists()
	{
		$sql = "select * from drag_gamedb.user_info limit 20";
		
		$query = $this->db->query($sql);
		
		$result = $query->result();
		
		return $result;
	}
	
	function find_user_with_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('user_info');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		#return $query->row_array();
		return $query->result();
	}
	
	function update_user($user_id, $nickname, $gas, $coin)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('nickname', $nickname);
		$this->db->set('gas', $gas);
		$this->db->set('coin', $coin);
		return $this->db->update('user_info');
	}
}