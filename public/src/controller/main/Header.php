<?php

namespace aps\controller\main;

class Header
{
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle():string
    {
        return $this->title;
    }
}