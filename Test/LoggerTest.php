<?php
namespace WebStream\IO\Test;

require_once dirname(__FILE__) . '/../Logger.php';
require_once dirname(__FILE__) . '/../LoggerAdapter.php';
require_once dirname(__FILE__) . '/../LoggerConfigurationManager.php';
require_once dirname(__FILE__) . '/../Outputter/ConsoleOutputter.php';

require_once dirname(__FILE__) . '/../Test/Modules/Injector.php';
require_once dirname(__FILE__) . '/../Test/Modules/Container.php';
require_once dirname(__FILE__) . '/../Test/Modules/ValueProxy.php';

use WebStream\Log\Logger;
use WebStream\Log\LoggerAdapter;
use WebStream\Log\LoggerConfigurationManager;
use WebStream\Log\Outputter\ConsoleOutputter;
use WebStream\Container\Container;

/**
 * LoggerTest
 * @author Ryuichi TANAKA.
 * @since 2016/01/30
 */
class LoggerTest extends \PHPUnit_Framework_TestCase
{
    private function getLogger(Container $config)
    {
        $config->logPath = "";
        $config->statusPath = "";
        Logger::init($config);
        $instance = Logger::getInstance();
        $instance->setOutputter([new ConsoleOutputter()]);

        return new LoggerAdapter($instance);
    }

    /**
     * 正常系
     * LoggerAdapter経由でログが書き込めること
     * @test
     * @dataProvider loggerAdapterProvider
     */
    public function okLoggerAdapter($level)
    {
        $msg = "log message";
        $config = new Container(false);
        $config->logPath = "";
        $config->logLevel = $this->toLogLevelValue($level);
        $config->format = "[%d{%Y-%m-%d %H:%M:%S.%f}][%5L] %m";
        $logger = $this->getLogger($config);

        ob_start();
        $logger->{$level}($msg);
        $actual = ob_get_clean();

        $this->assertLog(strtoupper($level), $msg, $actual);
    }
}
