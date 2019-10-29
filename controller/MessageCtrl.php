<?php

require_once "model/MessageModel.php" ;
require_once "view/MessagesView.php" ;

	////////////////////////////////
	//       SEND A MESSAGE       //
	////////////////////////////////
class MessageCtrl {
	public function sendMessage(){
		$send = new MessageModel();
		return $send->sendOneMessage();
	}

	public function showAllNewMessages(){
		$myModel = new MessageModel();
		$data = $myModel->getNewMessages();
		$myView = new MessageView();
		return $myView->showNewMessages($data);
	}

	public function showAllOldMessages(){
		$myModel = new MessageModel();
		$data = $myModel->getOldMessages();
		$myView = new MessageView();
		return $myView->showOldMessages($data);
	}

	public function archiveMessage($id){
		$archive = new MessageModel();
		return $archive->archiveOneMessage($id);
	}

	public function deleteMessage($id){
		$del = new MessageModel();
		return $del->deleteOneMessage($id);
	}

}