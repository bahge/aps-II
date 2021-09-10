<?php

if(!isset($_SESSION)) session_start();

use aps\controller\{ Home, Login, Admin, User };
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;
use aps\appcore\Auth;

/* Páginas públicas */
SimpleRouter::get('/cadastrar', [User::class, 'cadastrar']);
SimpleRouter::get('/quem-somos', [Home::class, 'quemSomos']);
SimpleRouter::get('/login', [Login::class, 'loginPage']);
SimpleRouter::get('/', [Home::class, 'initialPage']);
SimpleRouter::post('/login', [Login::class, 'getLoginData']);
SimpleRouter::post ('/novo-user', [User::class, 'newUser']);

/* Verifica se há autenticação por cabeçalho */
Auth::isAuthHeader();

/* Verifica se há está autenticado */
if(Auth::isAuth()) {

    /* Verifica se é admin */
    if(Auth::isAdmin()) {

        SimpleRouter::get('/admin', [Admin::class, 'index']);
        SimpleRouter::get('/user/gerenciar', [Admin::class, 'userManager']);
        SimpleRouter::get ('/users', [User::class, 'list']);

    }

    /* Usuários */
    SimpleRouter::get('/user/listar', [User::class, 'listar']);
    SimpleRouter::get('/logout', [Login::class, 'logout']);

}

try {
    SimpleRouter::start();
} catch (NotFoundHttpException $e) {
    $ops = new Home();
    echo $ops->ops();
}

