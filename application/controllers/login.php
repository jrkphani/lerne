<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->helper('form');
    $this->load->helper('url');
  }

  function index()
  {
  	if($this->session->userdata('logged_in')){
  		redirect('home', 'refresh');
  	}
    $this->load->view('login_view');
  }

}

?>