<?php
class Question_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }
	function search($params){
#		$subject  = $params['subject'];
#		$rs = $this->all(array('conditions' => "subject LIKE '%$subject%'"));
#		return $rs;
		$this->db->like('subject',$params['subject']);
		$query = $this->db->get('questions');
		return $query->result();
	}
}
?>
