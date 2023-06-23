<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/test', function () use ($router) {
    return "Mode testing";
});
$router->get('/hello', 'Controller@index');

//books
$router->group(['prefix' => 'books'], function () use ($router) {
    $router->get('/', 'BooksController@index');
    $router->post('/', 'BooksController@store');
    $router->get('/{book}', 'BooksController@show');
    $router->put('/{book}', 'BooksController@update');
    $router->delete('/{book}/hard', 'BooksController@destroy');
    //softdelete
    $router->delete('/{book}', 'BooksController@softdestroy');
});

