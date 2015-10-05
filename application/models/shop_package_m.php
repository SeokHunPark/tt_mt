<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop_package_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_package_list()
	{
		// $sql = "select * from drag_gamedb.user_info limit 20";
		// $query = $this->db->query($sql);
		// $result = $query->result();
		// return $result;
		
		$this->db->select('*');
		$this->db->from('drag_globaldb.shop_package');
		$query = $this->db->get();
		return $query->result();
	}
	
	function save_promotion($promotion_no, $title, $package, $expose_int, $reexpose_buy, $expose_limit, $expose_prob)
	{
		$this->db->where('promotion_no', $promotion_no);
		$this->db->set('title', $title);
		$this->db->set('package', $package);
		$this->db->set('expose_int', $expose_int);
		$this->db->set('reexpose_buy', $reexpose_buy);
		$this->db->set('expose_limit', $expose_limit);
		$this->db->set('expose_prob', $expose_prob);
		return $this->db->update('drag_globaldb.shop_promotion');
	}
}