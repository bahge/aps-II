<?php

namespace aps\controller;

if ( !isset($_SESSION) ) { session_start (); }

use aps\appcore\interfaces\crudInterface;
use aps\appcore\JsonMsg;
use aps\appcore\model\EmailModel;
use aps\controller\main\Header;
use aps\model\SubjectModel;
use aps\model\UserModel;

class User implements crudInterface
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

    public function cadastrar() : void
    {
        $header = new Header("Novo usuário");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/user/cadastrar.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function list() : void
    {
        $users = new UserModel();
        $users->listAll ();
    }

    public function listar() : void
    {
        $header = new Header("Questões");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/user/index.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function update() : void
    {
        $this->user->updateUser ();

    }

    public function prepareEdit (int $id) : void
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

    public function delete() : void
    {
        $this->user->deleteUser ();
    }

    public function getLoginData(string $login)
    {
        $user = new UserModel();
        return $user->listByLogin ($login);
    }

    public function recoverPassword(string $verify)
    {
        $model = new EmailModel();
        $user = $model->checkRecovery ($verify);
        $header = new Header("Recuperar Senha");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/user/recuperar-senha.phtml");
        include_once("src/view/main/footer.phtml");

    }

    public function formRecoveryPassword()
    {
        $header = new Header("Esqueci minha senha");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/user/recuperar-senha.phtml");
        include_once("src/view/main/footer.phtml");
    }

}
