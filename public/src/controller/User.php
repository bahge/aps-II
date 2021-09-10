<?php

namespace aps\controller;

if ( !isset($_SESSION) ) { session_start (); }

use aps\controller\main\Header;
use aps\model\UserModel;

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

    public function listar():void
    {
        $header = new Header("Questões");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/user/index.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function list()
    {
        $users = new UserModel();
        $users->listAll ();
    }

    public function newUser(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        $user = new UserModel();
        $dataSave = [
            'id' => ( $data['id'] ?? null ),
            'login' => ( $data['login'] ?? null ),
            'pass' => ( $data['pass'] ?? null ),
            'cpf' => ( $data['cpf'] ?? null ),
            'name' => ( $data['name'] ?? null ),
            'area' => ( $data['area'] ?? null ),
            'level' => ( $data['level'] ?? 0 )
        ];

        if (!is_null($dataSave['pass'])){
            $dataSave['pass'] = password_hash ($dataSave['pass'], PASSWORD_BCRYPT);
        }
        $result = $user->insert ('user', $dataSave);
        if ($result === true) {
            echo "Registro salvo com sucesso";
        } else {
            echo $result;
        }

    }

    public function getLoginData(string $login)
    {
        $user = new UserModel();
        return $user->listByLogin ($login);
    }


}
