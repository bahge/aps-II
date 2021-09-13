<?php


namespace aps\controller;

use aps\appcore\JsonMsg;
use aps\model\ExamModel;

if ( !isset($_SESSION) ) { session_start (); }

class Exam
{
    private ExamModel $exam;
    use JsonMsg;

    public function __construct ()
    {
        $this->exam = new ExamModel();
    }

    public function newExam()
    {
        $this->exam->newExam ();
    }

    public function list()
    {
        $juries = new ExamModel();
        $juries->listAll ();
    }

    public function update()
    {
        $this->exam->updateExam ();
    }

    public function delete()
    {
        $this->exam->deleteExam ();
    }
}