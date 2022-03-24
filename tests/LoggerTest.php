<?php
/**
 * @desc LoggerTest.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/3/17 9:41
 */

namespace Tinywan\Supports\Tests;

use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\AbstractHandler;
use Psr\Log\LoggerInterface;
use Tinywan\Support\Logger;

class LoggerTest extends \PHPUnit\Framework\TestCase
{
    private Logger $logger;

    protected function setUp(): void
    {
        $this->logger = new Logger();
        $this->logger->setConfig(['file' => './tinywan.log']);
    }

    public function testGetFormatter()
    {
        self::assertInstanceOf(FormatterInterface::class, $this->logger->getFormatter());
    }

    public function testCreateFormatter()
    {
        self::assertInstanceOf(FormatterInterface::class, $this->logger->createFormatter());
    }

    public function testGetHandler()
    {
        self::assertInstanceOf(AbstractHandler::class, $this->logger->getHandler());
    }

    public function testGetLogger()
    {
        self::assertInstanceOf(LoggerInterface::class, $this->logger->getLogger());
    }

    public function testDebug()
    {
        self::assertNull($this->logger->debug('【福建省】获取培训原始解密数据', ['foo' => 'bar']));
    }

    public function testInfo()
    {
        self::assertNull($this->logger->info('test info', ['foo' => 'bar']));
    }
}