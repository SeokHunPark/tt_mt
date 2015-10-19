<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function login($auth)
	{
		$user_name = $auth['username'];
		$password = $auth['password'];
		#$sql = "select username, email from users drag_globaldb.cs_admin user_name = '".$auth['username']."' and pasaword = '".$auth['password']."' ";
		
		$this->db->select('*');
		$this->db->from('drag_globaldb.cs_admin');
		$this->db->where('user_name', $user_name);
		$this->db->where('password', $password);
		$query = $this->db->get();
		#return $query->result();
		#$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return FALSE;
		}
	}
}