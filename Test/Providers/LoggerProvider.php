<?php

namespace WebStream\Log\Test\Providers;

/**
 * LoggerProvider
 * @author Ryuichi TANAKA.
 * @since 2016/01/30
 * @version 0.7
 */
trait LoggerProvider
{
    public function loggerAdapterProvider(): array
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

    public function loggerAdapterWithPlaceholderProvider(): array
    {
        return [
            ["debug", "log message for debug.", "log message for { level }.", ["level" => "debug"]],
            ["debug", "log message for debug.", "log message for {level }.", ["level" => "debug"]],
            ["debug", "log message for debug.", "log message for { level}.", ["level" => "debug"]],
            ["debug", "log message for debug.", "log message for {level}.", ["level" => "debug"]]
        ];
    }

    public function logLevelDebugProvider(): array
    {
        return [
            ["debug", true],
            ["info", true],
            ["notice", true],
            ["warn", true],
            ["warning", true],
            ["error", true],
            ["critical", true],
            ["alert", true],
            ["emergency", true],
            ["fatal", true]
        ];
    }

    public function logLevelInfoProvider(): array
    {
        return [
            ["debug", false],
            ["info", true],
            ["notice", true],
            ["warn", true],
            ["warning", true],
            ["error", true],
            ["critical", true],
            ["alert", true],
            ["emergency", true],
            ["fatal", true]
        ];
    }

    public function logLevelNoticeProvider(): array
    {
        return [
            ["debug", false],
            ["info", false],
            ["notice", true],
            ["warn", true],
            ["warning", true],
            ["error", true],
            ["critical", true],
            ["alert", true],
            ["emergency", true],
            ["fatal", true]
        ];
    }

    public function logLevelWarnProvider(): array
    {
        return [
            ["debug", false],
            ["info", false],
            ["notice", false],
            ["warn", true],
            ["warning", true],
            ["error", true],
            ["critical", true],
            ["alert", true],
            ["emergency", true],
            ["fatal", true]
        ];
    }

    public function logLevelWarningProvider(): array
    {
        return [
            ["debug", false],
            ["info", false],
            ["notice", false],
            ["warn", true],
            ["warning", true],
            ["error", true],
            ["critical", true],
            ["alert", true],
            ["emergency", true],
            ["fatal", true]
        ];
    }

    public function logLevelErrorProvider(): array
    {
        return [
            ["debug", false],
            ["info", false],
            ["notice", false],
            ["warn", false],
            ["warning", false],
            ["error", true],
            ["critical", true],
            ["alert", true],
            ["emergency", true],
            ["fatal", true]
        ];
    }

    public function logLevelCriticalProvider(): array
    {
        return [
            ["debug", false],
            ["info", false],
            ["notice", false],
            ["warn", false],
            ["warning", false],
            ["error", false],
            ["critical", true],
            ["alert", true],
            ["emergency", true],
            ["fatal", true]
        ];
    }

    public function logLevelAlertProvider(): array
    {
        return [
            ["debug", false],
            ["info", false],
            ["notice", false],
            ["warn", false],
            ["warning", false],
            ["error", false],
            ["critical", false],
            ["alert", true],
            ["emergency", true],
            ["fatal", true]
        ];
    }

    public function logLevelEmergencyProvider(): array
    {
        return [
            ["debug", false],
            ["info", false],
            ["notice", false],
            ["warn", false],
            ["warning", false],
            ["error", false],
            ["critical", false],
            ["alert", false],
            ["emergency", true],
            ["fatal", true]
        ];
    }

    public function logLevelFatalProvider(): array
    {
        return [
            ["debug", false],
            ["info", false],
            ["notice", false],
            ["warn", false],
            ["warning", false],
            ["error", false],
            ["critical", false],
            ["alert", false],
            ["emergency", false],
            ["fatal", true]
        ];
    }

    public function loggerFormatterProvider(): array
    {
        return [
            ["log.test3_1.ini", "message", "message"],
            ["log.test3_2.ini", "message", "[debug] message"],
            ["log.test3_3.ini", "message", "[DEBUG] message"],
            ["log.test3_4.ini", "message", "[debug     ] message"],
            ["log.test3_5.ini", "message", "[DEBUG     ] message"],
            ["log.test3_6.ini", "message", "[webstream.logtest] message"]
        ];
    }

    public function loggerFormatterDateTimeProvider(): array
    {
        return [
            ["log.test4_1.ini", "/(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2})/", "message", "message"],
            ["log.test4_2.ini", "/(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}\.\d{3})/", "message", "message"],
            ["log.test4_3.ini", "/(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2})/", "message", "           message"],
            ["log.test4_4.ini", "/(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}\.\d{3})/", "message", "       message"]
        ];
    }

    public function writeTimingProvider(): array
    {
        return [
            [true, "b", "a", "a", "a" . PHP_EOL . "b" . PHP_EOL . "a" . PHP_EOL],
            [false,"b", "a", "a", "b" . PHP_EOL . "a" . PHP_EOL . "a" . PHP_EOL]
        ];
    }

    public function unRotateByCycleProvider(): array
    {
        $day_of_year = 24 * 365;
        $year = date("Y");
        if (($year % 4 === 0 && $year % 100 !== 0) || $year % 400 === 0) {
            $day_of_year = 24 * 366;
        }

        return [
            ["log.test6.day.ini", 1],
            ["log.test6.day.ini", 23],
            ["log.test6.week.ini", 24],
            ["log.test6.week.ini", 24 * 7 - 1],
            ["log.test6.month.ini", 24 * intval(date("t", time())) - 1],
            ["log.test6.year.ini", $day_of_year - 1]
        ];
    }

    public function rotateByCycleProvider(): array
    {
        $day_of_month = intval(date("t", time()));
        $day_of_year = 24 * 365;
        $year = date("Y");
        if (($year % 4 === 0 && $year % 100 !== 0) || $year % 400 === 0) {
            $day_of_year = 24 * 366;
        }

        return [
            ["log.test6.day.ini", 24],
            ["log.test6.day.ini", 25],
            ["log.test6.week.ini", 24 * 7],
            ["log.test6.week.ini", 24 * 7 + 1],
            ["log.test6.month.ini", 24 * $day_of_month],
            ["log.test6.month.ini", 24 * $day_of_month + 1],
            ["log.test6.year.ini", $day_of_year],
            ["log.test6.year.ini", $day_of_year + 1]
        ];
    }
}
