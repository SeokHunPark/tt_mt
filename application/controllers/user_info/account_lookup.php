<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_lookup extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database('gamedb');
		$this->load->model('user_info_m');