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

    /**
     * RabbitConfig constructor.
     * @param $host
     * @param $port
     * @param $user
     * @param $password
     */
    public function __construct($host, $port, $user, $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


}