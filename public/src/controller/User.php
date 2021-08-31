<?php

namespace aps\controller;

use aps\controller\main\Header;

class User
{
    public function cadastrar():void
    {
        $header = new Header("Novo usuário");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/user/cadastrar.phtml");
        include_once("src/view/main/footer.phtml");
    }


}
