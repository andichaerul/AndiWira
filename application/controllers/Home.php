<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('connect');
		$this->load->library('cart');
	}

	public function index()
	{
		$this->load->view('head');
		$this->load->view('index');
	}
	public function found_point()
	{
		$data['found_point'] = $this->connect->found_point();
		$this->load->view('head');
		$this->load->view('found_point',$data);

	}

}