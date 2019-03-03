<?php

$router->page404('HomeController@page404');

$router->get('', 'HomeController@welcome');

$router->get('login', 'HomeController@login');
$router->post('login', 'HomeController@performLogin');
$router->post('logout', 'HomeController@logout');

$router->get('admin/home', 'AdminController@home');


$router->resource('admin/posts', 'Posts');
