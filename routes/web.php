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

$router->get('/receitas', ['uses' => 'ReceitaController@index']);

$router->group(['prefix' => 'api'], function() use ($router){
    $router->get('receitas', ['uses' => 'ReceitaController@index']);
    $router->post('receitas', ['uses' => 'ReceitaController@store']);
    $router->patch('receitas/{id}', ['uses' => 'ReceitaController@update']);
    $router->delete('receitas/{id}', ['uses' => 'ReceitaController@destroy']);
});


