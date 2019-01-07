<?php

session_start();

require_once('config.php');

$queryString = str_replace(BASE_HOST, '', $_SERVER['REQUEST_URI']);
$queryString = rtrim($queryString, '/');

$requestParts = explode('/', parse_url($queryString, PHP_URL_PATH));
$requestParts = array_splice($requestParts, 1); // Remove first empty string

$controllerName = DEFAULT_CONTROLLER;
if (count($requestParts) >= 1 && $requestParts[0] != '') {
	$controllerName = $requestParts[0];
}

$action = DEFAULT_ACTION;
if (count($requestParts) >= 2 && $requestParts[1] != '') {
	$action = $requestParts[1];
}

$params = array_splice($requestParts, 2);

$controllerClassName = ucfirst(strtolower($controllerName)) . 'Controller';
$controllerFileName = "controllers/$controllerClassName.php";

if (class_exists($controllerClassName)) {
	$controller = new $controllerClassName($controllerName, $action);
}
else {
	die("Cannot find controller '$controllerName' in class '$controllerFileName'");
}

if (method_exists($controller, $action)) {
	call_user_func_array(array($controller, $action), $params);
	$controller->renderView();
} 
else {
	die("Cannot find action '$action' in controller '$controllerClassName'");
}

function __autoload($class_name) {
	if (file_exists("controllers/$class_name.php")) {
		include "controllers/$class_name.php";
	}

	if (file_exists("models/$class_name.php")) {
		include "models/$class_name.php";
	}
}
