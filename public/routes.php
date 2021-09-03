<?php

if(!isset($_SESSION)) session_start();

use aps\controller\Home;
use aps\controller\Login;
use aps\controller\User;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/cadastrar', [User::class, 'cadastrar']);
SimpleRouter::get('/quem-somos', [Home::class, 'quemSomos']);
SimpleRouter::get('/login', [Login::class, 'loginPage']);
SimpleRouter::get('/', [Home::class, 'initialPage']);
SimpleRouter::post('/login', [Login::class, 'getLoginData']);

if (isset($_SESSION['username'])) {
    SimpleRouter::get('/user/listar', [User::class, 'listar']);
}

try {
    SimpleRouter::start();
} catch (NotFoundHttpException $e) {
    $ops = new Home();
    echo $ops->ops();
}

