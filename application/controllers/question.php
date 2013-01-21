<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends CI_Controller {

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
	public function get($subject)
	{
		ini_set('display_errors','0');
		$res = array();
		$this->load->model('question_model','',TRUE);
		$this->load->model('user_model');
		$user_details = $this->user_model->get_user_detail();
		$params = array('subject'=>$subject);
#		$res['resultset'] = $this->question_model->search($params);
		$res['resultset'] = array();
		$rs_obj = $this->question_model->search($params);
		$resultset = array();
		$this->load->model('answer_model','',TRUE);
		$this->load->model('vote_model','',TRUE);
		foreach($rs_obj as $result){
			$ans_params = array('qid'=>$result->id);
			$ans_count = count($this->answer_model->search($ans_params));
			$result->answer_count = $ans_count;

			$vote_params = array('componentid'=>$result->id,'type'=>'question');
			$vote_count = $this->vote_model->countVotes($vote_params);
			$result->votecountup = $vote_count['votecountup'];
			$result->votecountdown = $vote_count['votecountdown'];

			$vote_user_params = array('componentid'=>$result->id,'userid'=>$user_details['id'],'type'=>'question');
			$vote_user = $this->vote_model->getVote($vote_user_params);
			$result->votetype = 0;
			$result->voted = 0;
			if($vote_user){
				$result->voted = 1;
				$result->votetype = $vote_user[0]->votes;
			}

			array_push($res['resultset'],$result);
		}
		$this->load->view('json',$res);
	}
	public function add(){
		$this->load->model('question_model','',TRUE);
		$params = array(
			'question_text'=>$_POST['text'],
			'subject'=>$_POST['subject'],
			'creator'=>'1',
			'created'=>time(),
			'tags' => '',
		);	
		$res;
		if($this->question_model->add($params)){
			$res = true;
		}else{
			$res = false;
		}		
		$this->load->view('json',array('resultset'=>$res));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
