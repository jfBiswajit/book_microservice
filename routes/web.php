<?php

$router->get('/authors', 'AuthorController@index');
$router->post('/authors', 'AuthorController@create');
$router->get('/authors/{id}', 'AuthorController@show');
$router->put('/authors/{id}', 'AuthorController@update');
$router->patch('/authors/{id}', 'AuthorController@update');
$router->delete('/authors/{id}', 'AuthorController@destroy');
