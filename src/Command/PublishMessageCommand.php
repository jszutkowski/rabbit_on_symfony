<?php
/**
 * Created by PhpStorm.
 * User: jszutkowski
 * Date: 06.03.18
 * Time: 19:17
 */

namespace App\Command;

use App\Lib\Communication\MessagePublisher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PublishMessageCommand extends Command
{
    /**
     * @var MessagePublisher
     */
    private $publisher;

    public function __construct(MessagePublisher $publisher)
    {
        $this->publisher = $publisher;
        parent::__construct(null);
    }

    protected function configure()
    {
        $this
            ->setName('message:publish')
            ->setDescription('Publish messages');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->publisher->sendMessages(__DIR__ . '/../../files');
        $output->writeln('Published');
    }
}