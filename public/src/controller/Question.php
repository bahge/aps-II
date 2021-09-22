<?php


namespace aps\controller;

use aps\appcore\interfaces\crudInterface;
use aps\controller\main\Header;
use aps\model\QuestionModel;

class Question implements crudInterface
{
    private QuestionModel $question;

    public function __construct ()
    {
        $this->question = new QuestionModel();
    }

    public function newQuestion ()
    {
        $this->question->newQuestion ();
    }
    public function cadastrar (): void
    {
        $header = new Header("Nova questão");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/admin/question/cadastrar.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function list (): void
    {
        // TODO: Implement list() method.
    }

    public function listar (): void
    {
        // TODO: Implement listar() method.
    }

    public function update (): void
    {
        // TODO: Implement update() method.
    }

    public function prepareEdit (int $id): void
    {
        // TODO: Implement prepareEdit() method.
    }

    public function delete (): void
    {
        // TODO: Implement delete() method.
    }

    public function listarPerguntas (int $pg = null) : void
    {
        $this->question->listarPerguntas ($pg);
    }

    public function responder () : void
    {
        $this->question->responder();
    }
}