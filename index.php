<?php
// Simple Router & MVC entry point
require_once 'config/database.php';

session_start();

$requestUri = $_SERVER['REQUEST_URI'];
$basePath = ''; // Adjust if needed
$url = str_replace($basePath, '', $requestUri);
$url = parse_url($url, PHP_URL_PATH);
$url = rtrim($url, '/');
$url = ltrim($url, '/');

if (empty($url)) {
    $url = 'home';
}

$url = explode('/', $url);

$controllerName = ucfirst($url[0]) . 'Controller';
$methodName = isset($url[1]) ? $url[1] : 'index';

if (file_exists("app/Controllers/$controllerName.php")) {
    require_once "app/Controllers/$controllerName.php";
    $controller = new $controllerName();

    if (method_exists($controller, $methodName)) {
        $params = array_slice($url, 2);
        call_user_func_array([$controller, $methodName], $params);
    } else {
        die("Method $methodName not found");
    }
} else {
    require_once "app/Controllers/HomeController.php";
    $home = new HomeController();
    $home->index();
}
