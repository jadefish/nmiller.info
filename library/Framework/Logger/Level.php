<?php

/*
 * nmiller.info
 * (c) 2017 Nick Miller
 */

declare(strict_types=1);

namespace Framework\Logger;

final class Level
{
    const DEBUG = 0;
    const INFO = 1;
    const NOTICE = 2;
    const WARNING = 3;
    const ERROR = 4;
    const CRITICAL = 5;
    const ALERT = 6;
    const EMERGENCY = 7;

    private function __construct()
    {
    }
}
