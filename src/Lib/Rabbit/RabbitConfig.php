<?php
/**
 * Created by PhpStorm.
 * User: jszutkowski
 * Date: 06.03.18
 * Time: 19:49
 */

namespace App\Lib\Rabbit;


class RabbitConfig
{
    private $host;
    private $port;
    private $user;
    private $password;

    public function __construct(string $host, string $port, string $user, string $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getPort(): string
    {
        return $this->port;
    }

    /**
     * @return mixed
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getPassword(): string
    {
        return $this->password;
    }


}