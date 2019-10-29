<?php

/////////////////////
/// ROUTER CLASS  ///
/////////////////////
class Router {

	private $url;
	private $controller;


	public function __construct(){
		$this->url = explode ( "/", filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL , FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW)); 
		$this->url = array_slice($this->url, 1);
		switch ($this->url[0]){
			case "admin":
				$this->controller="BackCtrl";
				$this->url = array_slice($this->url, 1);
				break;
			default:
				$this->controller="FrontCtrl";
				break;
		}
	}

	public function get(){
		return [
			'controller'=>$this->controller,
			'arguments'=>$this->url
		];
	}
}

