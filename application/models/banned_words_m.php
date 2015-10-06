<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banned_words_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_word_list()
	{
		$sql = "select * from drag_globaldb.banned_words";
		
		$query = $this->db->query($sql);
		
		$result = $query->result();
		
		return $result;
	}
	
	function like_word($word)
	{
		$this->db->select('*');
		$this->db->from('banned_words');
		$this->db->like('word', $word);
		$query = $this->db->get();
		return $query->result();
	}
	
	function find_word($word)
	{
		$this->db->select('*');
		$this->db->from('banned_words');
		$this->db->where('word', $word);
		$query = $this->db->get();
		return $query->result();
	}
	
	function insert_word($word)
	{
		$this->db->set('word', $word);
		$this->db->set('is_banned', 1);
		$this->db->insert('banned_words');
	}
	
	function delete_word($word_index)
	{
		$this->db->where('word_idx', $word_index);
		$this->db->delete('banned_words');
	}
}