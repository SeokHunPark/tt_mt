<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banned_word extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('globaldb');
		$this->load->model('banned_words_m');
		$this->load->model('log_cstool_m');
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
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if (isset($_POST['reg_button']))
		{	
			$word_reg_text = $this->input->post('word_reg_text');
			if ($word_reg_text == "")
			{
				alert_only("입력하십시오.");
				return;
			}
			
			$banned_words = $this->banned_words_m->find_word($word_reg_text);
			if (count($banned_words) > 0)
			{
				alert('이미 등록된 금칙어 입니다.', '/banned_word');
			}
			
			$return = $this->banned_words_m->insert_word($word_reg_text);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$user_id = NULL;
				$action = '금칙어 등록';
				$item_id = NULL;
				$item_count = NULL;
				$memo = $word_reg_text;
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				
				alert('금칙어가 등록 되었습니다.', '/banned_word');
			}
			
			#redirect('/banned_word/index', 'refresh');
			#$data['word_list'] = $data['word_list'] = $this->banned_words_m->get_word_list();
			#$this->load->view('banned_word/banned_word_v', $data);
		}
	}
	
	public function delete_word()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if (isset($_POST['delete_button']))
		{	
			$word_index = $this->input->post('word_index');
			$return = $this->banned_words_m->delete_word($word_index);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$user_id = NULL;
				$action = '금칙어 삭제';
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_id, $item_count, $memo);
				
				alert('금칙어가 삭제 되었습니다.', '/banned_word');
			}
			
			#redirect('/banned_word/index', 'refresh');
			#$data['word_list'] = $data['word_list'] = $this->banned_words_m->get_word_list();
			#$this->load->view('banned_word/banned_word_v', $data);
		}
	}
}