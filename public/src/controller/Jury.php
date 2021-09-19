<?php


namespace aps\controller;

use aps\appcore\interfaces\crudInterface;
use aps\appcore\JsonMsg;
use aps\controller\main\Header;
use aps\model\JuryModel;

if ( !isset($_SESSION) ) { session_start (); }

class Jury implements crudInterface
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

    public function cadastrar() : void
    {
        $header = new Header("Nova Banca");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/admin/jury/cadastrar.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function list() : void
    {
        $juries = new JuryModel();
        $juries->listAll ();
    }

    public function listar() : void
    {
        $header = new Header("Bancas");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/admin/jury/listar.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function update() : void
    {
        $this->jury->updateJury ();
    }

    public function prepareEdit (int $id) : void
    {
        $data = $this->jury->editById ($id, null);
        $header = new Header("Editar Banca");
        include_once("src/view/main/header.phtml");
        include_once("src/view/main/menu.phtml");
        include_once("src/view/admin/jury/editar.phtml");
        include_once("src/view/main/footer.phtml");
    }

    public function delete() : void
    {
        $this->jury->deleteJury ();
    }
}