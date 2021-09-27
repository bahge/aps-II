<?php

namespace aps\controller;

if ( !isset($_SESSION) ) { session_start (); }

use aps\appcore\JsonMsg;
use aps\controller\main\Header;

class Login
{
    private string $name;
    private int $level;
    use JsonMsg;

    public function loginPage(): void
    {
        $header = new Header("Login - Área restrita");
        include_once ( "src/view/main/header.phtml" );
        include_once ( "src/view/main/menu.phtml" );
        include_once ( "src/view/login/login.phtml" );
        include_once ( "src/view/main/footer.phtml" );
    }

    public function getLoginData(): void
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        if ( $this->ckeckLogin ($data) ) {
            $_SESSION['username'] = $this->name;
            $_SESSION['level'] = strval($this->level);
            if ($this->level > 0) {
                $this->message (['aviso'=> 'admin']);
                exit;
            }
            $this->message (['aviso'=> 'usuário']);
            exit;
        } else {
            unset($_SESSION['username']);
            $this->message (['aviso'=> 'Usuário ou senha inválidos']);
        }
    }

    public function getLoginHeaderData(string $login, string $pass): int
    {
        $data['login'] = $login;
        $data['pass'] = $pass;

        if ( $this->ckeckLogin ($data) ) {
            $_SESSION['username'] = $this->name;
            $_SESSION['level'] = strval($this->level);
            if ($this->level > 0) {
                return 2;
            }
            return 1;
        } else {
            unset($_SESSION['username']);
            return 0;
        }
    }

    private function ckeckLogin(array $data): bool
    {
        $userBD = new User();
        $user = $userBD->getLoginData ($data['login'] );

        if ( ( $data['login'] == $user['login'] ) && password_verify ($data['pass'], $user['pass']) ) {
            $this->name = $user['name'];
            $this->level = $user['level'];
            return true;
        }
        return false;
    }

    public function logout() : void
    {
        unset($_SESSION['username']);
        unset($_SESSION['level']);
        session_destroy();
        header("Location: " . URL );
    }
}