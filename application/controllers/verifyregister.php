<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyRegister extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('user_model','',TRUE);
    $this->load->helper('url');
  }

  function index()
  {
    //This method will have the credentials validation
    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
    $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
    $this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required|xss_clean|is_unique[users.email]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
	
    if($this->form_validation->run() == FALSE)
    {
      //Field validation failed.  User redirected to register page
      $this->load->view('register_view');
    }
    else
    {
      //Go to Thank you page.
      $this->user_model->add_user();
      $this->thankyou();  
    }
    
  }
  public function thankyou()
 {
  $data['title']= 'Thank You';
  $this->load->view('header_view',$data);
  //$this->load->view('thankyou_view.php', $data);
  //$this->load->view('footer_view',$data);
 }
}