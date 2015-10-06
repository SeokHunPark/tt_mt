<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_mail_list($offset, $size)
	{
		$sql = "select * from drag_gamedb.mail limit $offset, $size";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
}