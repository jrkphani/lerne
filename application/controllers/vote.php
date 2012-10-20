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
	public function add(){
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
			'type' => $_POST['type'],
			'creator'=>'1',
			'created'=>time(),
		);	
		$res;
		if($this->vote_model->add($params)){
			$res = true;
		}else{
			$res = false;
		}		
		$this->load->view('json',array('resultset'=>$res));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
