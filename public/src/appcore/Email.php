<?php


namespace aps\appcore;

use aps\appcore\model\EmailModel;
use aps\controller\main\Header;


class Email
{
    use JsonMsg;
    public function sendRecoveryPassword()
    {
        $json = file_get_contents ('php://input');
        $data = json_decode ($json, true);

        $model = new EmailModel();
        $user = $model->fakelogin ($data['login'], $data['cpf']);

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
}