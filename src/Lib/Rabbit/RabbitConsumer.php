<?php

namespace App\Lib\Rabbit;


class RabbitConsumer
{
    /**
     * @var RabbitConnection
     */
    private $connection;


    public function __construct(RabbitConnection $connection)
    {
        $this->connection = $connection;
    }

    public function listen(Exchange $exchange, string $routingKey, callable $callback)
    {
        $channel = $this->connection->getChannel();
        $channel->exchange_declare($exchange->getName(), $exchange->getType());
        [$queueName, ,] = $channel->queue_declare('');
        $channel->queue_bind($queueName, $exchange->getName(), $routingKey);
        $channel->basic_consume($queueName, '', false, true, false, false, $callback);

        while (count($channel->callbacks))
        {
            $channel->wait();
        }
    }
}