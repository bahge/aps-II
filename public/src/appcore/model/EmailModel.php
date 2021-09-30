<?php

namespace aps\appcore\model;

use aps\model\repository\crud;
use aps\model\UserModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class EmailModel extends crud
{

    public function fakelogin (string $login, string $cpf ): array
    {
        $user = new UserModel();
        $idUser = $user->read (
            "user",
            "WHERE login=:login AND cpf=:cpf LIMIT 1",
            "login={$login}&cpf={$cpf}",
            ['id', 'login']
        );

        if(!isset($idUser[0]['id'])){
            return ['aviso' => 'Usuário ou cpf não cadastrados!'];
        }

        return ['id' => $idUser[0]['id'], 'login' => $idUser[0]['login']];
    }

    public function insertPassRecovery(string $hash, string $login, int $idUser): array
    {
        $data = ['verificacao' => $hash, 'id_user' => $idUser, 'login' => $login];
        $insert = new crud();
        $return = $insert->insert ('passrecovery', $data);
        if ($return) {
            return ['aviso' => 'Sucesso'];
        } else {
            return ['aviso' => $return['erro']];
        }
    }

    public function sendMail(string $hash, string $login)
    {
        $msg = $this->createMsg ($hash);
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = getenv('MAILSMTP');
        $mail->Port = getenv('MAILPORT');
        $mail->SMTPAuth = true;
        $mail->Username = getenv('MAILUSER');
        $mail->Username = getenv('MAILPASS');
        $mail->setFrom('recoverypass@mandala.com', 'Mandala Infor');
        $mail->addAddress($login, 'Usuário Mandala');
        $mail->Subject = 'Recuperação de senha - Mandala';
        $mail->msgHTML($msg['html']);
        $mail->AltBody = $msg['txt'];

        if (!$mail->send()) {
            return ['aviso' => $mail->ErrorInfo];
        } else {
            return ['aviso' => 'Sucesso'];
        }
    }

    private function createMsg($hash): array
    {
        $html = "Olá, uma recuperação de senha foi solicitada no site Mandala.<br>";
        $html .= "<p>Se foi você, clique no link abaixo para redefinir sua senha.</p>";
        $html .= "<a href=\"" . URL . "/verify-recover/{$hash}\">Redefinir senha</a><br>";
        $html .= "<br>";
        $html .= "Atenciosamente, Equipe Mandala.";

        $txt = "Olá, uma recuperação de senha foi solicitada no site Mandala.\n";
        $txt .= "Se foi você, acesse o link abaixo para redefinir sua senha.\n";
        $txt .=  URL . "/verify-recover/{$hash}\n";
        $txt .= "\n";
        $txt .= "Atenciosamente, Equipe Mandala.";

        return ['html' => $html, 'txt' => $txt];
    }

    public function checkRecovery(string $hash): array
    {
        $crud = new crud();
        $check = $crud->read (
            "passrecovery",
            "WHERE verificacao=:verificacao AND modified IS NULL",
            "verificacao={$hash}",
            ['id', 'login', 'id_user']
        );

        if(!isset($check[0]['id'])){
            return ['aviso' => 'Link expirado!'];
        } else {
            return $check[0];
        }
    }
}
