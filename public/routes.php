<?php

use aps\controller\Home;
use aps\controller\User;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/cadastrar', [User::class, 'cadastrar']);
SimpleRouter::get('/quem-somos', [Home::class, 'quemSomos']);
SimpleRouter::get('/login', [Home::class, 'login']);
SimpleRouter::get('/', [Home::class, 'initialPage']);
SimpleRouter::post('/login', [Home::class, 'logar']);



try {
    SimpleRouter::start();
} catch (NotFoundHttpException $e) {
    $ops = new Home();
    echo $ops->ops();
}

