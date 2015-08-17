<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
//Start::API/v1/ar71xx
Route::group(array('prefix' => 'api/v1/ar71xx'), function () {
    Route::get('/', 'RouterControllerAR71XX@index');
    Route::get('/config', 'RouterControllerAR71XX@config');
    Route::get('/update/{mac}', 'RouterControllerAR71XX@update');
});
//End::API/v1/ar71xx
//Start::hotspot/hotspotlogin
Route::group(array('prefix' => 'hotspot'), function () {
    Route::get('/hotspotlogin', 'HotspotLoginController@index');
});
//End::hotspot/hotspotlogin
Route::get('deploy','Server@deploy');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);