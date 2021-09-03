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

    public function quemSomos():void
    {
        $header = new Header("Quem Somos");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/home/quem-somos.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function ops():void
    {
        include_once("src/view/main/404.phtml");
    }

}