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
    $router->get('recipes', ['uses' => 'RecipeController@index']);
    $router->post('recipes/filter', 'RecipeController@filter');
    $router->get('recipes/{id:[0-9]+}', ['uses' => 'RecipeController@show']);
    $router->post('recipes', ['uses' => 'RecipeController@store']);
    $router->put('recipes/{id}', ['uses' => 'RecipeController@update']);
    $router->delete('recipes/{id}', ['uses' => 'RecipeController@destroy']);
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('categories', ['uses' => 'CategoryController@index']);
    $router->get('categories/{id}', ['uses' => 'CategoryController@show']);
    $router->post('categories', ['uses' => 'CategoryController@store']);
    $router->put('categories/{id}', ['uses' => 'CategoryController@update']);
    $router->delete('categories/{id}', ['uses' => 'CategoryController@destroy']);
});

