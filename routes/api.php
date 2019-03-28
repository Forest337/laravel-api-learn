<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\V1'], function ($api) {
    $api->group(['prefix' => 'auth',], function ($api) {
        $api->post('token', 'AuthController@registerClient');
        $api->put('refresh', 'AuthController@refreshToken');
    });

    $api->group([], function ($api) {
        $api->post('messages', 'MessageController@store');
        $api->get('messages/{id}', 'MessageController@show');
        $api->get('messages/detail/{id}', 'MessageController@detail');
    });
});
