<?php
// Simple Router & MVC entry point
require_once 'config/database.php';

session_start();

$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$url = rtrim($url, '/');
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
