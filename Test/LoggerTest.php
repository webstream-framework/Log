<?php
namespace WebStream\Log\Test;

require_once dirname(__FILE__) . '/../Logger.php';
require_once dirname(__FILE__) . '/../LoggerAdapter.php';
require_once dirname(__FILE__) . '/../LoggerConfigurationManager.php';
require_once dirname(__FILE__) . '/../Outputter/IOutputter.php';
require_once dirname(__FILE__) . '/../Outputter/ILazyWriter.php';
require_once dirname(__FILE__) . '/../Outputter/FileOutputter.php';
require_once dirname(__FILE__) . '/../Outputter/ConsoleOutputter.php';

require_once dirname(__FILE__) . '/../Modules/Container/Container.php';
require_once dirname(__FILE__) . '/../Modules/Container/ValueProxy.php';

require_once dirname(__FILE__) . '/Providers/LoggerProvider.php';


use WebStream\Log\Logger;
use WebStream\Log\LoggerAdapter;
use WebStream\Log\LoggerConfigurationManager;
use WebStream\Log\Outputter\ConsoleOutputter;
use WebStream\Container\Container;

use WebStream\Log\Test\Providers\LoggerProvider;

/**
 * LoggerTest
 * @author Ryuichi TANAKA.
 * @since 2016/01/30
 */
class LoggerTest extends \PHPUnit_Framework_TestCase
{
    use LoggerProvider;

    private function getLogger(string $logPath)
    {
        Logger::init($logPath);
        $instance = Logger::getInstance();
        $instance->setOutputter([new FileOutputter, new ConsoleOutputter()]);

        return new LoggerAdapter($instance);
    }

    private function assertLog($level, $msg, $logLine)
    {
        if (preg_match('/^\[\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}\..{3}\]\[(.+?)\]\s(.*)$/', $logLine, $matches)) {
            $target = [$level, $msg];
            $result = [trim($matches[1]), $matches[2]];
            $this->assertEquals($target, $result);
        } else {
            $this->assertTrue(false);
        }
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
        $logPath = dirname(__FILE__) . "/Fixtures/log.test1.${level}.ini";
        $logger = $this->getLogger($config);

        ob_start();
        $logger->{$level}($msg);
        $actual = ob_get_clean();

        $this->assertLog(strtoupper($level), $msg, $actual);
    }
}
