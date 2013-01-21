<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Answer extends CI_Controller {

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
	$is_logged_in = $this->session->userdata('is_logged_in');
	if(!isset($is_logged_in) || $is_logged_in != TRUE){
		//$data['body_content'] = 'unauth_error_view';
		//$this->load->view('template', $data);
		//exit;
		}
	}
	public function get($qid){
		$res = array();
		$res['resultset']['voted']=0;
		$this->load->model('answer_model','',TRUE);
		$params = array('qid'=>$qid);
		$resultset = $this->answer_model->search($params,'answer');
		$this->load->model('user_model');
		$user_details = $this->user_model->get_user_detail();
		$this->load->model('vote_model','',TRUE);
		foreach($resultset as $result)
		{
			$vote_user_params = array('componentid'=>$result->id,'userid'=>$user_details['id'],'type'=>'answer');
			$vote_user = $this->vote_model->getVote($vote_user_params);
			if($vote_user)
			{
				$res['resultset']['voted']=1;
				$res['resultset']['voted_id']=$result->id;
				$res['resultset']['votetype'] = $vote_user[0]->votes;
				break;
			}		
		}
		$res['resultset']['data']=$resultset;
		$this->load->view('json',$res);
	}
	public function add(){
		$this->load->model('answer_model','',TRUE);
        $params = array(
            'answer_text'=>$_POST['text'],
            'question_id'=>$_POST['questionid'],
            'creator'=>'1',
            'created'=>time(),
            'votes' => '0',
        );
        $res;
        if($this->answer_model->add($params)){
            $res = true;
        }else{
            $res = false;
        }
        $this->load->view('json',array('resultset'=>$res));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
