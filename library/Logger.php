<?php

require __DIR__ . "/utilities/stringify.php";

use Logger\{AnsiAttribute, Level as LogLevel};

final class Logger
{
    private function __construct() {}

    private static $attributesMap = [
        LogLevel::DEBUG => [
            AnsiAttribute::BACKGROUND_DEFAULT,
            AnsiAttribute::FOREGROUND_BLUE
        ],
        LogLevel::INFO => [
            AnsiAttribute::BACKGROUND_DEFAULT,
            AnsiAttribute::FOREGROUND_DEFAULT
        ],
        LogLevel::NOTICE => [
            AnsiAttribute::BACKGROUND_DEFAULT,
            AnsiAttribute::FOREGROUND_MAGENTA
        ],
        LogLevel::WARNING => [
            AnsiAttribute::BACKGROUND_DEFAULT,
            AnsiAttribute::FOREGROUND_YELLOW
        ],
        LogLevel::ERROR => [
            AnsiAttribute::BACKGROUND_DEFAULT,
            AnsiAttribute::FOREGROUND_RED
        ]
    ];

    private static $levelConstantsMap = [
        LogLevel::DEBUG => E_NOTICE,
        LogLevel::NOTICE => E_NOTICE,
        LogLevel::WARNING => E_WARNING,
        LogLevel::ERROR => E_ERROR
    ];

    private static function shouldLog(int $level): bool
    {
        if (!array_key_exists($level, self::$levelConstantsMap)) {
            return true;
        }

        $level = self::$levelConstantsMap[$level];

        return (error_reporting() & $level) === $level;
    }

    private static function emit(
        int $level,
        $message = "",
        array $arguments = []
    ) {
        $args = array_map("stringify", $arguments);

        if (is_string($message)
            && strpos($message, "%") !== false
            && count($args) > 0) {
            $message = vsprintf($message, $args);
        } else if (count($args) > 0) {
            $message = stringify($message) . ", " . implode(
                ", ",
                array_map("stringify", $args)
            );
        } else {
            $message = stringify($message);
        }

        $attributes = self::$attributesMap[$level];
        $attributes = implode("m\033[", $attributes);

        $format = sprintf("\033[%sm%%s\033[0m", $attributes);
        $message = vsprintf($format, $message);

        error_log($message);
    }

    public static function debug($message = "", ...$arguments)
    {
        // Only log if the `error_reporting` directive includes E_NOTICE:
        if (self::shouldLog(LogLevel::DEBUG)) {
            self::emit(LogLevel::DEBUG, $message, $arguments);
        }
    }

    public static function info($message = "", ...$arguments)
    {
        self::emit(LogLevel::INFO, $message, $arguments);
    }

    public static function log($message = "", ...$arguments)
    {
        self::emit(LogLevel::INFO, $message, $arguments);
    }

    public static function notice($message = "", ...$arguments)
    {
        // Only log if the `error_reporting` directive includes E_NOTICE:
        if (self::shouldLog(LogLevel::NOTICE)) {
            self::emit(LogLevel::NOTICE, $message, $arguments);
        }
    }

    public static function warning($message = "", ...$arguments)
    {
        // Only log if the `error_reporting` directive includes E_WARNING:
        if (self::shouldLog(LogLevel::WARNING)) {
            self::emit(LogLevel::WARNING, $message, $arguments);
        }
    }

    public static function error($message = "", ...$arguments)
    {
        // Only log if the `error_reporting` directive includes E_ERROR:
        if (self::shouldLog(LogLevel::ERROR)) {
            self::emit(LogLevel::ERROR, $message, $arguments);
        }
    }
}
