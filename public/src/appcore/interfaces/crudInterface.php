<?php

namespace aps\appcore\interfaces;

interface crudInterface
{
    public function cadastrar() : void;
    public function list() : void;
    public function listar() : void;
    public function update() : void;
    public function prepareEdit (int $id) : void;
    public function delete() : void;

}