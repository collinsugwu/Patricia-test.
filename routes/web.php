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


/** @var \Laravel\Lumen\Routing\Router $router */


//<--For testing purposes

$router->get('/', 'ExampleController@ping');

$router->group(['namespace' => 'Auth'], function () use ($router) {
    $router->post('/login', 'AuthController@login');
    $router->post('/register', 'AuthController@registerUser');
    $router->group(['prefix' => '/password'], function () use ($router) {
        $router->post('/forgot', 'PasswordController@sendResetEmail');
        $router->post('/reset', 'PasswordController@resetPassword');
    });
});

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->post('posts', 'PostController@create');
});
