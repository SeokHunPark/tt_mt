<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database('gamedb');
		$this->load->model('user_info_m');
		$this->load->helper(array('url', 'date'));
	}
	
	public function index()
	{
		$this->load_main();
	}
	
	public function _remap($method)
	{
		// header include.
		$this->load->view('header_v');
		
		// nav include.
		$this->load->view('nav_v');
		
		// nav include.
		if (method_exists($this, $method))
		{
			$this->{"{$method}"}();
		}
		
		// popup include.
		$this->load->view('main_popup_v');
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_main()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			#print "POST Action!!!!";
			$page = $this->uri->segment(3);
			print "Segment : $page";
			
			$user_id = $this->input->post('user_id', TRUE);
			if ($this->uri->segment(3))
				$user_id = $this->uri->segment(3);
			
			$data['list'] = $this->user_info_m->find_user($user_id);
		
			$this->load->view('main_v', $data);
		}
		else
		{
			$data['list'] = $this->user_info_m->get_lists();
		
			$this->load->view('main_v', $data);
		}
	}
	
	public function update_user()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$user_id = $this->input->post('user_id_text', TRUE);
			$nickname = $this->input->post('nickname_text', TRUE);
			$gas = $this->input->post('gas_text', TRUE);
			$coin = $this->input->post('coin_text', TRUE);
			
			$this->user_info_m->update_user($user_id, $nickname, $gas, $coin);
		}
	}
	
	function find_user()
	{
		if ($_POST)
		{
			
		}
		else
		{
			$data['list'] = $this->user_info_m->get_lists();
			$this->load->view('main_v', $data);
		}
	}
	
	function view()
	{
		$id = $this->uri->segment(3);
		
		echo $id;
	}
}