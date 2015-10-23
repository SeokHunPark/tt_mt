<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parts extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('gamedb');
		$this->load->model('user_info_m');
		$this->load->model('user_items_m');
		$this->load->model('log_cstool_m');
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
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		$target_parts['user_id'] = "";
		$target_parts['item_code'] = "";
		$target_parts['class'] = "";
		$target_parts['count'] = "";
		$data['target_parts'] = $target_parts;
		
		$user_id = "";
		$user_id = $this->uri->segment(4, -1);
		$data['user_id'] = $user_id;
		$parts_list = array();
		if (isset($_POST['game_account_id_text']) || isset($_POST['nickname_text']) || isset($_POST['kakao_id_text']))
		{
			$user_id = $this->input->post('game_account_id_text', TRUE);
			$nickname = $this->input->post('nickname_text', TRUE);
			$kakao_id = $this->input->post('kakao_id_text', TRUE);
			
			if ($nickname != "")
			{
				$user_id = $this->user_info_m->get_user_id_with_nickname($nickname);
			}
			// else if ($kakao_id != '')
			// {
				// $sql = "select `drag_gamedb`.`usf_secure_data`('E', 'K', ?) as pid;";
				// $query = $this->db->query($sql, ($kakao_id));
				// $result = $query->result();
				// $pid = $result[0]->pid;
				
				// print $kakao_id;
				
				// $user_id = $this->user_info_m->get_user_id_with_pid($pid);
			// }
			
			$_parts_list = $this->user_items_m->get_list($user_id);
			$parts_list = $this->make_load_data($_parts_list);
		}
		$data['user_id'] = $user_id;
		$data['parts_list'] = $parts_list;
		
		$this->load->view('/user_info/parts_v', $data);
	}
	
	public function make_load_data($_parts_list)
	{
		$parts_list = array();
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
	
	public function click_modify_button()
	{
		$user_id = $this->input->post('user_id', TRUE);
		$item_code = $this->input->post('item_code', TRUE);
		$class = $this->input->post('class', TRUE);
		$count = $this->input->post('count', TRUE);
		
		$target_parts['user_id'] = $user_id;
		$target_parts['item_code'] = $item_code;
		$target_parts['class'] = $class;
		$target_parts['count'] = $count;
		$data['target_parts'] = $target_parts;
		
		$_parts_list = $this->user_items_m->get_list($user_id);
		$parts_list = $this->make_load_data($_parts_list);
		
		$data['user_id'] = $user_id;
		$data['parts_list'] = $parts_list;
		
		$this->load->view('/user_info/parts_v', $data);
	}
	
	public function modify_parts()
	{
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		$target_parts['user_id'] = "";
		$target_parts['item_code'] = "";
		$target_parts['class'] = "";
		$target_parts['count'] = "";
		$data['target_parts'] = $target_parts;
		
		$user_id = $this->input->post('user_id_text', TRUE);
		$data['user_id'] = $user_id;
		
		$item_code = $this->input->post('item_code_text', TRUE);
		$count = $this->input->post('count_text', TRUE);
		$return = $this->user_items_m->modify_parts($user_id, $item_code, $count);
		if ($return)
		{
			$time = time();
			$date_string = "Y-m-d H:i:s";
			$reg_date = date($date_string, $time);
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$action = '부품 카드 수정';
			$item_count = NULL;
			$memo = '';
			$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $item_code, $item_count, $memo);
			
			alert('부품 카드 수정이 완료 되었습니다.', '/user_info/parts/load_parts_list/'. $user_id);
		}
		
		// $_parts_list = $this->user_items_m->get_list($user_id);
		// $parts_list = $this->make_load_data($_parts_list);
		// $data['parts_list'] = $parts_list;
		
		// $this->load->view('/user_info/parts_v', $data);
	}
}