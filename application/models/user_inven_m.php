<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_inven_m extends CI_Model
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
		$this->db->from('drag_gamedb.user_inven');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function modify_car($user_id, $model_id, $speed, $accel, $booster_charge, $booster_power, $upgrade, $exp, $point, $atk, $def, $aero, $decal, $color)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('model_id', $model_id);
		$this->db->set('up_0', $speed);
		$this->db->set('up_1', $accel);
		$this->db->set('up_3', $booster_charge);
		$this->db->set('up_2', $booster_power);
		$this->db->set('upgrade', $upgrade);
		$this->db->set('exp', $exp);
		$this->db->set('point', $point);
		$this->db->set('gr_0', $atk);
		$this->db->set('gr_1', $def);
		$this->db->set('gr_2', $aero);
		$this->db->set('sel_skin', $decal);
		$this->db->set('sel_color', $color);
		return $this->db->update('drag_gamedb.user_inven');
	}
	
	// function get_user_inven($user_id)
	// {
		// $this->db->select('*');
		// $this->db->from('drag_gamedb.user_inven');
		// $this->db->where('user_id', $user_id);
		// $query = $this->db->get();
		// return $query->row_array();
	// }
	
	function delete_car($user_id, $model_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('model_id', $model_id);
		return $this->db->delete('drag_gamedb.user_inven');
	}
	
	function insert_car($user_id, $model_id, $speed, $accel, $booster_charge, $booster_power, $upgrade, $exp, $point, $atk, $def, $aero, $decal, $color)
	{
		$this->db->set('user_id', $user_id);
		$this->db->set('model_id', $model_id);
		$this->db->set('up_0', $speed);
		$this->db->set('up_1', $accel);
		$this->db->set('up_3', $booster_charge);
		$this->db->set('up_2', $booster_power);
		$this->db->set('upgrade', $upgrade);
		$this->db->set('exp', $exp);
		$this->db->set('point', $point);
		$this->db->set('gr_0', $atk);
		$this->db->set('gr_1', $def);
		$this->db->set('gr_2', $aero);
		$this->db->set('sel_skin', $decal);
		$this->db->set('sel_color', $color);
		return $this->db->insert('drag_gamedb.user_inven');
	}
}