<?php
/**
 * Created by PhpStorm.
 * User: jszutkowski
 * Date: 06.03.18
 * Time: 21:06
 */

namespace App\Lib\Communication;


use App\Lib\Exception\FileNotFoundException;
use App\Lib\File\FileHandlerInterface;
use App\Lib\Rabbit\FileExchange;
use App\Lib\Rabbit\RabbitConsumer;
use App\Lib\Rabbit\Routes;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Console\Output\OutputInterface;

class MessageConsumer
{

    /**
     * @var RabbitConsumer
     */
    private $consumer;
    /**
     * @var FileHandlerInterface
     */
    private $handler;

    public function __construct(RabbitConsumer $consumer, FileHandlerInterface $handler)
    {
        $this->consumer = $consumer;
        $this->handler = $handler;
    }

    public function consume(OutputInterface $output): void
    {
        $this->consumer->listen(new FileExchange(), Routes::ROUTE_SEND_FILENAME, $this->getCallback($output));
    }

    private function getCallback(OutputInterface $output): callable
    {
        return function (AMQPMessage $message) use ($output) {

            $filePath = $this->getFilePath($message);

            try {
                $this->handler->putContent($filePath, time());
                $output->writeln('Changed: ' . $filePath);

            } catch (FileNotFoundException $e) {
                $output->writeln('Cannot change file: ' . $filePath);
            }

        };
    }

    private function getFilePath(AMQPMessage $message): string
    {
        $body = $message->getBody();
        $decoded = json_decode($body, true);

        if ($decoded === false) {
            return '';
        }

        return $decoded['filename'] ?? '';
    }


}