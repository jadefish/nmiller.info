<?php

namespace Application\Exceptions;

use Exception;

class FileNotFoundException extends Exception
{
    public function __construct(string $filename)
    {
        parent::__construct("'{$filename}' cannot be found");
    }
}
