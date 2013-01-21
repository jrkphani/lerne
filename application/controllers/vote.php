<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vote extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 public function __construct(){
	parent::__construct();
	$this->is_logged_in();
	}

	function is_logged_in(){
	$is_logged_in = $this->session->userdata('logged_in');
	if(!isset($is_logged_in) || $is_logged_in != TRUE){
		$data['body_content'] = 'unauth_error_view';
		$this->load->helper('url');
		$this->load->view('template', $data);
		exit;
		}
	}
	public function add(){
		$this->load->model('user_model');
		$user_details = $this->user_model->get_user_detail();
		
		$this->load->model('vote_model','',TRUE);
		$vote = 0;
        if($_POST['voteup']){
            $vote = 1;
        }else{
            $vote = -1;
        }
		$params = array(
			'votes'=>$vote,
			'componentid'=>$_POST['questionid'],
			'creator'=>$user_details['id'],
			'type' => $_POST['type'],
			'created'=>time(),
		);	
		$res=array();
		if($this->vote_model->add($params)){
			/* Author - Mani
			 * to get vote counts
			 */
			//$res=$this->vote_model->countVotes($params);
			$res['success'] = true;
		}else{
			$res['success'] = false;
		}		
		$this->load->view('json',array('resultset'=>$res));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
