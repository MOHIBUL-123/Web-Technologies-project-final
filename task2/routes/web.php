<?php




$router->get('/genres', 'GenreController@index');
$router->get('/genres/create', 'GenreController@create');
$router->post('/genres/create', 'GenreController@create');
$router->get('/genres/edit', 'GenreController@edit');
$router->post('/genres/edit', 'GenreController@edit');
$router->post('/genres/delete', 'GenreController@delete');

$router->get('/books', 'BookController@index');
$router->get('/books/create', 'BookController@create');
$router->post('/books/create', 'BookController@create');
$router->get('/books/edit', 'BookController@edit');
$router->post('/books/edit', 'BookController@edit');
$router->post('/books/delete', 'BookController@delete');
$router->get('/books/details', 'BookController@details');

$router->get('/api/books/availability', 'BookController@availability');
$router->get('/api/books/search', 'BookController@searchApi');
