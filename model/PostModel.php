<?php
require_once "model/MainModel.php" ;

/////////////////////
///  POST MODEL   ///
/////////////////////
class PostModel extends MainModel{

	////////////////////////////////
	//       GET ALL POSTS        //
	////////////////////////////////
	public function getPosts($qty=NULL){
		$sql = 'SELECT * FROM `posts` ORDER BY id';
		if (!is_null($qty)) $sql .= ' DESC limit ' .$qty;
		$data = $this->db->query($sql);
		return $data->fetchAll();
	}

	////////////////////////////////
	//     GET ONE POST BY ID     //
	////////////////////////////////
	public function getOnePost($id){
		$sql = 'SELECT * FROM `posts` WHERE id=' .$id;
		$data = $this->db->query($sql);
		return $data->fetchAll();
	}

	////////////////////////////////
	//  GET ONE POSTBY ID  ADMIN  //
	////////////////////////////////
	public function getOnePostAdmin($id){
		$sql = 'SELECT content AS "{{ content }}", title AS "{{ title }}" FROM `posts` WHERE id=' .$id;
		$data = $this->db->query($sql);
		return $data->fetch();
	}

	////////////////////////////////
	//     GET TITLE BY ID        //
	////////////////////////////////
	public function getTitle($id){
		$sql = "SELECT `title` FROM `posts` WHERE id=:id";
		$resultat = $this->db->prepare($sql);
		$resultat->execute(["id"=>$id]);
		$data = $resultat->fetch(); //store result
		$resultat->closeCursor(); //close request
		return $data['title'];
	}

	////////////////////////////////
	//     ADD A NEW CHAPTER      //
	////////////////////////////////
	public function addOneChapter(){
			$values = array(
    		'title' => $_POST['title'],
			'content' => $_POST['content']
		);

		$sqlfuncs = array(
    		'date_creation' => 'NOW()',
		);
		echo '<script>alert("Le chapitre a bien été publié.")</script>';

	return $this->pInsertFunc("INSERT INTO", "posts", $values, $sqlfuncs);
	}

	////////////////////////////////
	//   EDIT A CHAPTER BY ID     //
	////////////////////////////////
	public function editOneChapter($id){
		if (!empty($_POST['title']) && !empty($_POST['content'])){
				$sql = 'UPDATE `posts` SET title=:title, content=:content WHERE id=' . $id;
				$resultat = $this->db->prepare($sql);
				$resultat->execute([
					'title' => $_POST['title'],
					'content' => $_POST['content']
			]);
				echo '<script>alert("Le chapitre a bien été modifié.")</script>';
		}
	}

	////////////////////////////////
	//     DELETE ONE CHAPTER     //
	////////////////////////////////
	public function deleteOneChapter($chapterid){
		$sql = "DELETE FROM `posts` WHERE id=" . $chapterid;
		$data = $this->db->query($sql);
		return $data;
	}




}  



