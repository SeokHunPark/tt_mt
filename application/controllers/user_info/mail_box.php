<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail_box extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('gamedb');
		$this->load->model('mail_m');
		
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		$this->load_mail_box();
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
	
	public function load_mail_box()
	{
		$_mail_list = $this->mail_m->get_mail_list(0, 60);
		
		$this->load->library('pagination');
		
		$config['base_url'] = '/user_info/mail_box/load_mail_box/';
		$config['total_rows'] = count($_mail_list);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$page = $this->uri->segment(4, 0);
		print "Page : " . $page;
		$size = $config['per_page'];
		
		$_mail_list = $this->mail_m->get_mail_list($page, $size);
		
		for ($i = 0; $i < count($_mail_list); $i++)
		{
			$mail_list[$i]['mail_idx'] = $_mail_list[$i]->mail_idx;
			$mail_list[$i]['item_name'] = "";
			$mail_list[$i]['item_count'] = "";
			$mail_list[$i]['sender'] = "";
			$mail_list[$i]['description'] = "";
			$mail_list[$i]['reg_date'] = "";
			$mail_list[$i]['expire_date'] = "";
			$mail_list[$i]['recv_date'] = "";
			$mail_list[$i]['memo'] = "";
		}
		
		$data['mail_list'] = $mail_list;
		$this->load->view('/user_info/mail_box_v', $data);
	}
	
	public function get_mail_list($start, $size)
	{
		
	}
}