<?php

$router->addRouter('/', 'GET', 'HomeController@index');
$router->addRouter('/login', 'GET', 'Auth/AuthController@index');
$router->addRouter('/register', 'GET', 'Auth/RegisterController@index');
$router->addRouter('/register', 'POST', 'Auth/RegisterController@register');

$router->addRouter('/users', 'GET', 'UserController@index');
$router->addRouter('/user/add', 'GET', 'UserController@addUser');
$router->addRouter('/user/{id}', 'GET', 'UserController@getUser');

$router->addRouter('/admin', 'GET', 'Admin/DashboardController@index');