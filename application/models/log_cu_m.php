<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_cu_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_list()
	{
		// $sql = "select * from drag_gamedb.user_info limit 20";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
		
		$this->db->select('*');
		$this->db->from('drag_globaldb.log_cu');
		$this->db->order_by("reg_date", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_recent_row()
	{
		$this->db->select('*');
		$this->db->from('drag_globaldb.log_cu');
		$this->db->order_by("reg_date", "desc");
		$this->db->limit(1, 0);
		$query = $this->db->get();
		return $query->result();
	}
}