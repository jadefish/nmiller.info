<?php

require LIBRARY_PATH . "/utilities/path.php";
require path(LIBRARY_PATH, "/utilities/array_merge_recursive_distinct.php");

final class Bootstrap
{
    const PHP_SETTINGS_KEY = "php";
    const BASE_CONFIG_NAME = "base";
    const DEFAULT_ENV_FILENAME = PRIVATE_ROOT . "/.env";
    const DEFAULT_CONFIG_DIR = APPLICATION_PATH . "/config";

    private static $env = null;
    private static $config = null;

    private function __construct()
    {
    }

    private static function loadEnv(string $filename): string
    {
        return trim(file_get_contents($filename));
    }

    private static function loadConfig(string $directory): array
    {
        // Load base config:
        $baseConfig = require path(
            $directory,
            self::BASE_CONFIG_NAME . ".php"
        );

        // Load environment-specific config:
        $envConfig = require path($directory, self::$env . ".php");

        return array_merge_recursive_distinct($baseConfig, $envConfig);
    }

    public static function init(array $options)
    {
        $envFile = isset($options["envFile"])
            ? $options["envFile"]
            : self::DEFAULT_ENV_FILENAME;
        $configDir = isset($options["configDir"])
            ? $options["configDir"]
            : self::DEFAULT_ENV_FILENAME;

        self::$env = self::loadEnv($envFile);

        define("ENVIRONMENT", self::$env);

        self::$config = self::loadConfig($configDir);

        // Apply PHP settings:
        if (isset(self::$config[self::PHP_SETTINGS_KEY])) {
            $phpSettings = self::$config[self::PHP_SETTINGS_KEY];

            foreach ($phpSettings as $key => $value) {
                ini_set($key, $value);
            }
        }
    }

    public static function getEnv(): string
    {
        if (!self::$config) {
            throw new LogicException(
                "Application has not yet been initialized via init()"
            );
        }

        return self::$env;
    }

    public static function getConfig(): array
    {
        if (!self::$config) {
            throw new LogicException(
                "Application has not yet been initialized via init()"
            );
        }

        return self::$config;
    }
}
