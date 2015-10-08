<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parts extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('gamedb');
		$this->load->model('user_info_m');
		$this->load->model('user_items_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		print "Parts index()";
		$this->load_parts_list();
	}
	
	public function _remap($method)
	{
		// header include.
		$this->load->view('header_v');
		
		// nav include.
		$this->load->view('nav_v');
		
		if (method_exists($this, $method))
		{
			$this->{"{$method}"}();
		}
		
		// popup include.
		#$this->load->view('/user_info/account_lookup_popup_v');
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_parts_list()
	{
		$this->output->enable_profiler(TRUE);
		
		$target_parts['user_id'] = "";
		$target_parts['item_code'] = "";
		$target_parts['class'] = "";
		$target_parts['count'] = "";
		$data['target_parts'] = $target_parts;
		
		$user_id = "";
		$data['user_id'] = $user_id;
		
		$parts_list = [];
		if (isset($_POST['game_account_id_text']) || isset($_POST['nickname_text']))
		{
			$user_id = $this->input->post('game_account_id_text', TRUE);
			$nickname = $this->input->post('nickname_text', TRUE);
			
			if ($nickname != "")
			{
				$user_id = $this->user_info_m->get_user_id_with_nickname($nickname);
			}
			
			$_parts_list = $this->user_items_m->get_list($user_id);
			$parts_list = $this->make_load_data($_parts_list);
		}
		$data['parts_list'] = $parts_list;
		
		$this->load->view('/user_info/parts_v', $data);
	}
	
	public function make_load_data($_parts_list)
	{
		$parts_list = [];
		for ($i = 0; $i < count($_parts_list); $i++)
		{
			$data = (array)$_parts_list[$i];
			$parts_list[$i]['user_id'] = $data['user_id'];
			$parts_list[$i]['class'] = "";
			$parts_list[$i]['item_code'] = $data['item_code'];
			$parts_list[$i]['count'] = $data['count'];
		}
		
		return $parts_list;
	}
}