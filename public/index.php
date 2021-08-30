<?php

require_once "vendor/autoload.php";

use aps\router\Router;

$url= $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$route = new Router($url, $method);

echo $route->getMethod();