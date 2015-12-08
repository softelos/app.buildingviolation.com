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

// Authentication Routes
Route::get('sign-in','Auth\AuthController@getLogin');
Route::post('sign-in','Auth\AuthController@postLogin');
Route::get('sign-out','Auth\AuthController@getLogout');

// Registration Routes
Route::get('signup-customer','Auth\AuthController@getRegisterCustomer');
Route::post('signup-customer','Auth\AuthController@postRegisterCustomer');

Route::get('signup-pro','Auth\AuthController@getRegisterPro');
Route::post('signup-pro','Auth\AuthController@postRegisterPro');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// User
Route::resource('user','UserController');
Route::get('/user/avatar/upload/{user_id}','UserController@avatar_upload');

// Site
Route::get('/','SiteController@dashboard');

// Violations
Route::resource('violation','ViolationController');
Route::get('submit-violation','ViolationController@create');
Route::get('/my-violations','ViolationController@my_violations');
Route::get('/violation/delete/{violation_id}','ViolationController@destroy');
Route::get('/get-violations','ViolationController@get_violations');
Route::get('/map/{state}','ViolationController@violation_map');

// Offers
Route::resource('offer','OfferController');
Route::get('/offer/delete/{offer_id}','OfferController@destroy');
Route::get('offer/create/{violation_id}','OfferController@create');
Route::get('offer/award/{offer_id}','OfferController@award');
Route::get('offer/remove-award/{offer_id}','OfferController@remove_award');
Route::get('/offer/submit-conditions/{offer_id}','OfferController@submit_conditions');
Route::get('/offer/accept-conditions/{offer_id}','OfferController@accept_conditions');
Route::get('/offer/pay/{offer_id}','OfferController@pay');
Route::get('/offer/payment_success/{offer_id}','OfferController@payment_success');
Route::get('/offer/payment_fail/{offer_id}','OfferController@payment_fail');
Route::get('/offer/report-completed/{offer_id}','OfferController@report_completed');

// Comment
Route::post('/offer/comment/create/{offer_id}','CommentController@store');

// Condition
Route::post('/condition/{offer_id}','ConditionController@store');
Route::get('/condition/delete/{condition_id}','ConditionController@destroy');

// Payment
Route::resource('payment','PaymentController');
Route::get('/payment/report-paid/{payment_id}','PaymentController@report_paid');
Route::get('/payment/report-unpaid/{payment_id}','PaymentController@report_unpaid');

// Rate
Route::post('/offer/rate/{offer_id}','RateController@store');
