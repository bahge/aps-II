<?php

use aps\controller\Home;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', [Home::class, 'olaMundo']);

try {
    SimpleRouter::start();
} catch (NotFoundHttpException $e) {
    $ops = new Home();
    echo $ops->ops();
}

