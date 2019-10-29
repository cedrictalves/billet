<?php


require_once "view/PostView.php" ;
require_once "model/PostModel.php" ;

////////////////////////////////
//     POST CONTROLLER        //
////////////////////////////////
class PostCtrl{	

	////////////////////////////////
	// GET POSTS FROM QUANTITY    //
	////////////////////////////////
	public function showLastPosts($qty){
		$myModel = new PostModel();
		$data = $myModel->getPosts($qty);
		$myView = new PostView();
		return $myView->fullChapter($data);
	}

	////////////////////////////////
	//       GET ALL POST         //
	////////////////////////////////
	public function navPosts($qty=NULL){
		$myModel = new PostModel();
		$data = $myModel->getPosts($qty);
		$myView = new PostView();
		return $myView->listChapter($data);
	}

	/////////////////////////////////////
	//       GET ALL POST ADMIN        //
	/////////////////////////////////////
	public function navPostsAdmin($qty=NULL){
		$myModel = new PostModel();
		$data = $myModel->getPosts($qty);
		$myView = new PostView();
		return $myView->listChapterAdmin($data);
	}

	////////////////////////////////
	//  GET ONE POST FRONT BY ID  //
	////////////////////////////////
	public function showOnePost($id){
		$myModel = new PostModel();
		$data = $myModel->getOnePost($id);
		$myView = new PostView();
		return $myView->fullChapter($data);
	}

	////////////////////////////////
	//  GET ONE POST ADMIN BY ID  //
	////////////////////////////////
	public function showOnePostAdmin($id){
		$myModel = new PostModel();
		return $myModel->getOnePostAdmin($id);
	}

	////////////////////////////////
	//    GET ONE TITILE BY ID    //
	////////////////////////////////
	public function titlePost($id){
		$myModel = new PostModel();
		return $myModel->getTitle($id);
	}

	////////////////////////////////
	//     ADD A CHAPTER ADMIN    //
	////////////////////////////////
	public function addChapter(){
		if (!empty($_POST['title']) && !empty($_POST['content'])){
		$add = new PostModel();
		$add->addOneChapter();
		header("LOCATION: http://".filter_input(INPUT_SERVER, "SERVER_NAME", FILTER_SANITIZE_STRING)."/admin/");
		}
	}

	////////////////////////////////
	//    EDIT A CHAPTER ADMIN    //
	////////////////////////////////
	public function editChapter($id){
		$edit = new PostModel();
		return $edit->editOneChapter($id);
	}

	////////////////////////////////
	//      DELETE A COMMENT      //
	////////////////////////////////
	public function deleteChapter($chapterid){
		$del = new PostModel();
		return $del->deleteOneChapter($chapterid);
	}


	
}