<?php


namespace aps\controller;

use aps\appcore\JsonMsg;
use aps\model\RoleModel;

if ( !isset($_SESSION) ) { session_start (); }

class Role
{
    private RoleModel $role;
    use JsonMsg;

    public function __construct ()
    {
        $this->role = new RoleModel();
    }

    public function newRole()
    {
        $this->role->newRole ();
    }

    public function list()
    {
        $roles = new RoleModel();
        $roles->listAll ();
    }

    public function update()
    {
        $this->role->updateRole ();
    }

    public function delete()
    {
        $this->role->deleteRole ();
    }
}