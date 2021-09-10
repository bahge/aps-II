<?php


namespace aps\controller;

if ( !isset($_SESSION) ) { session_start (); }

use aps\controller\main\Header;

class Admin
{
    public function index()
    {
        $header = new Header("Admin");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/admin/admin.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function userManager()
    {
        $header = new Header("Admin");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/admin/user/listar.phtml");
        include_once("src/view/main/footer.phtml");
    }
}