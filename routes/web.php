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

$router->get('/', function () {
    return 'Hello';
});

$router->group(['prefix' => 'api'], function ($router) {
    $router->post('login','AuthController@login');
//    $router->post('register','AuthController@register');

    $router->group(['middleware' => 'auth',], function ($router) {
        $router->group(['prefix' => 'auth'], function ($router) {
            $router->delete('logout', 'AuthController@logout');
            $router->get('refresh', 'AuthController@refresh');
            $router->post('refresh', 'AuthController@refresh');
        });

        $router->group(['prefix' => 'sessions'], function ($router) {
            $router->get('', 'SessionController@index');
            $router->post('create', 'SessionController@create');
            $router->delete('destroy/{id}', 'SessionController@destroy');
        });

        $router->group(['prefix' => 'users'], function ($router) {
            $router->get('', 'UserController@index');
            $router->get('me', 'UserController@me');
            $router->get('sessions', 'UserController@sessions');
        });
    });
});
