<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_hottime_m extends CI_Model
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
		$this->db->from('drag_globaldb.event_hottime');
		$this->db->order_by("event_no", "desc"); 
		$query = $this->db->get();
		return $query->result();
	}
	
	function modify_event($event_no, $title, $type, $begin_date, $end_date, $item_string)
	{
		$this->db->where('event_no', $event_no);
		$this->db->set('title', $title);
		$this->db->set('type', $type);
		$this->db->set('begin_date', $begin_date);
		$this->db->set('end_date', $end_date);
		$this->db->set('item_string', $item_string);
		return $this->db->update('drag_globaldb.event_hottime');
	}
	
	function add_event($title, $type, $begin_date, $end_date, $item_string, $is_used)
	{
		$this->db->set('title', $title);
		$this->db->set('type', $type);
		$this->db->set('begin_date', $begin_date);
		$this->db->set('end_date', $end_date);
		$this->db->set('item_string', $item_string);
		$this->db->set('is_used', $is_used);
		return $this->db->insert('drag_globaldb.event_hottime');
	}
}