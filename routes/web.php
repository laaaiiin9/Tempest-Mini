<?php

$router->addRouter('/', 'GET', 'HomeController@index');
$router->addRouter('/users', 'GET', 'UserController@index');
$router->addRouter('/user/{id}', 'GET', 'UserController@getUser');