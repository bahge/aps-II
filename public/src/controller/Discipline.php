<?php


namespace aps\controller;

use aps\appcore\JsonMsg;
use aps\model\DisciplineModel;

if ( !isset($_SESSION) ) { session_start (); }

class Discipline
{
    private DisciplineModel $discipline;
    use JsonMsg;

    public function __construct ()
    {
        $this->discipline = new DisciplineModel();
    }

    public function newDiscipline()
    {
        $this->discipline->newDiscipline ();
    }

    public function list()
    {
        $juries = new DisciplineModel();
        $juries->listAll ();
    }

    public function update()
    {
        $this->discipline->updateDiscipline ();
    }

    public function delete()
    {
        $this->discipline->deleteDiscipline ();
    }
}