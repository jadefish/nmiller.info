<?php

namespace Application\Controllers;

final class IndexController extends \Framework\Controller
{
    public function index(int $id): void
    {
        echo __METHOD__ . "<hr>";
        var_dump(get_defined_vars());
    }
}
