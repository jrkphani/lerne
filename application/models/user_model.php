<?php
Class User_model extends CI_Model
{
	function login($email, $password)
	{
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('email = ' . "'" . $email . "'"); 
		$this -> db -> where('password = ' . "'" . MD5($password) . "'"); 
		$this -> db -> where("confirmcode = '1' ");
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}
	private function rand_string($length=32) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^*";	
	$size = strlen( $chars );
	$str ='';
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}
	return $str;
}

	public function add_user()
 {
 	$confirmcode = $this->rand_string();
  $data=array(
    'firstname'=>$this->input->post('firstname'),
    'lastname'=>$this->input->post('lastname'),
    'email'=>$this->input->post('email'),
    'password'=>md5($this->input->post('password')),
    'confirmcode' => $confirmcode
  );
  $this->db->set('user_created','NOW()',false);
  $this->db->insert('users',$data);
 }
}

?>