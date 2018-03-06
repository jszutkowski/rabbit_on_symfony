<?php
/**
 * Created by PhpStorm.
 * User: jszutkowski
 * Date: 06.03.18
 * Time: 21:00
 */

namespace App\Lib\Rabbit;


class FileExchange extends Exchange
{
    public function __construct()
    {
        $this->name = 'file_exchange';
        $this->type = ExchangeTypes::EXCHANGE_TYPE_DIRECT;
    }
}