<?php

namespace aps\controller;

use aps\controller\main\Header;
class Home
{
    public function initialPage():void
    {
        $header = new Header("Página Inicial");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/home/index.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function login():void
    {
        $header = new Header("Login - Área restrita");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/login/login.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function ops():void
    {
        include_once("src/view/main/404.phtml");
    }
}