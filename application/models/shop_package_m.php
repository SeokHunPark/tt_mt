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
		$this->db->order_by("package_no", "desc");
		$query = $this->db->get();
		return $query->result();
	}
	
	function find_with_package_no($package_no)
	{
		$this->db->select('*');
		$this->db->from('drag_globaldb.shop_package');
		$this->db->where('package_no', $package_no);
		$query = $this->db->get();
		return $query->result();
	}
	
	function save_package($package_no, $price, $image_url, $gold, $gas, $coin, $item_string)
	{
		$this->db->where('package_no', $package_no);
		$this->db->set('price', $price);
		$this->db->set('image_url', $image_url);
		$this->db->set('gold', $gold);
		$this->db->set('gas', $gas);
		$this->db->set('coin', $coin);
		$this->db->set('item_string', $item_string);
		return $this->db->update('drag_globaldb.shop_package');
	}
	
	function add_package($price, $image_url, $gold, $gas, $coin, $item_string)
	{
		$this->db->set('price', $price);
		$this->db->set('image_url', $image_url);
		$this->db->set('gold', $gold);
		$this->db->set('gas', $gas);
		$this->db->set('coin', $coin);
		$this->db->set('item_string', $item_string);
		return $this->db->insert('drag_globaldb.shop_package');
	}
}