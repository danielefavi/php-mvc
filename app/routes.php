<?php

// registering the page 404 controller method
$router->page404('HomeController@page404');

$router->get('', 'HomeController@welcome');

$router->get('login', 'HomeController@login');
$router->post('login', 'HomeController@performLogin');
$router->post('logout', 'HomeController@logout');

$router->get('test', 'HomeController@test');
$router->get('admin/home', 'AdminController@home');

// resource: you will find the routes, controller and model for the Posts
// resource in the folder app/resources/Posts
$router->resource('admin/posts', 'Posts');

// The tasks resource is developed in the classical way: here you have to place
// all the routes and in the folder app/models you'll finde the model and
// in the app/controllers the controller
$router->get('admin/tasks', 'TaskController@index');
$router->post('admin/tasks', 'TaskController@store');
$router->post('admin/tasks/{taskId}/update', 'TaskController@update');
