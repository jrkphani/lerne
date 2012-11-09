<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
	}

	function index(){
		$this->load->view('register_view');

	}
}
?>