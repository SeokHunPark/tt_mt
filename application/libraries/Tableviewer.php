<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Tableviewer
{
	public function __construct()
	{
		$CI = & get_instance();
		$CI->load->database('dev');
		$CI->load->library('table');
		$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="5" cellspacing="1" rules="rows"  class="mytable">',
						'heading_row_start'   => '<tr bgcolor=#FFBF00>',
						'heading_row_end'     => '</tr>',
						'heading_cell_start'  => '<th>',
						'heading_cell_end'    => '</th>',
						
						'row_start'           => '<tr  bgcolor=#E0F8E0>',
						'row_end'             => '</tr>',
						'cell_start'          => '<td>',
						'cell_end'            => '</td>',
						
						'row_alt_start'       => '<tr  bgcolor=#CEF6CE>',
						'row_alt_end'         => '</tr>',
						'cell_alt_start'      => '<td>',
						'cell_alt_end'        => '</td>',
						'table_close'         => '</table>'
						);
		$CI->table->set_template($tmpl);
	}
	
	public function show_all_table()
	{

	}
	
	public function show_logcu($limit)
	{
		$CI = & get_instance();
		$CI->db->select('*');
		$CI->db->from('globaldb.log_cu');
		//$CI->db->order_by('log_connect_idx', 'desc');
		$CI->db->limit($limit);
		$query = $CI->db->get();
		$CI->table->clear();
		echo $CI->table->generate($query);
	}
	
	public function show_push_token_table($userid)
	{
		$CI = & get_instance();
		$CI->db->select('push_token');
		$CI->db->from('user_push_token');
		$CI->db->where('user_id', $userid);
		$query = $CI->db->get();
		$CI->table->clear();
		echo $CI->table->generate($query);
	}
	
	public function show_user_info_table($userid)
	{
		$CI = & get_instance();
		$CI->db->select('*');
		$CI->db->from('user_info');
		$CI->db->where('user_id', $userid);
		$query = $CI->db->get();
		$CI->table->clear();
		echo $CI->table->generate($query);
	}
	
	public function show_user_inven_table($userid)
	{
		$CI = & get_instance();
		$CI->db->select('*');
		$CI->db->from('user_inven');
		$CI->db->where('user_id', $userid);
		$query = $CI->db->get();
		$CI->table->clear();
		echo $CI->table->generate($query);
	}
	
	public function show_user_items_table($userid)
	{
		$CI = & get_instance();
		$CI->db->select('item_code, count, expire');
		$CI->db->from('user_items');
		$CI->db->where('user_id', $userid);
		$query = $CI->db->get();
		$CI->table->clear();
		echo $CI->table->generate($query);
	}
	
	public function show_user_action_table($userid)
	{
		$CI = & get_instance();
		//$CI->db->select('actions, supporters, open_supporter, tutorial, num_game, up_point, up_fill_secs');
		$CI->db->select('*');
		$CI->db->from('user_action');
		$CI->db->where('user_id', $userid);
		$query = $CI->db->get();
		$CI->table->clear();
		echo $CI->table->generate($query);
	}
	
	public function show_user_upgrade_table($userid)
	{
		$CI = & get_instance();
		$CI->db->select('*');
		$CI->db->from('user_upgrade');
		$CI->db->where('user_id', $userid);
		$query = $CI->db->get();
		$CI->table->clear();
		echo $CI->table->generate($query);
	}
	
	public function show_user_supporters_table($userid)
	{
		$CI = & get_instance();
		$CI->db->select('*');
		$CI->db->from('user_supporters');
		$CI->db->where('user_id', $userid);
		$query = $CI->db->get();
		$CI->table->clear();
		echo $CI->table->generate($query);
	}
	
	public function show_mail_table($userid)
	{
		$CI = & get_instance();
		$CI->db->select('*');
		$CI->db->from('mail');
		$CI->db->where('user_id', $userid);
		$query = $CI->db->get();
		$CI->table->clear();
		echo $CI->table->generate($query);
	}
	
	public function show_user_challenges_table($userid)
	{
		$CI = & get_instance();
		$CI->db->select('*');
		$CI->db->from('user_challenges');
		$CI->db->where('user_id', $userid);
		$query = $CI->db->get();
		$CI->table->clear();
		echo $CI->table->generate($query);
	}
}