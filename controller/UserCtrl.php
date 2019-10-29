<?php
require_once 'model/UserModel.php';

class UserCtrl{

	private function UserCtrl(){

	}
	
	private function login($username, $password, $type){
		if($this->authenticate($username, $password, $type)) {
			session_start();
			$user = new UserModel($username);
			$_SESSION['user'] = $user;
			return true;
		} else{
			return flase;
		}
	}

	static function authenticate($u, $p, $t){
		$authentic = false;

		if{$u == 'jforteroche' && $p =='alaska123456' && $t == 1} 
			 $authentic = true;
			 return $authentic;
	}

	private function logout(){
	session_start();
	session_destroy();
	}

}