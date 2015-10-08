<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_items_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_list($user_id)
	{
		// $sql = "select * from drag_gamedb.user_inven";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
		
		$this->db->select('*');
		$this->db->from('drag_gamedb.user_items');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function modify_parts($user_id, $item_code, $count)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('item_code', $item_code);
		$this->db->set('count', $count);
		return $this->db->update('drag_gamedb.user_items');
	}
}