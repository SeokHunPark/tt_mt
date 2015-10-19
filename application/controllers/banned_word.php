<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banned_word extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('globaldb');
		$this->load->model('banned_words_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		$this->load_banned_word_list();
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
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_banned_word_list()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
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
			$data['word_list'] = $data['word_list'] = $this->banned_words_m->get_word_list();
			$this->load->view('banned_word/banned_word_v', $data);
		}
	}
	
	public function reg_word()
	{
		$this->output->enable_profiler(TRUE);
		
		print_R($_POST);
		
		if (isset($_POST['reg_button']))
		{	
			$word_reg_text = $this->input->post('word_reg_text');
			if ($word_reg_text == "")
			{
				alert_only("입력하십시오.");
				return;
			}
			
			$this->banned_words_m->insert_word($word_reg_text);
			
			redirect('/banned_word/index', 'refresh');
			#$data['word_list'] = $data['word_list'] = $this->banned_words_m->get_word_list();
			#$this->load->view('banned_word/banned_word_v', $data);
		}
	}
	
	public function delete_word()
	{
		$this->output->enable_profiler(TRUE);
		
		print_R($_POST);
		
		if (isset($_POST['delete_button']))
		{	
			$word_index = $this->input->post('word_index');
			$this->banned_words_m->delete_word($word_index);
			
			redirect('/banned_word/index', 'refresh');
			#$data['word_list'] = $data['word_list'] = $this->banned_words_m->get_word_list();
			#$this->load->view('banned_word/banned_word_v', $data);
		}
	}
}