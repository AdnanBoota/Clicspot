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
Route::get('emails','EmailsController@getEmail');

Route::post('emails/ImageFileUpload','EmailsController@galleryFileUpload');
//Route::post('emails/duplicate/{id}','EmailsController@duplicate');
//Route::post('emails/rename/{id}','EmailsController@rename');
Route::resource('emails','EmailsController');
Route::post('users/getStatistics/{listId}/{callFrom}', 'UsersController@getStatistics');
Route::patch('users/getSt atistics/{listId}/{callFrom}', 'UsersController@getStatistics');
Route::get('users/exportUsers/{listId}/{expType}', 'UsersController@exportUsers');
Route::get('users/profile/{id}', 'UsersController@getProfile');
Route::resource('users', 'UsersController');
Route::resource('emailList', 'EmailListController');
Route::resource('hotspot', 'HotspotController');
Route::get('gallery', 'CampaignController@gallery');
Route::get('gallery/create', 'CampaignController@addgallery');
Route::post('gallery/deleteImage', 'CampaignController@deleteImage');
Route::post('galleryFileUpload', 'CampaignController@galleryFileUpload');
Route::resource('campaign', 'CampaignController');

Route::get('/facebook/login', 'FacebookLogin@login');
Route::get('/facebook/callback', 'FacebookLogin@callback');

Route::get('/google/login', 'GoogleLogin@login');
Route::get('/google/callback', 'GoogleLogin@callback');

Route::post('/email/login', 'EMailLoginController@login');