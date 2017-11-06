<?php

/*
 * nmiller.info
 * (c) 2017 Nick Miller
 */

declare(strict_types=1);

namespace Framework\Logger;

final class AnsiAttribute
{
    const RESET = "00";

    const FOREGROUND_DEFAULT = "39";
    const BACKGROUND_DEFAULT = "49";

    const BOLD = "1";

    const FOREGROUND_BLACK = "0;30";
    const FOREGROUND_RED = "0;31";
    const FOREGROUND_GREEN = "0;32";
    const FOREGROUND_YELLOW = "0;33";
    const FOREGROUND_BLUE = "0;34";
    const FOREGROUND_MAGENTA = "0;35";
    const FOREGROUND_CYAN = "0;36";
    const FOREGROUND_WHITE = "0;37";
    const FOREGROUND_BRIGHT_BLACK = "1;30";
    const FOREGROUND_BRIGHT_RED = "1;31";
    const FOREGROUND_BRIGHT_GREEN = "1;32";
    const FOREGROUND_BRIGHT_YELLOW = "1;33";
    const FOREGROUND_BRIGHT_BLUE = "1;34";
    const FOREGROUND_BRIGHT_MAGENTA = "1;35";
    const FOREGROUND_BRIGHT_CYAN = "1;36";
    const FOREGROUND_BRIGHT_WHITE = "1;37";

    const BACKGROUND_BLACK = "40";
    const BACKGROUND_RED = "41";
    const BACKGROUND_GREEN = "42";
    const BACKGROUND_YELLOW = "43";
    const BACKGROUND_BLUE = "44";
    const BACKGROUND_MAGENTA = "45";
    const BACKGROUND_CYAN = "46";
    const BACKGROUND_WHITE = "47";
    const BACKGROUND_BRIGHT_BLACK = "100";
    const BACKGROUND_BRIGHT_RED = "101";
    const BACKGROUND_BRIGHT_GREEN = "102";
    const BACKGROUND_BRIGHT_YELLOW = "103";
    const BACKGROUND_BRIGHT_BLUE = "104";
    const BACKGROUND_BRIGHT_MAGENTA = "105";
    const BACKGROUND_BRIGHT_CYAN = "106";
    const BACKGROUND_BRIGHT_WHITE = "107";

    private function __construct()
    {
    }
}
