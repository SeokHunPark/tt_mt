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
		
		// popup include.
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
		
		$_package_list = $this->shop_package_m->get_package_list();
		foreach ($_package_list as $pkg)
		{
			
		}
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
			
			$item_string = preg_replace("/\s+/", "", $item_string);
			$item_list = explode(',', $item_string);
			for ($j = 0; $j < count($item_list); $j++)
			{
				$package_list[$i]['item' + $j] = $item_list[$j];
			}
		}
		#print_r($package_list);
		$data['package_list'] = $_package_list;
		$this->load->view('game_management/package_v', $data);
	}
	
	public function modify_promotion()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$target_promo['promotion_no'] = $this->input->post('promotion_no', TRUE);
			$target_promo['title'] = $this->input->post('title', TRUE);
			$target_promo['package'] = $this->input->post('package', TRUE);
			$target_promo['expose_int'] = $this->input->post('expose_int', TRUE);
			$target_promo['reexpose_buy'] = $this->input->post('reexpose_buy', TRUE);
			$target_promo['expose_limit'] = $this->input->post('expose_limit', TRUE);
			$target_promo['expose_prob'] = $this->input->post('expose_prob', TRUE);
			$data['target_promo'] = $target_promo;
			
			$promotion_list = $this->shop_package_m->get_promotion_list();
			$data['promotion_list'] = $promotion_list;
			$this->load->view('game_management/shop_package_m', $data);
		}
	}
	
	public function save_promotion()
	{
		$this->output->enable_profiler(TRUE);
		
		if ($_POST)
		{
			$promotion_no = $this->input->post('promotion_no_new_text', TRUE);
			$title = $this->input->post('title_new_text', TRUE);
			$package = $this->input->post('package_new_text', TRUE);
			$expose_int = $this->input->post('expose_int_new_text', TRUE);
			$reexpose_buy = $this->input->post('reexpose_buy_new_text', TRUE);
			$expose_limit = $this->input->post('expose_limit_new_text', TRUE);
			$expose_prob = $this->input->post('expose_prob_new_text', TRUE);
			
			$this->shop_package_m->save_promotion($promotion_no, $title, $package, $expose_int, $reexpose_buy, $expose_limit, $expose_prob);
			
			$this->index();
		}
	}
}