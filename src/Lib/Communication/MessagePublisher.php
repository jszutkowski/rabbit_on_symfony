<?php
/**
 * Created by PhpStorm.
 * User: jszutkowski
 * Date: 06.03.18
 * Time: 20:55
 */

namespace App\Lib\Communication;


use App\Lib\Exception\InvalidPathException;
use App\Lib\File\FileListReaderInterface;
use App\Lib\Rabbit\FileExchange;
use App\Lib\Rabbit\FileMessage;
use App\Lib\Rabbit\RabbitConnection;
use App\Lib\Rabbit\RabbitPublisher;
use App\Lib\Rabbit\Routes;

class MessagePublisher
{

    /**
     * @var FileListReaderInterface
     */
    private $fileListReader;
    /**
     * @var RabbitConnection
     */
    private $connection;

    /**
     * @var RabbitPublisher|null
     */
    private $publisher;

    public function __construct(FileListReaderInterface $fileListReader, RabbitConnection $connection)
    {
        $this->fileListReader = $fileListReader;
        $this->connection = $connection;
    }

    public function sendMessages(string $path)
    {
        $fileList = $this->getFileList($path);

        if (!$fileList) {
            return ;
        }

        $publisher = $this->getPublisher();

        foreach ($fileList as $file) {
            $publisher->send(Routes::ROUTE_SEND_FILENAME, new FileMessage($file));
        }
    }

    private function getFileList(string $path): array
    {
        try {
            return $this->fileListReader->getFileList($path);
        } catch (InvalidPathException $e) {
            return [];
        }
    }

    private function getPublisher()
    {
        if (!$this->publisher) {
            $this->publisher = new RabbitPublisher($this->connection, new FileExchange());
        }

        return $this->publisher;
    }

}