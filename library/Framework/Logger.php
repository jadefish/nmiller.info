<?php

/*
 * nmiller.info
 * (c) 2017 Nick Miller
 */

declare(strict_types=1);

namespace Framework;

require LIBRARY_PATH . "/utilities/stringify.php";

use \Framework\Logger\AnsiAttribute;
use \Framework\Logger\Level;

final class Logger
{
    private static $attributesMap = [
        Level::DEBUG => [
            AnsiAttribute::BACKGROUND_DEFAULT,
            AnsiAttribute::FOREGROUND_BLUE
        ],
        Level::INFO => [
            AnsiAttribute::BACKGROUND_DEFAULT,
            AnsiAttribute::FOREGROUND_DEFAULT
        ],
        Level::NOTICE => [
            AnsiAttribute::BACKGROUND_DEFAULT,
            AnsiAttribute::FOREGROUND_MAGENTA
        ],
        Level::WARNING => [
            AnsiAttribute::BACKGROUND_DEFAULT,
            AnsiAttribute::FOREGROUND_YELLOW
        ],
        Level::ERROR => [
            AnsiAttribute::BACKGROUND_DEFAULT,
            AnsiAttribute::FOREGROUND_RED
        ]
    ];

    private static $levelConstantsMap = [
        Level::DEBUG => E_NOTICE,
        Level::NOTICE => E_NOTICE,
        Level::WARNING => E_WARNING,
        Level::ERROR => E_ERROR
    ];

    private function __construct()
    {
    }

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
    ): void {
        $args = array_map("stringify", $arguments);

        if (is_string($message)
            && mb_strpos($message, "%") !== false
            && count($args) > 0) {
            $message = vsprintf($message, $args);
        } elseif (count($args) > 0) {
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

    public static function debug($message = "", ...$arguments): void
    {
        // Only log if the `error_reporting` directive includes E_NOTICE:
        if (self::shouldLog(Level::DEBUG)) {
            self::emit(Level::DEBUG, $message, $arguments);
        }
    }

    public static function info($message = "", ...$arguments): void
    {
        self::emit(Level::INFO, $message, $arguments);
    }

    public static function log($message = "", ...$arguments): void
    {
        self::emit(Level::INFO, $message, $arguments);
    }

    public static function notice($message = "", ...$arguments): void
    {
        // Only log if the `error_reporting` directive includes E_NOTICE:
        if (self::shouldLog(Level::NOTICE)) {
            self::emit(Level::NOTICE, $message, $arguments);
        }
    }

    public static function warning($message = "", ...$arguments): void
    {
        // Only log if the `error_reporting` directive includes E_WARNING:
        if (self::shouldLog(Level::WARNING)) {
            self::emit(Level::WARNING, $message, $arguments);
        }
    }

    public static function error($message = "", ...$arguments): void
    {
        // Only log if the `error_reporting` directive includes E_ERROR:
        if (self::shouldLog(Level::ERROR)) {
            self::emit(Level::ERROR, $message, $arguments);
        }
    }
}
