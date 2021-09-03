<?php

namespace aps\controller;

if ( !isset($_SESSION) ) { session_start (); }

use aps\controller\main\Header;

class Login
{
    private array $fakeLogin = ['login' => 'user',
        'pass' => 'senha',
        'name' => 'Teste'];

    public function loginPage(): void
    {
        $header = new Header("Login - Área restrita");
        include_once ( "src/view/main/header.phtml" );
        include_once ( "src/view/main/menu.phtml" );
        include_once ( "src/view/login/login.phtml" );
        include_once ( "src/view/main/footer.phtml" );
    }

    public function getLoginData(): bool
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        if ( $this->ckeckLogin ($data) ) {
            $_SESSION['username'] = $this->fakeLogin['name'];
            return true;
        } else {
            unset($_SESSION['username']);
            return false;
        }
    }

    private function ckeckLogin(array $data): bool
    {
        if ( ( $data['login'] == $this->fakeLogin['login'] ) && password_verify ($data['pass'], password_hash ($this->fakeLogin['pass'], PASSWORD_BCRYPT)) ) return true;
        return false;
    }
}