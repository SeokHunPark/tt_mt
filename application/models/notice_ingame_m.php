<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice_ingame_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_notice_list()
	{
		// $sql = "select * from drag_gamedb.user_info limit 20";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
		
		$this->db->select('*');
		$this->db->from('drag_globaldb.notice_ingame');
		$this->db->order_by("notice_no", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function reg_notice($platform, $title, $begin_date, $end_date, $body, $used)
	{
		$this->db->set('platform', $platform);
		$this->db->set('title', $title);
		$this->db->set('begin_date', $begin_date);
		$this->db->set('end_date', $end_date);
		$this->db->set('body', $body);
		$this->db->set('used', $used);
		return $this->db->insert('drag_globaldb.notice_ingame');
	}
	
	function cancel_notice($notice_no)
	{
		$this->db->where('notice_no', $notice_no);
		$this->db->set('used', 'N');
		return $this->db->update('drag_globaldb.notice_ingame');
	}
}