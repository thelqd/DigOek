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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1', 'middleware' => 'auth'], function($router)
{
    $router->get('test', [
        'uses' => 'TestController@test',
        'as' => 'test'
    ]);
    $router->group(['prefix' => 'public'], function($router)
    {
        $router->get('search', [
            'uses' => 'HotelController@search',
            'as' => 'hotelsearch'
        ]);

        $router->get('hotel/{id}', [
            'uses' => 'HotelController@get',
            'as' => 'gethotel'
        ]);

        $router->put('rate/{id}', [
            'uses' => 'HotelController@rate',
            'as' => 'rate'
        ]);

        $router->get('rate/{id}', [
            'uses' => 'HotelController@getRating',
            'as' => 'getrate'
        ]);

        $router->put('login', [
            'uses' => 'UserController@login',
            'as' => 'login'
        ]);

        $router->put('logout', [
            'uses' => 'UserController@logout',
            'as' => 'logout'
        ]);

        $router->post('book/{hotelId}/{roomName}', [
            'uses' => 'BookingController@book',
            'as' => 'booking'
        ]);
    });

    $router->group(['prefix' => 'api'], function($router)
    {
        $router->get('hotels', [
            'uses' => 'ApiController@get',
            'as' => 'getallhotels'
        ]);

        $router->put('hotel', [
            'uses' => 'ApiController@create',
            'as' => 'updatehotel'
        ]);

        $router->delete('hotel/{id}', [
            'uses' => 'ApiController@delete',
            'as' => 'deletehotel'
        ]);

        $router->post('hotel/{id}', [
            'uses' => 'ApiController@update',
            'as' => 'updatehotel'
        ]);
    });
});
