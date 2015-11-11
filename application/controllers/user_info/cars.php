<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cars extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('gamedb');
		$this->load->model('user_info_m');
		$this->load->model('user_inven_m');
		$this->load->model('user_supporters_m');
		$this->load->model('log_cstool_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		print "Cars index()";
		$this->load_car_list();
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
		$this->load->view('/user_info/cars_popup_v');
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_car_list()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		// $target_car['user_id'] = "";
		// $target_car['model_id'] = "";
		// $target_car['class'] = "";
		// $target_car['speed'] = "";
		// $target_car['accel'] = "";
		// $target_car['booster_charge'] = "";
		// $target_car['booster_power'] = "";
		// $target_car['upgrade'] = "";
		// $target_car['exp'] = "";
		// $target_car['point'] = "";
		// $target_car['atk'] = "";
		// $target_car['def'] = "";
		// $target_car['aero'] = "";
		// $target_car['decal'] = "";
		// $target_car['color'] = "";
		// $data['target_car'] = $target_car;
		
		$user_id = "";
		$user_id = $this->uri->segment(4, -1);
		
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
				
				// $user_id = $this->user_info_m->get_user_id_with_pid($pid);
			// }
		}
		if ($user_id != '-1' && $user_id != '')
		{
			$data['user_id'] = $user_id;
		}
		$_car_list = $this->user_inven_m->get_list($user_id);
		$car_list = $this->make_load_data($_car_list);
		$data['car_list'] = $car_list;
		
		// $target_sup['user_id'] = "";
		// $target_sup['model_id'] = "";
		// $target_sup['ability'] = "";
		// $target_sup['count'] = "";
		// $data['target_sup'] = $target_sup;
		
		$_sup_list = $this->user_supporters_m->get_list($user_id);
		$sup_list = $this->make_load_sup_data($_sup_list);
		$data['sup_list'] = $sup_list;
		
		$this->load->view('/user_info/cars_v', $data);
	}
	
	public function make_load_data($_car_list)
	{
		$car_list = array();
		for ($i = 0; $i < count($_car_list); $i++)
		{
			$car_list[$i]['user_id'] = $_car_list[$i]->user_id;
			$car_list[$i]['model_id'] = $_car_list[$i]->model_id;
			$car_list[$i]['class'] = "";
			$car_list[$i]['speed'] = $_car_list[$i]->up_0;
			$car_list[$i]['accel'] = $_car_list[$i]->up_1;
			$car_list[$i]['booster_charge'] = $_car_list[$i]->up_3;
			$car_list[$i]['booster_power'] = $_car_list[$i]->up_2;
			$car_list[$i]['upgrade'] = $_car_list[$i]->upgrade;
			$car_list[$i]['exp'] = $_car_list[$i]->exp;
			$car_list[$i]['point'] = $_car_list[$i]->point;
			$car_list[$i]['atk'] = $_car_list[$i]->gr_0;
			$car_list[$i]['def'] = $_car_list[$i]->gr_1;
			$car_list[$i]['aero'] = $_car_list[$i]->gr_2;
			$car_list[$i]['decal'] = $_car_list[$i]->sel_skin;
			$car_list[$i]['color'] = $_car_list[$i]->sel_color;
		}
		return $car_list;
	}
	
	public function make_load_sup_data($_sup_list)
	{
		$sup_list = array();
		for ($i = 0; $i < count($_sup_list); $i++)
		{
			$sup_list[$i]['user_id'] = $_sup_list[$i]->user_id;
			$sup_list[$i]['model_id'] = $_sup_list[$i]->model_id;
			$sup_list[$i]['ability'] = "";
			$sup_list[$i]['count'] = $_sup_list[$i]->count;
		}
		return $sup_list;
	}
	
	public function click_modify_button()
	{
		$this->output->enable_profiler(TRUE);
		
		if (isset($_POST['modify_car']))
		{
			$target_car['user_id'] = $this->input->post('user_id', TRUE);
			$target_car['model_id'] = $this->input->post('model_id', TRUE);
			$target_car['class'] = $this->input->post('class', TRUE);
			$target_car['speed'] = $this->input->post('speed', TRUE);
			$target_car['accel'] = $this->input->post('accel', TRUE);
			$target_car['booster_charge'] = $this->input->post('booster_charge', TRUE);
			$target_car['booster_power'] = $this->input->post('booster_power', TRUE);
			$target_car['upgrade'] = $this->input->post('upgrade', TRUE);
			$target_car['exp'] = $this->input->post('exp', TRUE);
			$target_car['point'] = $this->input->post('point', TRUE);
			$target_car['atk'] = $this->input->post('atk', TRUE);
			$target_car['def'] = $this->input->post('def', TRUE);
			$target_car['aero'] = $this->input->post('aero', TRUE);
			$target_car['decal'] = $this->input->post('decal', TRUE);
			$target_car['color'] = $this->input->post('color', TRUE);
			$data['target_car'] = $target_car;
			
			$_car_list = $this->user_inven_m->get_list($target_car['user_id']);
			$car_list = $this->make_load_data($_car_list);
			$data['car_list'] = $car_list;			
			
			// $target_sup['user_id'] = "";
			// $target_sup['model_id'] = "";
			// $target_sup['ability'] = "";
			// $target_sup['count'] = "";
			// $data['target_sup'] = $target_sup;
			
			$_sup_list = $this->user_supporters_m->get_list($target_car['user_id']);
			$sup_list = $this->make_load_sup_data($_sup_list);
			$data['sup_list'] = $sup_list;
			
			$data['user_id'] = $target_car['user_id'];
			
			$this->load->view('/user_info/cars_v', $data);
		}
	}
	
	public function modify_car()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if ($_POST)
		{
			$user_id = $this->input->post('user_id_text', TRUE);
			$model_id = $this->input->post('model_id_text', TRUE);
			$class = $this->input->post('class_text', TRUE);
			$speed = $this->input->post('speed_text', TRUE);
			$accel = $this->input->post('accel_text', TRUE);
			$booster_charge = $this->input->post('booster_charge_text', TRUE);
			$booster_power = $this->input->post('booster_power_text', TRUE);
			$upgrade = $this->input->post('upgrade_text', TRUE);
			$exp = $this->input->post('exp_text', TRUE);
			$point = $this->input->post('point_text', TRUE);
			$atk = $this->input->post('atk_text', TRUE);
			$def = $this->input->post('def_text', TRUE);
			$aero = $this->input->post('aero_text', TRUE);
			$decal = $this->input->post('decal_text', TRUE);
			$color = $this->input->post('color_text', TRUE);
			
			$return = $this->user_inven_m->modify_car($user_id, $model_id, $speed, $accel, $booster_charge, $booster_power, $upgrade, $exp, $point, $atk, $def, $aero, $decal, $color);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '차량 정보 수정';
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $model_id, $item_count, $memo);
				
				alert('차량 정보 변경이 완료 되었습니다.', '/user_info/cars/load_car_list/'. $user_id);
			}
		}
		
		// $target_car['user_id'] = "";
		// $target_car['model_id'] = "";
		// $target_car['class'] = "";
		// $target_car['speed'] = "";
		// $target_car['accel'] = "";
		// $target_car['booster_charge'] = "";
		// $target_car['booster_power'] = "";
		// $target_car['upgrade'] = "";
		// $target_car['exp'] = "";
		// $target_car['point'] = "";
		// $target_car['decal'] = "";
		// $target_car['color'] = "";
		// $data['target_car'] = $target_car;
		
		// $_car_list = $this->user_inven_m->get_list($user_id);
		// $car_list = $this->make_load_data($_car_list);
		// $data['car_list'] = $car_list;
		
		// $target_sup['user_id'] = "";
		// $target_sup['model_id'] = "";
		// $target_sup['ability'] = "";
		// $target_sup['count'] = "";
		// $data['target_sup'] = $target_sup;
		
		// $_sup_list = $this->user_supporters_m->get_list($user_id);
		// $sup_list = $this->make_load_sup_data($_sup_list);
		// $data['sup_list'] = $sup_list;
		
		// $this->load->view('/user_info/cars_v', $data);
	}
	
	public function delete_car()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if ($_POST)
		{
			$user_id = $this->input->post('delete_car_user_id_text', TRUE);
			$model_id = $this->input->post('delete_car_model_id_text', TRUE);
			
			$return = $this->user_inven_m->delete_car($user_id, $model_id);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '차량 삭제';
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $model_id, $item_count, $memo);
				
				alert('차량 삭제가 완료 되었습니다.', '/user_info/cars/load_car_list/'. $user_id);
			}
		}
	}
	
	public function add_car()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if ($_POST)
		{
			$user_id = $this->input->post('user_id_text', TRUE);
			$model_id = $this->input->post('model_id_text', TRUE);
			$class = $this->input->post('class_text', TRUE);
			$speed = $this->input->post('speed_text', TRUE);
			$accel = $this->input->post('accel_text', TRUE);
			$booster_charge = $this->input->post('booster_charge_text', TRUE);
			$booster_power = $this->input->post('booster_power_text', TRUE);
			$upgrade = $this->input->post('upgrade_text', TRUE);
			$exp = $this->input->post('exp_text', TRUE);
			$point = $this->input->post('point_text', TRUE);
			$atk = $this->input->post('atk_text', TRUE);
			$def = $this->input->post('def_text', TRUE);
			$aero = $this->input->post('aero_text', TRUE);
			$decal = $this->input->post('decal_text', TRUE);
			$color = $this->input->post('color_text', TRUE);
			
			$return = $this->user_inven_m->insert_car($user_id, $model_id, $speed, $accel, $booster_charge, $booster_power, $upgrade, $exp, $point, $atk, $def, $aero, $decal, $color);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '차량 지급';
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $model_id, $item_count, $memo);
				
				alert('차량 지급이 완료 되었습니다.', '/user_info/cars/load_car_list/'. $user_id);
			}
		}
	}
	
	public function click_modify_sup_button()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if (isset($_POST))
		{
			$target_sup['user_id'] = $this->input->post('user_id', TRUE);
			$target_sup['model_id'] = $this->input->post('model_id', TRUE);
			$target_sup['ability'] = $this->input->post('ability', TRUE);
			$target_sup['count'] = $this->input->post('count', TRUE);
			$data['target_sup'] = $target_sup;
			
			$_car_list = $this->user_inven_m->get_list($target_sup['user_id']);
			$car_list = $this->make_load_data($_car_list);
			$data['car_list'] = $car_list;
			
			$_sup_list = $this->user_supporters_m->get_list($target_sup['user_id']);
			$sup_list = $this->make_load_sup_data($_sup_list);
			$data['sup_list'] = $sup_list;
			
			$data['user_id'] = $target_sup['user_id'];
			
			$this->load->view('/user_info/cars_v', $data);
		}		
	}
	
	public function modify_sup()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if ($_POST)
		{
			$user_id = $this->input->post('user_id_text', TRUE);
			$model_id = $this->input->post('model_id_text', TRUE);
			$count = $this->input->post('count_text', TRUE);
			$return = $this->user_supporters_m->modify_sup($user_id, $model_id, $count);
			
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '보유 서포터 정보 수정';
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $model_id, $item_count, $memo);
				
				alert('서포터 정보 변경이 완료 되었습니다.', '/user_info/cars/load_car_list/'. $user_id);
			}
		}
	}
	
	public function delete_sup()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if ($_POST)
		{
			$user_id = $this->input->post('delete_sup_user_id_text', TRUE);
			$model_id = $this->input->post('delete_sup_model_id_text', TRUE);
			
			$return = $this->user_supporters_m->delete_sup($user_id, $model_id);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '보유 서포터 삭제';
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $model_id, $item_count, $memo);
				
				alert('서포터 삭제가 완료 되었습니다.', '/user_info/cars/load_car_list/'. $user_id);
			}
		}
	}
	
	public function add_sup()
	{
		$this->output->enable_profiler(TRUE);
		
		if (@$this->session->userdata('logged_in') != TRUE)
		{
			alert('로그인 후 사용 가능합니다.', '/auth');
			exit;
		}
		$admin_name = $this->session->userdata('username');
		
		if ($_POST)
		{
			$user_id = $this->input->post('user_id_text', TRUE);
			$model_id = $this->input->post('model_id_text', TRUE);
			
			$return = $this->user_supporters_m->insert_sup($user_id, $model_id);
			if ($return)
			{
				$time = time();
				$date_string = "Y-m-d H:i:s";
				$reg_date = date($date_string, $time);
				$ip_address = $_SERVER['REMOTE_ADDR'];
				$action = '보유 서포터 추가';
				$item_id = NULL;
				$item_count = NULL;
				$memo = '';
				$this->log_cstool_m->insert_log($reg_date, $ip_address, $admin_name, $user_id, $action, $model_id, $item_count, $memo);
				
				alert('서포터 추가가 완료 되었습니다.', '/user_info/cars/load_car_list/'. $user_id);
			}
		}
	}
}