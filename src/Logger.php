<?php
/**
 * @desc Logger.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/3/24 14:10
 */
declare(strict_types=1);

namespace Tinywan\Support;

use Exception;
use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as KernelLogger;
use Psr\Log\LoggerInterface;

/**
 * Class Logger.
 *
 * @method static void emergency($message, array $context = [])
 * @method static void alert($message, array $context = [])
 * @method static void critical($message, array $context = [])
 * @method static void error($message, array $context = [])
 * @method static void warning($message, array $context = [])
 * @method static void notice($message, array $context = [])
 * @method static void info($message, array $context = [])
 * @method static void debug($message, array $context = [])
 * @method static void log($message, array $context = [])
 */
class Logger
{
    protected ?LoggerInterface $logger = null;

    protected ?FormatterInterface $formatter = null;

    protected ?AbstractProcessingHandler $handler = null;

    protected array $config = [
        'file' => null,
        'identify' => 'default',
        'level' => KernelLogger::DEBUG,
        'type' => 'daily',
        'max_files' => 30,
    ];

    /**
     * Logger constructor.
     */
    public function __construct(array $config = [])
    {
        // 初始化配置文件
        $this->setConfig($config);
    }

    /**
     * @desc: $this->logger->debug
     *
     * @throws Exception
     */
    public function __call(string $method, array $args): void
    {
        call_user_func_array([$this->getLogger(), $method], $args);
    }

    /**
     * Set logger.
     */
    public function setLogger(LoggerInterface $logger): Logger
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * Return the logger instance.
     *
     * @throws Exception
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger ??= $this->createLogger();
    }

    /**
     * @desc: 方法描述
     */
    public function createLogger(): KernelLogger
    {
        $handler = $this->getHandler();

        $handler->setFormatter($this->getFormatter());

        // 创建日志频道 new Logger('tinywan');
        $logger = new KernelLogger($this->config['identify']);

        // 添加handler
        // $log->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING));
        $logger->pushHandler($handler);

        return $logger;
    }

    /**
     * setFormatter.
     *
     * @return $this
     */
    public function setFormatter(FormatterInterface $formatter): self
    {
        $this->formatter = $formatter;

        return $this;
    }

    /**
     * getFormatter.
     */
    public function getFormatter(): FormatterInterface
    {
        return $this->formatter ??= $this->createFormatter();
    }

    /**
     * createFormatter.
     */
    public function createFormatter(): LineFormatter
    {
        return new LineFormatter(
            "[%datetime%][%level_name%] %message% %context% %extra%\n\n",
            'Y-m-d H:i:s',
            true,
            true
        );
    }

    /**
     * setHandler.
     *
     * @return $this
     */
    public function setHandler(AbstractProcessingHandler $handler): self
    {
        $this->handler = $handler;

        return $this;
    }

    public function getHandler(): AbstractProcessingHandler
    {
        return $this->handler ??= $this->createHandler();
    }

    /**
     * @desc: 创建 handler 日志管理器
     * 函数：sys_get_temp_dir — 返回用于临时文件的目录
     *
     * @author Tinywan(ShaoBo Wan)
     */
    public function createHandler(): AbstractProcessingHandler
    {
        // 获取日志文件路径
        $file = $this->config['file'] ?? sys_get_temp_dir().'/logs/'.$this->config['identify'].'.log';

        if ('single' === $this->config['type']) {
            return new StreamHandler($file, $this->config['level']);
        }

        return new RotatingFileHandler($file, $this->config['max_files'], $this->config['level']);
    }

    /**
     * setConfig.
     *
     * @return $this
     */
    public function setConfig(array $config): self
    {
        $this->config = array_merge($this->config, $config);

        return $this;
    }

    /**
     * getConfig.
     */
    public function getConfig(): array
    {
        return $this->config;
    }
}
