<?php

if(!isset($_SESSION)) session_start();

use aps\controller\{Home, Login, Admin, Subject, User, Jury, Role, Discipline, Exam, Question};
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;
use aps\appcore\{Auth, Email};

/* Páginas públicas */
SimpleRouter::get('/cadastrar', [User::class, 'cadastrar']);
SimpleRouter::get('/quem-somos', [Home::class, 'quemSomos']);
SimpleRouter::get('/login', [Login::class, 'loginPage']);
SimpleRouter::get('/', [Home::class, 'initialPage']);
SimpleRouter::post('/login', [Login::class, 'getLoginData']);
SimpleRouter::post ('/novo-user', [User::class, 'newUser']);

SimpleRouter::get ('/subjects', [Subject::class, 'list']);
SimpleRouter::get ('/juries', [Jury::class, 'list']);
SimpleRouter::get ('/roles', [Role::class, 'list']);
SimpleRouter::get ('/disciplines', [Discipline::class, 'list']);
SimpleRouter::get ('/exams', [Exam::class, 'list']);

SimpleRouter::get('/esqueciasenha', [User::class, 'formRecoveryPassword']);
SimpleRouter::get('/verify-recover/{verify}', [User::class, 'recoverPassword']);
SimpleRouter::post('/recuperarsenha', [Email::class, 'sendRecoveryPassword']);
SimpleRouter::post('/update-new-pass', [User::class, 'saveNewPass']);

/* Verifica se há está autenticado */
if(Auth::isAuth() OR Auth::isAuthHeader()) {

    /* Verifica se é admin */
    if(Auth::isAdmin()) {
        SimpleRouter::get('/admin', [Admin::class, 'index']);
        SimpleRouter::get('/user/gerenciar', [Admin::class, 'userManager']);
        SimpleRouter::get ('/users', [User::class, 'list']);
        SimpleRouter::get('/user/editar/{id}', [User::class, 'prepareEdit'], ['where' => ['id' => '[0-9]+']]);
        SimpleRouter::post ('/update-user', [User::class, 'update']);
        SimpleRouter::post ('/delete-user', [User::class, 'delete']);

        /* Front */
        SimpleRouter::get('/assunto/cadastrar', [Subject::class, 'cadastrar']);
        SimpleRouter::get ('/assunto/gerenciar', [Subject::class, 'listar']);
        SimpleRouter::get('/assunto/editar/{id}', [Subject::class, 'prepareEdit'], ['where' => ['id' => '[0-9]+']]);

        SimpleRouter::get ('/banca/cadastrar', [Jury::class, 'cadastrar']);
        SimpleRouter::get ('/banca/gerenciar', [Jury::class, 'listar']);
        SimpleRouter::get('/banca/editar/{id}', [Jury::class, 'prepareEdit'], ['where' => ['id' => '[0-9]+']]);

        SimpleRouter::get ('/prova/cadastrar', [Exam::class, 'cadastrar']);
        SimpleRouter::get ('/prova/gerenciar', [Exam::class, 'listar']);
        SimpleRouter::get('/prova/editar/{id}', [Exam::class, 'prepareEdit'], ['where' => ['id' => '[0-9]+']]);

        SimpleRouter::get ('/pergunta/cadastrar', [Question::class, 'cadastrar']);
        SimpleRouter::get ('/pergunta/gerenciar', [Question::class, 'listar']);

        /* API */
        SimpleRouter::post ('/novo-assunto', [Subject::class, 'newSubject']);
        SimpleRouter::post ('/update-subject', [Subject::class, 'update']);
        SimpleRouter::post ('/delete-subject', [Subject::class, 'delete']);

        SimpleRouter::post ('/nova-banca', [Jury::class, 'newJury']);
        SimpleRouter::post ('/update-jury', [Jury::class, 'update']);
        SimpleRouter::post ('/delete-jury', [Jury::class, 'delete']);

        SimpleRouter::post ('/novo-cargo', [Role::class, 'newRole']);
        SimpleRouter::post ('/update-role', [Role::class, 'update']);
        SimpleRouter::post ('/delete-role', [Role::class, 'delete']);

        SimpleRouter::post ('/nova-disciplina', [Discipline::class, 'newDiscipline']);
        SimpleRouter::post ('/update-discipline', [Discipline::class, 'update']);
        SimpleRouter::post ('/delete-discipline', [Discipline::class, 'delete']);

        SimpleRouter::post ('/novo-simulado', [Exam::class, 'newExam']);
        SimpleRouter::post ('/update-exam', [Exam::class, 'update']);
        SimpleRouter::post ('/delete-exam', [Exam::class, 'delete']);

        SimpleRouter::post ('/nova-questao', [Question::class, 'newQuestion']);
    }

    /* Usuários */
    SimpleRouter::get('/user/listar', [User::class, 'listar']);
    SimpleRouter::get('/logout', [Login::class, 'logout']);
    SimpleRouter::get('/questions', [Question::class, 'listarPerguntas']);
    SimpleRouter::get('/questions/page/{pg}', [Question::class, 'listarPerguntas'], ['where' => ['pg' => '[0-9]+']]);
    SimpleRouter::post ('/responder', [Question::class, 'responder']);


}

try {
    SimpleRouter::start();
} catch (NotFoundHttpException $e) {
    $ops = new Home();
    echo $ops->ops();
}

