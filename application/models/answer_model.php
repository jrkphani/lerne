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
}
?>
