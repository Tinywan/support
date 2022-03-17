<?php
/**
 * @desc LoggerTest.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/3/17 9:41
 */

declare(strict_types=1);

namespace Tinywan\Support\Tests;

use Monolog\Formatter\FormatterInterface;
use Tinywan\Support\Logger;

class LoggerTest extends \PHPUnit\Framework\TestCase
{
    private $logger;

    protected function setUp(): void
    {
        $this->logger = new Logger();
        $this->logger->setConfig(['file' => './test.log']);
    }

    public function testGetFormatter()
    {
        self::assertInstanceOf(FormatterInterface::class, $this->logger->getFormatter());
    }

    public function testSetFormatter()
    {
        self::assertInstanceOf($this->logger->debug('test debug', ['foo' => 'bar']));
    }

    public function testDebug()
    {
        self::assertNull($this->logger->debug('test debug', ['foo' => 'bar']));
    }

    public function testInfo()
    {
        self::assertNull($this->logger->info('test info', ['foo' => 'bar']));
    }
}