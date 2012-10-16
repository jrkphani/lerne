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
	public function get($subject)
	{
		$res = array();
		$this->load->model('question_model','',TRUE);
		$params = array('subject'=>$subject);
		$res['resultset'] = $this->question_model->search($params);
		$this->load->view('json',$res);
	//	echo 'hello world';
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
