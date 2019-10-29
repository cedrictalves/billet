<?php
require_once 'model/MainModel.php';

/////////////////////
/// MESSAGE MODEL ///
/////////////////////
class MessageModel extends MainModel{

	///////////////////////
	/// SEND A MESSAGE  ///
	///////////////////////
	public function sendOneMessage(){

		if (!empty($_POST['user_name']) && !empty($_POST['message']) && !empty($_POST['email'])){
				$values = array(
		    		'user_name' => $_POST['user_name'],
					'message' => $_POST['message'],
					'state' => $_POST['state'],
					'email' => $_POST['email']
				);

			$sqlfuncs = array(
    			'date_creation' => 'NOW()',
			);

	$this->pInsertFunc("INSERT INTO", "message", $values, $sqlfuncs);
				echo '<script>alert("Le message a bien été envoyé.")</script>';
		}
	}

	// SHOW UNREAD MESSAGE ON ADMIN PAGE
	public function getNewMessages(){
		$sql = 'SELECT user_name, message, email, id, state, date_creation FROM message WHERE state = 0 ORDER BY id DESC';
		$data = $this->db->query($sql);
		return $data->fetchAll();
	}

	// SHOW UNREAD MESSAGE ON ADMIN PAGE
	public function getOldMessages(){
		$sql = 'SELECT user_name, message, email, id, state, date_creation FROM message WHERE state = 1 ORDER BY id DESC';
		$data = $this->db->query($sql);
		return $data->fetchAll();
	}

	// DELETE MESSAGE BY ID
	public function deleteOneMessage($id){
		$sql = "DELETE FROM `message` WHERE id=" . $id;
		$data = $this->db->query($sql);
		return $data;
	}

	// REPORT COMMENT BY ID
	public function archiveOneMessage($id){
		$sql = "UPDATE `message` SET state= :state WHERE id=" . $id;
		$resultat = $this->db->prepare($sql);
		$resultat->execute(['state' => $_POST['state']]);
	}
}

