<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('globaldb');
		$this->load->model('shop_package_m');
		$this->load->helper(array('url', 'date', 'alert_helper'));
	}
	
	public function index()
	{
		$this->load_current_package();
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
		
		// package include.
		//$this->load->view('game_management/popup_market_popup_v');
		
		// footer include.
		$this->load->view('footer_v');
	}
	
	public function load_current_package()
	{
		$target_package['package_no'] = "";
		$target_package['price'] = "";
		$target_package['image_url'] = "";
		$target_package['gold'] = "";
		$target_package['gas'] = "";
		$target_package['coin'] = "";
		$target_package['item1'] = "";
		$target_package['item2'] = "";
		$target_package['item3'] = "";
		$target_package['item4'] = "";
		$target_package['item5'] = "";
		$data['target_package'] = $target_package;
		
		$data['package_list'] = $this->get_package_list();
		$this->load->view('game_management/package_v', $data);
	}
	
	public function modify_package()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$target_package['package_no'] = $this->input->post('package_no', TRUE);
			$target_package['price'] = $this->input->post('price', TRUE);
			$target_package['image_url'] = $this->input->post('image_url', TRUE);
			$target_package['gold'] = $this->input->post('gold', TRUE);
			$target_package['gas'] = $this->input->post('gas', TRUE);
			$target_package['coin'] = $this->input->post('coin', TRUE);
			$target_package['item1'] = $this->input->post('item1', TRUE);
			$target_package['item2'] = $this->input->post('item2', TRUE);
			$target_package['item3'] = $this->input->post('item3', TRUE);
			$target_package['item4'] = $this->input->post('item4', TRUE);
			$target_package['item5'] = $this->input->post('item5', TRUE);
			$data['target_package'] = $target_package;
			#print_r($target_package);
			
			$package_list = $this->get_package_list();
			$data['package_list'] = $package_list;
			$this->load->view('game_management/package_v', $data);
		}
	}
	
	public function get_package_list()
	{
		$_package_list = $this->shop_package_m->get_package_list();
		$package_list = [];
		for ($i = 0; $i < count($_package_list); $i++)
		{
			$package_list[$i]['package_no'] = $_package_list[$i]->package_no;
			$package_list[$i]['price'] = $_package_list[$i]->price;
			$package_list[$i]['image_url'] = $_package_list[$i]->image_url;
			$package_list[$i]['gold'] = $_package_list[$i]->gold;
			$package_list[$i]['gas'] = $_package_list[$i]->gas;
			$package_list[$i]['coin'] = $_package_list[$i]->coin;
			$package_list[$i]['item_string'] = $_package_list[$i]->item_string;
			$item_string = $_package_list[$i]->item_string;
			
			#$item_string = preg_replace("/\s+/", "", $item_string);
			$item_list = explode(',', $item_string);
			for ($j = 1; $j <= 5; $j++)
			{
				$key = 'item' . $j;
				$package_list[$i][$key] = "";
			}
			for ($j = 1; $j <= count($item_list); $j++)
			{
				$key = 'item' . $j;
				$package_list[$i][$key] = $item_list[$j - 1];
			}
		}
		return $package_list;
	}
	
	public function save_package()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$package_no = $this->input->post('package_no_new_text', TRUE);
			$price = $this->input->post('price_new_text', TRUE);
			$image_url = $this->input->post('image_url_new_text', TRUE);
			$gold = $this->input->post('gold_new_text', TRUE);
			$gas = $this->input->post('gas_new_text', TRUE);
			$coin = $this->input->post('coin_new_text', TRUE);
			$item1 = $this->input->post('item1_new_text', TRUE);
			$item2 = $this->input->post('item2_new_text', TRUE);
			$item3 = $this->input->post('item3_new_text', TRUE);
			$item4 = $this->input->post('item4_new_text', TRUE);
			$item5 = $this->input->post('item5_new_text', TRUE);
			$item_string = $item1 . $item2 . $item3 . $item4 . $item5;
			
			$this->shop_package_m->save_package($package_no, $price, $image_url, $gold, $gas, $coin, $item_string);
			
			$this->index();
			#redirect('/game_management/package/index', 'refresh');
		}
	}
	
	public function add_package()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$price = $this->input->post('price_text', TRUE);
			$image_url = $this->input->post('image_url_text', TRUE);
			$gold = $this->input->post('gold_text', TRUE);
			$gas = $this->input->post('gas_text', TRUE);
			$coin = $this->input->post('coin_text', TRUE);
			$item1 = $this->input->post('item1_text', TRUE);
			$item2 = $this->input->post('item2_text', TRUE);
			$item3 = $this->input->post('item3_text', TRUE);
			$item4 = $this->input->post('item4_text', TRUE);
			$item5 = $this->input->post('item5_text', TRUE);
			$item_string = $item1 . $item2 . $item3 . $item4 . $item5;
			
			$this->shop_package_m->add_package($price, $image_url, $gold, $gas, $coin, $item_string);
			
			$this->index();
		}
	}
}