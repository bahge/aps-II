<?php


namespace aps\appcore;

use aps\appcore\model\EmailModel;
use aps\controller\main\Header;


class Email
{
    use JsonMsg;
    public function sendRecoveryPassword()
    {
        $stream = fopen('php://input', 'r');
        if ($stream !== false) {
            $data = json_decode(stream_get_contents($stream), true);
        } else {
            $data = json_decode("{}", true);
        }

        $model = new EmailModel();
        $user = $model->fakelogin ($data['email'], $data['cpf']);

        if (array_key_exists ("aviso", $user)){
            $this->message ($user);
            exit;
        }

        $hash = time();

        $insertRecover = $model->insertPassRecovery ($hash, $user['login'], $user['id']);

        if ($insertRecover['aviso'] != "Sucesso") {
            $this->message ($insertRecover);
            exit;
        }

        $sendMail = $model->sendMail ($hash, $user['login']);

        if ($sendMail['aviso'] != "Sucesso") {
            $this->message ($sendMail);
            exit;
        }

        $this->message (['aviso' => 'Sua verificação foi cadastrada com sucesso, verifique seu e-mail.']);


    }

    public function verify(string $verify)
    {
        $model = new EmailModel();
        $a = $model->checkRecovery ($verify);
        $header = new Header("Recuperar Senha");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/user/recuperar-senha.phtml");
        include_once("src/view/main/footer.phtml");

    }
}