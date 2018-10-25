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

$router->group(['prefix' => 'api/v1/'], function() use ($router) {
    // Users
    $router->get('users', 'UsersController@index');
    $router->post('user', 'UsersController@store');
    $router->get('user/{id}', 'UsersController@get');
    $router->put('user/{id}', 'UsersController@update');
    $router->delete('user/{id}', 'UsersController@delete');

    // Movies
    $router->get('movies', 'MoviesController@index');
    $router->post('movie', 'MoviesController@store');
    $router->get('movie/{id}', 'MoviesController@get');
    $router->put('movie/{id}', 'MoviesController@update');
    $router->delete('movie/{id}', 'MoviesController@delete');
});
