<?php


namespace aps\appcore;

if(!isset($_SESSION)) {session_start () ; }

trait JsonMsg
{
    public function message(array $msg):void
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode ($msg);
    }
}