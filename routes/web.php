<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/api/movies', 'MoviesController@index');
$router->post('/api/movie', 'MoviesController@store');
$router->get('/api/movie/{id}', 'MoviesController@get');
$router->put('/api/movie/{id}', 'MoviesController@update');
$router->delete('/api/movie/{id}', 'MoviesController@delete');
