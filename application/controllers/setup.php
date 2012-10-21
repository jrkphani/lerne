<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Controller {

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
	public function index(){
		$data = '';
		$this->load->view('header_view', $data);
		$this->load->view('setup_view', $data);
		$this->load->view('footer_view', $data);
	}
	public function complete(){
		$domainname = $_POST['lr_setup_domain'];
		$confirmSetup = 'Sorry. There was an error. Please contact us at help@lerne.in.';
		if($domainname){
			$this->load->dbutil();
			if ($this->dbutil->database_exists($domainname)){
				$confirmSetup = "Sorry. Domain name already exists. Please enter a new domainname.";
			}
			$this->load->dbforge();
			if($this->dbforge->create_database($domainname)){
				$dbsql = BASEPATH.'db.sql';
				$fh = fopen($dbsql, 'r');
				$sqlString = fread($fh,filesize($dbsql));
				$query_arr = explode(';',$sqlString);
				$dbConfig = $this->config->config['db_saas'];
				$dbConfig['database'] = $domainname;
				$this->load->database($dbConfig,TRUE);
				foreach($query_arr as $qr){
					if($qr){
						$this->db->query($qr);
					}
				}
				$confirmSetup = "Congratulations! Setup is complete. Access your site at ";
			}
			else{
				echo "Error creating database: " . mysql_error();
				exit;
			}
		}
		echo $confirmSetup;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
