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
Route::get('/home', 'HomeController@index');

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
    Route::get('/login', 'HotspotLoginController@login');
});
//End::hotspot/hotspotlogin
Route::get('deploy', 'Server@deploy');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('verify/{verification_code}', 'Auth\AuthController@verify');

Route::group(['middleware' => ['auth', 'App\Http\Middleware\AdminMiddleware']], function () {
    Route::get('/vendorList', 'VendorController@index');
    Route::get('/vendorAction/{id}', 'VendorController@getAction');

});
Route::get('hotspot/datatable','HotspotController@datatable');
Route::resource('hotspot', 'HotspotController');
Route::resource('campaign', 'CampaignController');

Route::get('/facebook/login', 'FacebookLogin@login');
Route::get('/facebook/callback', 'FacebookLogin@callback');