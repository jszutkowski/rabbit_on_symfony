<?php

namespace App\Lib\Rabbit;


abstract class Exchange
{
    protected $name;
    protected $type;

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }
}