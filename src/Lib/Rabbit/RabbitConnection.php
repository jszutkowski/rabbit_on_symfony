<?php

namespace App\Lib\Rabbit;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitConnection
{
    /**
     * @var AMQPStreamConnection
     */
    protected $connection;

    /**
     * @return AMQPChannel
     */
    protected $channel;
    /**
     * @var RabbitConfig
     */
    private $config;

    public function __construct(RabbitConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return AMQPChannel
     */
    public function getChannel(): AMQPChannel
    {
        if (!$this->channel)
        {
            $this->createConnection();
        }

        return $this->channel;
    }

    protected function createConnection()
    {
        $this->connection = new AMQPStreamConnection($this->config->getHost(), $this->config->getPort(), $this->config->getUser(), $this->config->getPassword());
        $this->channel = $this->connection->channel();
    }
}