<?php

$router->get('index', 'Controller@index');
$router->get('create', 'Controller@create');
$router->post('create', 'Controller@store');

$router->get('{postId}/edit', 'Controller@edit');
$router->post('{postId}/edit', 'Controller@update');
$router->post('{postId}/delete', 'Controller@delete');
