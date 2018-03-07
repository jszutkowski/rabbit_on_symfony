<?php
/**
 * Created by PhpStorm.
 * User: jszutkowski
 * Date: 06.03.18
 * Time: 19:18
 */

namespace App\Command;


use App\Lib\Communication\MessageConsumer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConsumeMessageCommand extends Command
{
    /**
     * @var MessageConsumer
     */
    private $consumer;

    public function __construct(MessageConsumer $consumer)
    {
        parent::__construct(null);
        $this->consumer = $consumer;
    }

    protected function configure()
    {
        $this
            ->setName('message:consume')
            ->setDescription('Consume messages');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->consumer->consume($output);
    }
}