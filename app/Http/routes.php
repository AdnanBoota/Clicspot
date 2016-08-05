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
Route::post("/routerConnections",'HomeController@routerConnections');
Route::post("/routerStatus","HomeController@routerStatus");
Route::get("/gocardlessDemo","Auth\AuthController@goCardlessPayment");
Route::get("/gocardlessproDemo","Auth\AuthController@goCardlessPayment2");
Route::get("/pay/confirm","Auth\AuthController@payconfirmgo2");
Route::get("/get/session","Auth\AuthController@getUsersession_token");
Route::get("/createBill","Auth\AuthController@createBill");


//Start::API/v1/ar71xx
Route::group(array('prefix' => 'api/v1/ar71xx'), function () {
    Route::get('/', 'RouterControllerAR71XX@index');
    Route::get('/config', 'RouterControllerAR71XX@config');
    Route::get('/update/{mac}', 'RouterControllerAR71XX@update');
});
Route::post('/campaignTemplate/','EmailsController@destroyEmailcampaign');
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
Route::get('feedback/{feedback_code}', 'Auth\AuthController@feedback');

Route::group(['middleware' => ['auth', 'App\Http\Middleware\AdminMiddleware']], function () {
    Route::get('/vendorList', 'VendorController@index');
    Route::get('/vendorAction/{id}', 'VendorController@getAction');
});

Route::get('sendtestCron','CronController@sendmailTestCron');
Route::get('allSubscriptioncheck','CronController@allUserSubscriptionCheck');
Route::get('feedbackMandrillReview','CronController@feedbackMandrillReview');
Route::get('emailSetupSchedulTime','CronController@emailSetupSchedulTime');
Route::get('hotspot/datatable', 'HotspotController@datatable');
Route::get('emails/getEmail', 'EmailsController@getEmail');
Route::post('emails/postEmail', 'EmailsController@postEmail');
Route::post('emails/duplicateTemplate/{id}', 'EmailsController@duplicateTemplate');
Route::post('emails/rename/{id}', 'EmailsController@rename');
Route::get('emails/emailSetup/emailTemplate','EmailCampaignController@getTemplate');
Route::post('emails/emailSetup/updateForm', 'EmailCampaignController@updateForm');

/*
 * Me@diegopucci.com @pucci_diego
 * Sending and scheduling emails.
 */
Route::post('emails/emailSetup/scheduleCampaignMail', 'EmailCampaignController@scheduleEmail');
Route::post('emails/emailSetup/{id}/scheduleCampaignMail', 'EmailCampaignController@scheduleEmail');
Route::post('emails/emailSetup/{id}/sendCampaignMail', 'EmailCampaignController@scheduleEmail');
Route::post('emails/emailSetup/sendCampaignMail', 'EmailCampaignController@scheduleEmail');

Route::get('import', 'ListImporter@importExport');
Route::get('downloadModel/{type}', 'ListImporter@downloadExcel');
Route::post('importList', 'ListImporter@importExcel');
// me@diegopucci.com END

Route::get('emails/manualMailing/{id}','EmailCampaignController@manualMailing');
Route::post('emails/emailSetup/{id}/campaignmove', 'EmailCampaignController@campaignmove');
Route::get('unsubscribe/{email}', 'EmailCampaignController@unsubscribeEmail');
Route::get('emailTrack', 'CronController@emailTrack');
Route::get('emails/report/{id}/view', 'EmailCampaignController@reportView');
Route::get('emails/transactionals/report/', 'EmailsController@reportTransactionals');
Route::resource('emails/emailSetup', 'EmailCampaignController');
Route::resource('emails/emailSetupCount', 'EmailCampaignController@socialCount');

//Route::post('emails/emailSetup/users/getStatistics/{listId}/{callFrom}', 'UsersController@getStatistics');
//Route::post('emails/emailSetup/getStatistics/{listId}/{callFrom}', 'EmailCampaignController@getStatistics');
Route::post('emails/ImageFileUpload', 'EmailsController@galleryFileUpload');
Route::get('emails/campaignTable','EmailsController@campaignTable');
Route::get('emails/review','EmailsController@emailReviews');
Route::post('emails/reviewUpdate','EmailsController@emailReviewsUpdate');
//Route::get('emails/reviewUpdate/{nasId}/{fieldName}/{fieldVal}','EmailsController@emailReviewsUpdate');
Route::get('emails/getHotspotDetail/{routerID}','EmailsController@getHotspotDetail');

Route::get('emails/reviewState/{id}','EmailsController@reviewState');
Route::resource('emails', 'EmailsController');
Route::post('users/getStatistics/{listId}/{callFrom}', 'UsersController@getStatistics');
Route::patch('users/getSt atistics/{listId}/{callFrom}', 'UsersController@getStatistics');
Route::get('users/exportUsers/{listId}/{expType}', 'UsersController@exportUsers');
Route::get('users/profile/{id}', 'UsersController@getProfile');
Route::get('users/getRecord', 'UsersController@getRecord');
Route::resource('users', 'UsersController');
Route::get('emailList/{id}/delete','EmailListController@destroy');
Route::resource('emailList', 'EmailListController');
Route::resource('hotspot', 'HotspotController');
Route::get('gallery', 'CampaignController@gallery');
Route::get('gallery/create', 'CampaignController@addgallery');
Route::post('gallery/deleteImage', 'CampaignController@deleteImage');
Route::post('galleryFileUpload', 'CampaignController@galleryFileUpload');
Route::get('Campaign', 'CampaignController@create');
Route::resource('campaign', 'CampaignController');
Route::get('updatecampaign/{id}/{campid}','CampaignController@updatecampaign');
Route::get('/facebook/login', 'FacebookLogin@login');
Route::get('/facebook/callback', 'FacebookLogin@callback');


Route::get('/google/login', 'GoogleLogin@login');
Route::get('/google/callback', 'GoogleLogin@callback');

Route::post('/email/login', 'EMailLoginController@login');

//Payment Routes Start here
Route::get('payment/billdetails','PaymentController@goCardlessNewRegistration');
Route::post('/payment/goCardless','PaymentController@goCardlessNewRegistration');
Route::get('/payment/{id}', 'PaymentController@editUser');
Route::post('/payment/updateUser', 'PaymentController@updateUser');
Route::get('/payment/goCardlessConfirm','PaymentController@goCardlessNewRegistrationConfirm');
Route::resource('payment','PaymentController');
//language
Route::post('/language',array('before'=>'csrf','as'=>'language','uses'=>'LanguageController@store'));
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

Route::get("/sparkDemo","Auth\PasswordController@sparkDemo");