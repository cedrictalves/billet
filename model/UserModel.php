<?php
require_once 'model/MainModel.php';

/////////////////////
///   USER MODEL  ///
/////////////////////
class UserModel extends MainModel{

	private $username;

	//////////////////////////////////////////////////////////////////
	///   SELECT USER WHERE USERTYPE, USERNAME AND PASSWORD MATCH  ///
	//////////////////////////////////////////////////////////////////
	public function getUser($username, $password, $usertype){
		$sql = "SELECT id FROM users WHERE user_type = :user_type AND user_name = :user_name AND password = :password";
		$data = $this->db->prepare($sql);
	    $data->execute([
	    	"user_name" => $username,
	    	"password" => $password,
	    	"user_type" => $usertype
	    ]);
	    return $data->fetch();
	}
}
