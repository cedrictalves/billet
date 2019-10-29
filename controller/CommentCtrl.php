<?php


require_once("view/CommentView.php");
require_once("model/CommentModel.php");

	////////////////////////////////
	//     COMMENT CONTROLLER     //
	////////////////////////////////

class CommentCtrl{	

	////////////////////////////////
	//     SHOW COMMENT BY POST   //
	////////////////////////////////
	public function showComments($post_id){
		$myModel = new CommentModel();
		$data = $myModel->getComments($post_id);
		$myView = new CommentView();
		return $myView->showComments($data);
	}

	////////////////////////////////
	//     SHOW COMMENT ADMIN     //
	////////////////////////////////
	public function showCommentsAdmin($post_id){
		$myModel = new CommentModel();
		$data = $myModel->getCommentsAdmin($post_id);
		$myView = new CommentView();
		return $myView->showCommentsAdmin($data);
	}

	////////////////////////////////
	//        ADD A COMMENT       //
	////////////////////////////////
	public function addComment(){
		$add = new CommentModel();
		return $add->addOneComment();
	}

	////////////////////////////////
	//      DELETE A COMMENT      //
	////////////////////////////////
	public function deleteComment($id){
		$del = new CommentModel();
		return $del->deleteOneComment($id);
	}

	////////////////////////////////
	//     REPPORT A COMMENT      //
	////////////////////////////////
	public function reportComment($id){
		$report = new CommentModel();
		return $report->reportOneComment($id);
	}

	////////////////////////////////
	//     PUBLISH A COMMENT      //
	////////////////////////////////
	public function publishComment($id){
		$publish = new CommentModel();
		return $publish->reportOneComment($id);
	}

	////////////////////////////////
	//  PUBLISH WITH NO REPORT    //
	////////////////////////////////
	public function publishForEverComment($id){
		$publishEver = new CommentModel();
		return $publishEver->publishForEverOneComment($id);
	}

}

