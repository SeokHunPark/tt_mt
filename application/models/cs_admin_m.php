<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cs_admin_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_word_list()
	{
		$sql = "select * from drag_globaldb.banned_words";
		
		$query = $this->db->query($sql);
		
		$result = $query->result();
		
		return $result;
	}
	
	function get_admin_list()
	{
		$this->db->select('*');
		$this->db->from('drag_globaldb.cs_admin');
		$query = $this->db->get();
		return $query->result();
	}

	function insert_admin($admin_name, $password)
	{
		$this->db->set('user_name', $admin_name);
		$this->db->set('password', $password);
		return $this->db->insert('drag_globaldb.cs_admin');
	}
	
	function delete_admin($user_idx)
	{
		$this->db->where('user_idx', $user_idx);
		return $this->db->delete('drag_globaldb.cs_admin');
	}
}