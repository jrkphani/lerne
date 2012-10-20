<?php
class Vote_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }
	function countVotes($params){
		$id  = $params['componentid'];
		$type = $params['type'];
		$votecount_up = 0;
		$votecount_down = 0;
#		$rs_voteup = $this->db->find('all',array('select'=>'sum(votes) as votecount','conditions'=>array('votes > 0 AND componentid = ?',$id)));
		$returnArr = array();

		$this->db->select_sum('votes');
		$rs_up_votes = $this->db->get_where('votes', array('votes >'=>0,'componentid'=>$id));
		$votecountup = $rs_up_votes->result();
		$returnArr['votecountup'] = $votecountup[0]->votes;
		
		$this->db->select_sum('votes');
		$rs_down_votes = $this->db->get_where('votes', array('votes <'=>0,'componentid'=>$id));
		$votecountdown = $rs_down_votes->result();
		$returnArr['votecountdown'] = $votecountdown[0]->votes;
		return $returnArr;

	}
	function getVote($params){
		$id = $params['componentid'];
		$userid = $params['userid'];
		$type = $params['type'];
		$rs = $this->db->get_where('votes',array('componentid'=>$id,'creator'=>$userid,'type'=>$type));
		return $rs->result();
	}
	function add($params){
		return $this->db->insert('votes',$params);
	}
}
?>
