<?php

namespace aps\controller;

if ( !isset($_SESSION) ) { session_start (); }

use aps\appcore\JsonMsg;
use aps\controller\main\Header;
use aps\model\SubjectModel;
use aps\model\UserModel;

class User
{
    private UserModel $user;
    use JsonMsg;

    public function __construct ()
    {
        $this->user = new UserModel();
    }

    public function newUser(): void
    {
        $this->user->newUser ();
    }

    public function cadastrar():void
    {
        $header = new Header("Novo usuário");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/user/cadastrar.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function list()
    {
        $users = new UserModel();
        $users->listAll ();
    }

    public function listar():void
    {
        $header = new Header("Questões");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/user/index.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function updateUser(): void
    {
        $this->user->updateUser ();

    }

    public function prepareEdit (int $id)
    {
        $data = $this->user->editById ($id, null);
        $subjects = new SubjectModel();
        $r = $subjects->listAll (1);
        $header = new Header("Editar Usuário");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/admin/user/editar.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function deleteUser(): void
    {
        $this->user->deleteUser ();
    }

    public function getLoginData(string $login)
    {
        $user = new UserModel();
        return $user->listByLogin ($login);
    }


}
