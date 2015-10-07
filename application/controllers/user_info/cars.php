<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cars extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('gamedb');
		$this->load->model('user_info_m');
		$this->load->model('user_inven_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
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
		#$this->load->view('/user_info/account_lookup_popup_v');
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_car_list()
	{
		$this->output->enable_profiler(TRUE);
		
		$target_car['user_id'] = "";
		$target_car['model_id'] = "";
		$target_car['class'] = "";
		$target_car['speed'] = "";
		$target_car['accel'] = "";
		$target_car['booster_charge'] = "";
		$target_car['booster_power'] = "";
		$target_car['upgrade'] = "";
		$target_car['evol'] = "";
		$target_car['decal'] = "";
		$target_car['color'] = "";
		$data['target_car'] = $target_car;
		
		$user_id = "";
		$car_list = [];
		if (isset($_POST))
		{
			if (isset($_POST['game_account_id_text']))
			{
				$user_id = $this->input->post('game_account_id_text', TRUE);
			}
			else if (isset($_POST['nickname_text']))
			{
				$user_id = $this->input->post('nickname_text', TRUE);
			}
			
			$_car_list = $this->user_inven_m->get_list($user_id);
			#print_r($_car_list);
			$car_list = $this->make_load_data($_car_list);
		}
		
		$data['user_id'] = $user_id;
		$data['car_list'] = $car_list;
		$this->load->view('/user_info/cars_v', $data);
	}
	
	public function make_load_data($_car_list)
	{
		$car_list = [];
		for ($i = 0; $i < count($_car_list); $i++)
		{
			$car_list[$i]['user_id'] = $_car_list[$i]->user_id;
			$car_list[$i]['model_id'] = $_car_list[$i]->model_id;
			$car_list[$i]['class'] = "";
			$car_list[$i]['speed'] = $_car_list[$i]->up_0;
			$car_list[$i]['accel'] = $_car_list[$i]->up_1;
			$car_list[$i]['booster_charge'] = $_car_list[$i]->up_2;
			$car_list[$i]['booster_power'] = $_car_list[$i]->up_3;
			$car_list[$i]['upgrade'] = "";
			$car_list[$i]['evol'] = "";
			$car_list[$i]['decal'] = $_car_list[$i]->sel_skin;
			$car_list[$i]['color'] = $_car_list[$i]->sel_color;
		}
		return $car_list;
	}
	
	public function click_modify_button()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$target_car['user_id'] = $this->input->post('user_id', TRUE);
			$target_car['model_id'] = $this->input->post('model_id', TRUE);
			$target_car['class'] = $this->input->post('class', TRUE);
			$target_car['speed'] = $this->input->post('speed', TRUE);
			$target_car['accel'] = $this->input->post('accel', TRUE);
			$target_car['booster_charge'] = $this->input->post('booster_charge', TRUE);
			$target_car['booster_power'] = $this->input->post('booster_power', TRUE);
			$target_car['upgrade'] = $this->input->post('upgrade', TRUE);
			$target_car['evol'] = $this->input->post('evol', TRUE);
			$target_car['decal'] = $this->input->post('decal', TRUE);
			$target_car['color'] = $this->input->post('color', TRUE);
			$data['target_car'] = $target_car;
			
			$_car_list = $this->user_inven_m->get_list($target_car['user_id']);
			$car_list = $this->make_load_data($_car_list);
			$data['car_list'] = $car_list;
			$this->load->view('/user_info/cars_v', $data);
		}
	}
	
	public function modify_car()
	{
		$this->output->enable_profiler(TRUE);
		
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
			$evol = $this->input->post('evol_text', TRUE);
			$decal = $this->input->post('decal_text', TRUE);
			$color = $this->input->post('color_text', TRUE);
			
			$this->user_inven_m->modify_car($user_id, $model_id, $speed, $accel, $booster_charge, $booster_power, $upgrade, $evol, $decal, $color);
			
			$target_car['user_id'] = "";
			$target_car['model_id'] = "";
			$target_car['class'] = "";
			$target_car['speed'] = "";
			$target_car['accel'] = "";
			$target_car['booster_charge'] = "";
			$target_car['booster_power'] = "";
			$target_car['upgrade'] = "";
			$target_car['evol'] = "";
			$target_car['decal'] = "";
			$target_car['color'] = "";
			$data['target_car'] = $target_car;
			
			$_car_list = $this->user_inven_m->get_list($user_id);
			$car_list = $this->make_load_data($_car_list);
			$data['car_list'] = $car_list;
			$this->load->view('/user_info/cars_v', $data);
		}
	}
}