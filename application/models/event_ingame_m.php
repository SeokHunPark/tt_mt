<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_ingame_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_event_list()
	{
		// $sql = "select * from drag_gamedb.user_info limit 20";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
		
		$this->db->select('*');
		$this->db->from('drag_globaldb.event_ingame');
		$this->db->order_by("event_no", "desc");
		$query = $this->db->get();
		return $query->result();
	}
}