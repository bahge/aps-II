<?php

namespace aps\controller\main;

class Footer
{
    private array $scripts;

    public function __construct(string $scripts)
    {
        $this->scripts = $scripts;
    }

    public function getScripts():string
    {
        return $this->scripts;
    }
}