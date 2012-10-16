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
	public function get($qid){
		$res = array();
		$this->load->model('answer_model','',TRUE);
		$params = array('qid'=>$qid);
		$res['resultset'] = $this->answer_model->search($params);
		$this->load->view('json',$res);
	}
	public function add(){
		$this->load->model('answer_model','',TRUE);
        $params = array(
            'answer_text'=>'from CI',
            'question_id'=>'1',
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
