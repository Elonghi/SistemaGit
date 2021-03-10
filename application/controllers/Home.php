<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('form');
		date_default_timezone_set('America/Sao_Paulo');
	}
	function index(){
		redirect('Login');
	}
	function dashboard(){
		$this->load->view('home');

	}
}
