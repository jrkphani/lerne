<?php
class Vote_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }
	function countVotes($params){
#		$this->db->like('componentid',$params['componentid']);
#		$query = $this->db->get('votes');
#		return $query->result();

		$id  = $params['componentid'];
		$type = $params['type'];
		$votecount_up = 0;
		$votecount_down = 0;
		$rs_voteup = $this->db->find('all',array('select'=>'sum(votes) as votecount','conditions'=>array('votes > 0 AND componentid = ?',$id)));
		foreach($rs_voteup as $r){
			if($r->votecount)
			$votecount_up = intval($r->votecount);
			break;
		}
		$rs_votedown = $this->find('all',array('select'=>'sum(votes) as votecount','conditions'=>array('votes < 0 AND componentid = ?',$id)));
		foreach($rs_votedown as $r){
			if($r->votecount)
			$votecount_down = intval($r->votecount);
			break;
		}

	}
	function add($params){
		return $this->db->insert('answers',$params);
	}
}
?>
