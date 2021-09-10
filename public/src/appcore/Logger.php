<?php

namespace aps\appcore;

trait Logger
{
    public function Log(string $msg)
    {
        $fp = fopen("./logger.txt","a");
        $date = date('Y-m-d');
        fwrite($fp,$date . ": " . $msg);
        fclose($fp);
    }
}