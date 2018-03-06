<?php
/**
 * Created by PhpStorm.
 * User: jszutkowski
 * Date: 06.03.18
 * Time: 21:04
 */

namespace App\Lib\Rabbit;


use JsonSerializable;

class FileMessage implements JsonSerializable
{

    private $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function jsonSerialize()
    {
        return ['filename' => $this->filename];
    }
}