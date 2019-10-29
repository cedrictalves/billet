<?php
require_once 'model/MainModel.php';


///////////////////
// COMMENT MODEL //
///////////////////
class CommentModel extends MainModel{


	// SHOW COMMENT ON FRONT BY POST AND IF THEY'RE PUBLISHED BY ADMIN
	public function getComments($post_id){
		$sql = 'SELECT user_name, date_creation, content, state, id FROM comment  WHERE post_id=' . $post_id . " AND state >= 2 ORDER BY id DESC";
		$data = $this->db->query($sql);
		return $data->fetchAll();
	}

	// SHOW COMMENT ON BACK BY POST AND IF THEY'RE NOT PUBLISHED BY ADMIN
	public function getCommentsAdmin($post_id){
		$sql = 'SELECT user_name, date_creation, content, state, id FROM comment  WHERE post_id=' . $post_id . " AND state <= 1 ORDER BY id DESC";
		$data = $this->db->query($sql);
		return $data->fetchAll();
	}


	// AD A COMMENT ON POST BY ID
	public function addOneComment(){
		if (!empty($_POST['user_name']) && !empty($_POST['content'])){
			$values = array(
    		'user_name' => $_POST['user_name'],
			'content' => $_POST['content'],
			'post_id' => $_POST['post_id']
		);

		$sqlfuncs = array(
    		'date_creation' => 'NOW()',
		);

	$this->pInsertFunc("INSERT INTO", "comment", $values, $sqlfuncs);
			echo '<script>alert("Le commentaire a bien été envoyé.")</script>';
		}

	}

	// REPORT COMMENT
	public function reportOneComment($id){
		$sql = "UPDATE `comment` SET state= :state WHERE id=" . $id;
		$resultat = $this->db->prepare($sql);
		$resultat->execute(['state' => $_POST['state']]);
	}

	// PUBLISH ONE COMMENT
	public function publishOneComment($id){
		$sql = "UPDATE `comment` SET state= :state WHERE id=" . $id;
		$resultat = $this->db->prepare($sql);
		$resultat->execute(['state' => $_POST['state']]);
	}

	// PUBLISH ONE COMMENT WITHOUT REPORT BUTTON
	public function publishForEverOneComment($id){
		$sql = "UPDATE `comment` SET state= :state WHERE id=" . $id;
		$resultat = $this->db->prepare($sql);
		$resultat->execute(['state' => $_POST['state']]);
	}

	// DELETE COMMENT
	public function deleteOneComment($id){
		$sql = "DELETE FROM `comment` WHERE id=" . $id;
		$data = $this->db->query($sql);
		return $data;
	}



}  