<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_supporters_m extends CI_Model
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
		$this->db->from('drag_gamedb.user_supporters');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function modify_sup($user_id, $model_id, $count)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('model_id', $model_id);
		$this->db->set('count', $count);
		return $this->db->update('drag_gamedb.user_supporters');
	}
	
	function delete_sup($user_id, $model_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('model_id', $model_id);
		return $this->db->delete('drag_gamedb.user_supporters');
	}
	
	function insert_sup($user_id, $model_id)
	{
		$this->db->set('user_id', $user_id);
		$this->db->set('model_id', $model_id);
		return $this->db->insert('drag_gamedb.user_supporters');
	}
}