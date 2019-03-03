<?php

$router->get('index', 'Controller@index');
$router->get('create', 'Controller@create');
$router->post('create', 'Controller@store');

$router->get('edit', 'Controller@edit');
$router->post('edit', 'Controller@postActions');
