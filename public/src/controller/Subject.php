<?php


namespace aps\controller;

if ( !isset($_SESSION) ) { session_start (); }

use aps\appcore\interfaces\crudInterface;
use aps\appcore\JsonMsg;
use aps\controller\main\Header;
use aps\model\SubjectModel;

class Subject implements crudInterface
{
    private SubjectModel $subject;
    use JsonMsg;

    public function __construct ()
    {
        $this->subject = new SubjectModel();
    }

    public function newSubject()
    {
        $this->subject->newSubject ();
    }

    public function cadastrar() : void
    {
        $header = new Header("Novo assunto");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/admin/subject/cadastrar.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function list() : void
    {
        $this->subject->listAll ();
    }

    public function listar() : void
    {
        $header = new Header("Assuntos");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/admin/subject/listar.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function update() : void
    {
        $this->subject->updateSubject ();

    }

    public function prepareEdit (int $id) : void
    {
        $data = $this->subject->editById ($id, null);
        $header = new Header("Editar Assunto");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/admin/subject/editar.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function delete() : void
    {
        $this->subject->deleteSubject ();
    }

}