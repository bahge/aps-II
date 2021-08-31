<?php

use aps\controller\Home;
use aps\controller\User;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/cadastrar', [User::class, 'cadastrar']);
SimpleRouter::get('/', [Home::class, 'initialPage']);


try {
    SimpleRouter::start();
} catch (NotFoundHttpException $e) {
    $ops = new Home();
    echo $ops->ops();
}

