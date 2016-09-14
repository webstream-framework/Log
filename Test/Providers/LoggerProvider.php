<?php
namespace WebStream\Log\Test\Providers;

// use WebStream\Module\Container;
// use WebStream\Cache\Driver\Apcu;

/**
 * LoggerProvider
 * @author Ryuichi TANAKA.
 * @since 2016/01/30
 * @version 0.7
 */
trait LoggerProvider
{
    public function loggerAdapterProvider()
    {
        return [
            ["debug"],
            ["info"],
            ["notice"],
            ["warn"],
            ["warning"],
            ["error"],
            ["critical"],
            ["alert"],
            ["emergency"],
            ["fatal"]
        ];
    }
}
