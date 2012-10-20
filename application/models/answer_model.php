<?php
class Answer_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }
	function search($params){
		$this->db->like('question_id',$params['qid']);
		$query = $this->db->get('answers');
		return $query->result();
	}
	function add($params){
		return $this->db->insert('answers',$params);
	}
    function getUserAnswers($params){
        $userid = $params['userid'];
        $userAnswers = $this->db->get_where('answers',array('creator'=>$userid));
        return $userAnswers->result();
    }
	function getUserQuestionAnswers($params){
		$qids = $params['qids'];
		$aftercreated = $params['lastlogin'];
		$this->db->where_in('question_id',$qids);
		$this->db->where('created >=',$aftercreated);
		$userAnswers = $this->db->get('answers');
		return $userAnswers->result();
	}
}
?>
