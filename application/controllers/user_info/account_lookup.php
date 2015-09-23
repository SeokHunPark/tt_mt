<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_lookup extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('globaldb');;
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		$this->load_account_info();
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
		#$this->load->view('banned_word_v');
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_account_info()
	{
		$this->output->enable_profiler(TRUE);
		
		if (isset($_POST['word_text']))
		{			
			$word = $this->input->post('word_text', TRUE);
			if ($this->uri->segment(3))
				$word = $this->uri->segment(3);
			
			$data['word_list'] = $this->banned_words_m->like_word($word);
		
			$this->load->view('banned_word/banned_word_v', $data);
		}
		else
		{
			$data = "";
			$this->load->view('user_info/account_lookup_v', $data);
		}
	}
}