<?php

/*
 * nmiller.info
 * (c) 2017 Nick Miller
 */

declare(strict_types=1);

return [
    "php" => [
        "error_reporting" => E_ALL & ~E_NOTICE,
        "log_errors" => true,
        "error_log" => sprintf(
            "%s/logs/%s_%s.log",
            PRIVATE_ROOT,
            ENVIRONMENT,
            date("Y-m-d")
        )
    ],
    "database" => [
        "dsn" => sprintf(
            "sqlite://%s/databases/%s.sq3",
            PRIVATE_ROOT,
            ENVIRONMENT
        ),
        "options" => [
            PDO::ATTR_PERSISTENT => true
        ]
    ]
];
