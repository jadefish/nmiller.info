<?php

$router->get('/', function () {
    var_dump(get_defined_vars());
});
