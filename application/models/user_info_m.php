<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_info_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_lists()
	{
		$sql = "select * from drag_gamedb.user_info";
		
		$query = $this->db->query($sql);
		
		$result = $query->result();
		
		return $result;
	}
	
	function find_with_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('drag_gamedb.user_info');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->row_array();
		#return $query->result();
	}
	
	function get_user_id_with_pid($pid)
	{
		$this->db->select('*');
		$this->db->from('drag_gamedb.user_info');
		$this->db->where('platform_user_id', $pid);
		$query = $this->db->get();
		$result = $query->row_array();
		if (isset($result['user_id']))
		{
			return $result['user_id'];
		}
		else
		{
			return "";
		}
	}
	
	function get_user_id_with_nickname($nickname)
	{
		$this->db->select('user_id');
		$this->db->from('drag_gamedb.user_info');
		$this->db->where('nickname', $nickname);
		$query = $this->db->get();
		$result = $query->row_array();
		if (isset($result['user_id']))
		{
			return $result['user_id'];
		}
		else
		{
			return "";
		}
	}
	
	function modify_nickname($user_id, $nickname)
	{
		#print "modify_nickname()";
		#print "nickname : $nickname";
		$this->db->where('user_id', $user_id);
		$this->db->set('nickname', $nickname);
		return $this->db->update('drag_gamedb.user_info');
	}
	
	function leave_game($user_id, $unreg_date)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('status', 'U');
		$this->db->set('unreg_date', $unreg_date);
		return $this->db->update('drag_gamedb.user_info');
	}
	
	function leave_recovery_game($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('status', 'N');
		$this->db->set('unreg_date', null);
		return $this->db->update('drag_gamedb.user_info');
	}
	
	function modify_money($user_id, $gas, $coin, $gold, $vgold, $chip)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('gas', $gas);
		$this->db->set('coin', $coin);
		$this->db->set('gold', $gold);
		$this->db->set('vgold', $vgold);
		$this->db->set('chip', $chip);
		return $this->db->update('drag_gamedb.user_info');
	}
	
	function modify_exp($user_id, $exp)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('exp', $exp);
		return $this->db->update('drag_gamedb.user_info');
	}
	
	function update_user($user_id, $nickname, $gas, $coin)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('nickname', $nickname);
		$this->db->set('gas', $gas);
		$this->db->set('coin', $coin);
		return $this->db->update('drag_gamedb.user_info');
	}
	
	function set($user_id, $key, $value)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set($key, $value);
		return $this->db->update('drag_gamedb.user_info');
	}
	
	function modify_gas($user_id, $gas)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('gas', $gas);
		return $this->db->update('drag_gamedb.user_info');
	}
	
	function modify_coin($user_id, $coin)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('coin', $coin);
		return $this->db->update('drag_gamedb.user_info');
	}
	
	function modify_vgold($user_id, $vgold)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('vgold', $vgold);
		return $this->db->update('drag_gamedb.user_info');
	}
	
	function modify_chip($user_id, $chip)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('chip', $chip);
		return $this->db->update('drag_gamedb.user_info');
	}
}