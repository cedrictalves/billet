<?php
require_once 'controller/PostCtrl.php';
require_once 'view/MainView.php';

	////////////////////////////////
	//      FRONT CONTROLLER      //
	////////////////////////////////
class FrontCtrl {
	
	function __construct($url)
	{
		$this->url = $url;
		$this->post = new PostCtrl();
		$this->view = new MainView();
	}

	////////////////////////////////
	//   GET PAGE TODO=FUNCTION  //
	////////////////////////////////
	public function getPage() {
			$todo = $this->url[0];                                  //la fonction à appeler par défaut est le premier segment 
    		if ($todo == "") $todo = "home";                        //si il n'est pas défini on affiche la page d'accueil
    		if ( !method_exists ( $this, $todo ) ) $todo = "home";  //si la fonction n'existe pas on affiche la page d'accueil
    		return $this->$todo();
	}

	////////////////////////////////
	//         HOME   PAGE        //
	////////////////////////////////
	private function home() {
		require_once 'controller/MessageCtrl.php';
		$message = new MessageCtrl();
		$message->sendMessage();
		return $this->view->mergeWithTemplate(["{{ nav }}" => $this->post->navPosts()], "home");
	}

	////////////////////////////////
	//        CHAPTER PAGE        //
	////////////////////////////////
	private function chapter() {
		global $safePost;
		require_once 'controller/CommentCtrl.php';
		$comment = new CommentCtrl();
		$comment->addComment();
		

		////////////////////////////////
		//      REPORT   COMMENT      //
		////////////////////////////////
		if (isset($safePost['state']) && isset($safePost['id'])){
			require_once 'controller/CommentCtrl.php';
			$id = $safePost['id'];
			$rep = new CommentCtrl();
			$rep->reportComment($id);
			echo '<script>alert("Le commentaire a bien été signalé.")</script>';
		}
		
		////////////////////////////////
		//   CHAPTER PAGE TEMPLATE    //
		////////////////////////////////
		return $this->view->mergeWithTemplate([
			"{{ nav }}" => $this->post->navPosts(),
			"{{ chapter }}" => $this->post->showOnePost($this->url[1]),
			"{{ comment }}" => $comment->showComments($this->url[1]),
			"{{ title }}" => $this->post->titlePost($this->url[1]),
			"{{ post_id }}" => $this->url[1]
		], "chapter");
	}

	////////////////////
	//    LOG OUT     //
	////////////////////
	private function logout() {
		session_start();
		unset($_SESSION);
		session_destroy();
		session_write_close();
		header('Location: home');
		die;
	}

}