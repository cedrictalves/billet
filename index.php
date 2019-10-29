<?php

$safePost = filter_input_array(INPUT_POST, [
	'content' => FILTER_SANITIZE_SPECIAL_CHARS,
	'user_name' => FILTER_SANITIZE_SPECIAL_CHARS,
	'userName' => FILTER_SANITIZE_SPECIAL_CHARS,
	'message' => FILTER_SANITIZE_SPECIAL_CHARS,
	'email' => FILTER_SANITIZE_SPECIAL_CHARS,
	'password' => FILTER_SANITIZE_SPECIAL_CHARS,
	'state' => FILTER_SANITIZE_NUMBER_INT,
	'id' => FILTER_SANITIZE_NUMBER_INT,
    'chapterid' => FILTER_SANITIZE_NUMBER_INT
]);

require_once 'router/router.php';

session_start();

$router = new Router();

$route = $router->get();

require_once 'controller/' . $route['controller'] . '.php';

$controller = new $route['controller'] ($route['arguments']);

echo $controller->getPage();

