<?php
class Answer_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }
	function search($params){
		$this->db->like('question_id',$params['qid']);
		/* Author mani
		 * to get the voteup and votedown counts
		 */
		$this->db->select("answers.*,(SELECT SUM(votes.votes) FROM votes WHERE votes.componentid=answers.id AND votes.votes>0) AS votecountup,(SELECT SUM(votes.votes) FROM votes WHERE votes.componentid=answers.id AND votes.votes<0) AS votecountdown");
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
