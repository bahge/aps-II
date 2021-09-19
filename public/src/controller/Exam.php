<?php


namespace aps\controller;

use aps\appcore\interfaces\crudInterface;
use aps\appcore\JsonMsg;
use aps\controller\main\Header;
use aps\model\DisciplineModel;
use aps\model\ExamModel;
use aps\model\JuryModel;
use aps\model\RoleModel;
use aps\model\SubjectModel;

if ( !isset($_SESSION) ) { session_start (); }

class Exam implements crudInterface
{
    private ExamModel $exam;
    private array $cargos;
    private array $bancas;
    private array $disciplinas;
    private array $assuntos;
    use JsonMsg;

    public function __construct ()
    {
        $this->exam = new ExamModel();
    }

    public function newExam()
    {
        $this->exam->newExam ();
    }

    public function cadastrar (): void
    {
        $header = new Header("Nova prova");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/admin/exam/cadastrar.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function list (): void
    {
        $this->exam->listAll ();
    }

    public function listar (): void
    {
        $header = new Header("Nova prova");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/admin/exam/listar.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function update (): void
    {
        $this->exam->updateExam ();
    }

    public function prepareEdit (int $id): void
    {
        $roles = new RoleModel();
        $roleList = $roles->listAll (1);

        $juries = new JuryModel();
        $juryList = $juries->listAll (1);

        $disciplines = new DisciplineModel();
        $disciplineList = $disciplines->listAll (1);

        $subjects = new SubjectModel();
        $subjectList = $subjects->listAll (1);

        $data = $this->exam->editById ($id, null);
        $header = new Header("Editar prova");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/admin/exam/editar.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function delete (): void
    {
        $this->exam->deleteExam ();
    }
}