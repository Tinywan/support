<?php

/**
 * @desc Logger.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/3/17 9:35
 */
declare(strict_types=1);

namespace Tinywan\Support\Logger;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class StdoutHandler extends AbstractProcessingHandler
{
    /**
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    private $output;

    /**
     * StdoutHandler constructor.
     * @param int $level
     * @param bool $bubble
     * @param OutputInterface|null $output
     */
    public function __construct($level = Logger::DEBUG, bool $bubble = true, ?OutputInterface $output = null)
    {
        $this->output = $output ?? new ConsoleOutput();

        parent::__construct($level, $bubble);
    }

    /**
     * @desc: Writes the record down to the log of the implementing handler.
     * @param array $record
     */
    protected function write(array $record): void
    {
        $this->output->writeln($record['formatted']);
    }
}
