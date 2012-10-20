<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
  }

  function index()
  {
    if($this->session->userdata('logged_in'))
    {
      $session_data = $this->session->userdata('logged_in');
      $data['email'] = $session_data['email'];
      $data['firstname'] = $session_data['firstname'];
	  $data['subject_list'] = array('math'=>'Math',
        'chemistry'=>'Chemistry',
        'physics'=>'Physics',
        'technology'=>'Technology',
        'computerProgramming'=>'Computer Programming'
		);
      $this->load->view('header_view', $data);
      $this->load->view('home_view', $data);
      $this->load->view('footer_view', $data);
    }
    else
    {
      //If no session, redirect to login page
      redirect('login', 'refresh');
	}
  }
  
  function logout()
  {
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect('home', 'refresh');
  }
	function notifications(){
		$this->load->model('question_model','',TRUE);
		$this->load->model('answer_model','',TRUE);
        //get all answers posted since last login
		$rs_user_questions_params = array('userid'=>1);
        $rs_user_questions = $this->question_model->getUserQuestions($rs_user_questions_params);
        $qids = array();
        foreach($rs_user_questions as $result){
            array_push($qids,$result->id);
		}
		$userLastLoggedin = 0;
#		if($this->session->userdata['logged_in']['lastlogin'])
#			$userLastLoggedin = $this->session->userdata['logged_in']['lastlogin'];
        $notificationArr = array();
		$rs_user_ques_ans_params = array('qids'=>$qids,'lastlogin'=>$userLastLoggedin);
        $rs_user_ques_ans = $this->answer_model->getUserQuestionAnswers($rs_user_ques_ans_params);
        foreach($rs_user_ques_ans as $result){
			$quesInfo = $this->question_model->getInfo(array('qid'=>$result->question_id));
			$result->questioninfo = $quesInfo[0];
            array_push($notificationArr,$result);
        }
		$res['resultset']['newanswers'] = $notificationArr;
		
        $rs_user_answers = $this->answer_model->getUserAnswers($rs_user_questions_params);
        $ansqids = array();
        foreach($rs_user_answers as $result){
            array_push($ansqids,$result->question_id);
		}
        $notificationArr = array();
		$rs_user_ans_params = array('qids'=>$ansqids,'lastlogin'=>$userLastLoggedin);
        $rs_user_ques_ans = $this->answer_model->getUserQuestionAnswers($rs_user_ans_params);
        foreach($rs_user_ques_ans as $result){
			$quesInfo = $this->question_model->getInfo(array('qid'=>$result->question_id));
			$result->questioninfo = $quesInfo[0];
            array_push($notificationArr,$result);
        }

		$res['resultset']['morenewanswers'] = $notificationArr;
		$this->load->view('json',$res);
	}
}

?>
