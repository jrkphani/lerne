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
	function add($params){
		return $this->db->insert('questions',$params);
	}
	function getUserQuestions($params){
		$userid = $params['userid'];
		$userQuestions = $this->db->get_where('questions',array('creator'=>$userid));
		return $userQuestions->result();
	}
	function getInfo($params){
		$qid = $params['qid'];
		$this->db->where('id',$qid);
		$rs = $this->db->get('questions');
		return $rs->result();
	}
}
?>
