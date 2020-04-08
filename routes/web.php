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
$router->get('/mail-preview', function () {
    return (new \App\Notifications\ForgotPassword(2313232))
        ->toMail(factory(\App\Models\Auth\User::class)->make());
});
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

    $router->post('/logout', 'Auth\AuthController@logout');

    $router->group(['namespace' => 'Account'], function () use ($router) {

        $router->group(['prefix' => 'user'], function () use ($router) {
            $router->get('/', 'UserController@fetchUser');
            $router->patch('/', 'UserController@updateUser');
            $router->patch('/password', 'UserController@updatePassword');
            $router->delete('/', 'UserController@deleteUser');
        });

    });
});
