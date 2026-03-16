<?php
require_once 'config/config.php';
require_once "vendor/autoload.php";
require_once 'config/database.php';

session_start();

// Get the actual URL parts
$requestUri = $_SERVER['REQUEST_URI'];
$scriptName = $_SERVER['SCRIPT_NAME'];
$basePath = str_replace('index.php', '', $scriptName);
$urlPath = str_replace($basePath, '', $requestUri);
$urlPath = explode('?', $urlPath)[0]; // Remove query string

if (empty($urlPath)) {
    $urlPath = 'home';
}

$url = explode('/', trim($urlPath, '/'));

$controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
$methodName = isset($url[1]) ? $url[1] : 'index';

if (file_exists("app/Controllers/$controllerName.php")) {
    require_once "app/Controllers/$controllerName.php";
    $controller = new $controllerName();

    if (method_exists($controller, $methodName)) {
        $params = array_slice($url, 2);
        call_user_func_array([$controller, $methodName], $params);
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "404 - Method $methodName not found in $controllerName";
    }
} else {
    require_once "app/Controllers/HomeController.php";
    $home = new HomeController();
    $home->index();
}
