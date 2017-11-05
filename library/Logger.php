<?php

final class Logger
{
    const ANSI_RESET = "00";
    const ANSI_FOREGROUND_DEFAULT = "39";
    const ANSI_BACKGROUND_DEFAULT = "49";

    const ANSI_ATTRIBUTE_BOLD = "1";

    const ANSI_FOREGROUND_BLACK = "0;30";
    const ANSI_FOREGROUND_RED = "0;31";
    const ANSI_FOREGROUND_GREEN = "0;32";
    const ANSI_FOREGROUND_YELLOW = "0;33";
    const ANSI_FOREGROUND_BLUE = "0;34";
    const ANSI_FOREGROUND_MAGENTA = "0;35";
    const ANSI_FOREGROUND_CYAN = "0;36";
    const ANSI_FOREGROUND_WHITE = "0;37";
    const ANSI_FOREGROUND_BRIGHT_BLACK = "1;30";
    const ANSI_FOREGROUND_BRIGHT_RED = "1;31";
    const ANSI_FOREGROUND_BRIGHT_GREEN = "1;32";
    const ANSI_FOREGROUND_BRIGHT_YELLOW = "1;33";
    const ANSI_FOREGROUND_BRIGHT_BLUE = "1;34";
    const ANSI_FOREGROUND_BRIGHT_MAGENTA = "1;35";
    const ANSI_FOREGROUND_BRIGHT_CYAN = "1;36";
    const ANSI_FOREGROUND_BRIGHT_WHITE = "1;37";

    const ANSI_BACKGROUND_BLACK = "40";
    const ANSI_BACKGROUND_RED = "41";
    const ANSI_BACKGROUND_GREEN = "42";
    const ANSI_BACKGROUND_YELLOW = "43";
    const ANSI_BACKGROUND_BLUE = "44";
    const ANSI_BACKGROUND_MAGENTA = "45";
    const ANSI_BACKGROUND_CYAN = "46";
    const ANSI_BACKGROUND_WHITE = "47";
    const ANSI_BACKGROUND_BRIGHT_BLACK = "100";
    const ANSI_BACKGROUND_BRIGHT_RED = "101";
    const ANSI_BACKGROUND_BRIGHT_GREEN = "102";
    const ANSI_BACKGROUND_BRIGHT_YELLOW = "103";
    const ANSI_BACKGROUND_BRIGHT_BLUE = "104";
    const ANSI_BACKGROUND_BRIGHT_MAGENTA = "105";
    const ANSI_BACKGROUND_BRIGHT_CYAN = "106";
    const ANSI_BACKGROUND_BRIGHT_WHITE = "107";

    const LEVEL_DEBUG = 0;
    const LEVEL_INFO = 1;
    const LEVEL_NOTICE = 2;
    const LEVEL_WARNING = 3;
    const LEVEL_ERROR = 4;

    private function __construct()
    {
    }

    private static $levelAttributesMap = [
        self::LEVEL_DEBUG => [
            self::ANSI_BACKGROUND_DEFAULT,
            self::ANSI_FOREGROUND_BLUE
        ],
        self::LEVEL_INFO => [
            self::ANSI_BACKGROUND_DEFAULT,
            self::ANSI_FOREGROUND_DEFAULT
        ],
        self::LEVEL_NOTICE => [
            self::ANSI_BACKGROUND_DEFAULT,
            self::ANSI_FOREGROUND_MAGENTA
        ],
        self::LEVEL_WARNING => [
            self::ANSI_BACKGROUND_DEFAULT,
            self::ANSI_FOREGROUND_YELLOW
        ],
        self::LEVEL_ERROR => [
            self::ANSI_BACKGROUND_DEFAULT,
            self::ANSI_FOREGROUND_RED
        ]
    ];

    private static $levelConstantsMap = [
        self::LEVEL_DEBUG => E_NOTICE,
        self::LEVEL_NOTICE => E_NOTICE,
        self::LEVEL_WARNING => E_WARNING,
        self::LEVEL_ERROR => E_ERROR
    ];

    private static function shouldLog(int $level): bool
    {
        if (!array_key_exists($level, self::$levelConstantsMap)) {
            return true;
        }

        $level = self::$levelConstantsMap[$level];

        return (error_reporting() & $level) === $level;
    }

    private static function stringify($thing): string
    {
        if (is_array($thing)) {
            return print_r($thing, true);
        } else if (is_object($thing)) {
            if (method_exists($thing, "__toString")) {
                return (string)$thing;
            }

            return print_r($thing, true);
        } else if (is_null($thing)) {
            return "null";
        } else if (is_bool($thing)) {
            return $thing ? "true" : "false";
        }

        return $thing;
    }

    private static function emit(
        int $level,
        $message = "",
        array $arguments = []
    ) {
        $args = array_map("self::stringify", $arguments);

        if (is_string($message)
            && strpos($message, "%") !== false
            && count($args) > 0) {
            $message = vsprintf($message, $args);
        } else if (count($args) > 0) {
            $message = self::stringify($message) . ", " . implode(
                ", ",
                array_map("self::stringify", $args)
            );
        } else {
            $message = self::stringify($message);
        }

        $attributes = self::$levelAttributesMap[$level];
        $attributes = implode("m\033[", $attributes);

        $format = sprintf("\033[%sm%%s\033[0m", $attributes);
        $message = vsprintf($format, $message);

        error_log($message);
    }

    public static function debug($message = "", ...$arguments)
    {
        // Only log if the `error_reporting` directive includes E_NOTICE:
        if (self::shouldLog(self::LEVEL_DEBUG)) {
            self::emit(self::LEVEL_DEBUG, $message, $arguments);
        }
    }

    public static function info($message = "", ...$arguments)
    {
        self::emit(self::LEVEL_INFO, $message, $arguments);
    }

    public static function log($message = "", ...$arguments)
    {
        self::emit(self::LEVEL_INFO, $message, $arguments);
    }

    public static function notice($message = "", ...$arguments)
    {
        // Only log if the `error_reporting` directive includes E_NOTICE:
        if (self::shouldLog(self::LEVEL_NOTICE)) {
            self::emit(self::LEVEL_NOTICE, $message, $arguments);
        }
    }

    public static function warning($message = "", ...$arguments)
    {
        // Only log if the `error_reporting` directive includes E_WARNING:
        if (self::shouldLog(self::LEVEL_WARNING)) {
            self::emit(self::LEVEL_WARNING, $message, $arguments);
        }
    }

    public static function error($message = "", ...$arguments)
    {
        // Only log if the `error_reporting` directive includes E_ERROR:
        if (self::shouldLog(self::LEVEL_ERROR)) {
            self::emit(self::LEVEL_ERROR, $message, $arguments);
        }
    }
}
