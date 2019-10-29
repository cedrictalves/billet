<?php
require_once 'controller/PostCtrl.php';
require_once 'controller/CommentCtrl.php';
require_once 'controller/MessageCtrl.php';
require_once 'view/MainView.php';
require_once 'model/MainModel.php';

	////////////////////////////////
	//     BACK CONTROLLER        //
	////////////////////////////////
class BackCtrl {
	
	function __construct($url)
	{
		$this->url = $url;
		$this->post = new PostCtrl();
		$this->comment = new CommentCtrl();
		$this->message = new MessageCtrl();
		$this->view = new MainView();
	}

	////////////////////////////////
	//   GET PAGE FONCTION        //
	////////////////////////////////
	public function getPage() {
		global $safePost;
		

		$todo = $this->url[0];                                         // HOST/ADMIN/$TODO
    	if ($todo == "") $todo = "chaptersMenu";                       //IF $TODO EMPTY -> HOME PAGE
    	if ( !method_exists ( $this, $todo ) ) $todo = "chaptersMenu"; //IF $TODO UnKNOWN > HOME PAGE

    	//IF NO SESSION TODO = LOGIN ELSE ADMIN PAGE
    	if (!isset ($_SESSION["userName"])) {
	    	if ((isset($safePost["userName"]))) {
	    		require_once 'model/UserModel.php';
	    		$userModel = new UserModel();
	    		$test = $userModel->getUser($safePost['userName'], hash("sha256",$safePost['password']), 1);
	    		if (empty($test)){
	    			$todo = "login";
	    			echo '<script>alert("Les identifiants saisis ne sont pas corrects. Veuillez réessayer.")</script>';	
	    		}
	    		else $_SESSION['userName'] = $safePost['userName'];
	    	} 	
	    	else $todo = "login";
		}	
		return $this->$todo();
	}	

	////////////////////////////////
	//         LOGIN PAGE         //
	////////////////////////////////
	private function login() {
		session_destroy();
		require_once 'view/MainView.php';
		return $this->view->mergeWithTemplate([],"login");
	}

	////////////////////////////////
	//     ADMIN CHAPTER MENU     //
	////////////////////////////////
	private function chaptersMenu() {
		////////////////////////////////
		//      DELETE CHAPTER        //
		////////////////////////////////
		global $safePost;
		if (isset($safePost['chapterid'])){
					require_once 'controller/PostCtrl.php';
					$chapterid = $safePost['chapterid'];
					$del = new PostCtrl();
					$del->deleteChapter($chapterid);
					echo '<script>alert("Le chapitre a bien été supprimé.")</script>';
		}

		require_once 'controller/PostCtrl.php';
		require_once 'view/MainView.php';
		return $this->view->mergeWithTemplate(["{{ nav }}" => $this->post->navPostsAdmin()], "chaptersMenu");
	}

	////////////////////////////////////////
	//EDIT CHAPTER + MODERATE COMMENT PAGE//
	////////////////////////////////////////
	private function chapter() {
		global $safePost;

		if (isset($safePost['state']) && isset($safePost['id'])){
			require_once 'controller/CommentCtrl.php';
			$id = $safePost['id'];

			switch ($safePost['state']){

				case 2: //publish
					$pub = new CommentCtrl();
					$pub->publishComment($id);
					echo '<script>alert("Le commentaire été publié.")</script>';
				break;

				case 3: //publish without report button
					$pubEver = new CommentCtrl();
					$pubEver->publishForEverComment($id);
					echo '<script>alert("Le commentaire été publié définitivement.")</script>';
				break;

				case 4: //delete
					$del = new CommentCtrl();
					$del->deleteComment($id);
					echo '<script>alert("Le commentaire a bien été supprimé.")</script>';
				break;
			}
		
		}

		
		


		require_once 'controller/PostCtrl.php';
		require_once 'model/PostModel.php';
		require_once 'controller/CommentCtrl.php';
		require_once 'model/CommentModel.php';		
		require_once 'view/MainView.php';
		$editor = new PostCtrl();
		$editor->editChapter($this->url[1]);
		$postData = $this->post->showOnePostAdmin($this->url[1]);
		$postData["{{ comments }}"] = $this->comment->showCommentsAdmin($this->url[1]);
		return $this->view->mergeWithTemplate($postData, "chapterForm");
	}

	////////////////////
	//NEW CHAPTER PAGE//
	////////////////////
	private function newChapter() {
		require_once 'controller/PostCtrl.php';
		require_once 'model/PostModel.php';
		require_once 'view/MainView.php';
		$newChapter = new PostCtrl();
		$newChapter->addChapter();

		return $this->view->mergeWithTemplate([], "addChapterForm");
	}

	////////////////////////////////////////
	//     UNREAD  MESSAGE PAGE           //
	////////////////////////////////////////
	private function messages() {
		global $safePost;
		require_once 'model/MessageModel.php';
		require_once 'controller/MessageCtrl.php';
		require_once 'view/MainView.php';

		if (isset($safePost['state']) && isset($safePost['id'])){
			require_once 'controller/MessageCtrl.php';
			$id = $safePost['id'];

			switch ($safePost['state']){

				case 1: //archive message
					$archive = new MessageCtrl();
					$archive->archiveMessage($id);
					echo '<script>alert("Le message a été archivé.")</script>';
				break;

				case 2: //delete message
					$delete = new MessageCtrl();
					$delete->deleteMessage($id);
					echo '<script>alert("Le message a été supprimé.")</script>';
				break;
			}
		}

		$messages = new MessageCtrl();
		return $this->view->mergeWithTemplate(["{{ messages }}" => $messages->showAllNewMessages()], "messages");
	}

	////////////////////////////////////////
	//     OLD   MESSAGE  PAGE            //
	////////////////////////////////////////
	private function oldmessages() {
		global $safePost;
		require_once 'model/MessageModel.php';
		require_once 'controller/MessageCtrl.php';
		require_once 'view/MainView.php';

		if (isset($safePost['state']) && isset($safePost['id'])){
			require_once 'controller/MessageCtrl.php';
			$id = $safePost['id'];

			switch ($safePost['state']){

				case 2: //delete message
					$delete = new MessageCtrl();
					$delete->deleteMessage($id);
					echo '<script>alert("Le message a été supprimé.")</script>';
				break;
			}
		}

		//SHOW OLD MESSAGES
		$messages = new MessageCtrl();
		return $this->view->mergeWithTemplate(["{{ messages }}" => $messages->showAllOldMessages()], "oldmessages");
	}


}