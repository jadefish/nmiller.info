<?php

$router->get('/', 'IndexController@index');
$router->get('/{path:.+}', 'IndexController@document');
