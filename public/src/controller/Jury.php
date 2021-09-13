<?php


namespace aps\controller;

use aps\appcore\JsonMsg;
use aps\model\JuryModel;

if ( !isset($_SESSION) ) { session_start (); }

class Jury
{
    private JuryModel $jury;
    use JsonMsg;

    public function __construct ()
    {
        $this->jury = new JuryModel();
    }

    public function newJury()
    {
        $this->jury->newJury ();
    }

    public function list()
    {
        $juries = new JuryModel();
        $juries->listAll ();
    }

    public function update()
    {
        $this->jury->updateJury ();
    }

    public function delete()
    {
        $this->jury->deleteJury ();
    }
}