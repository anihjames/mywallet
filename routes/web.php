<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=> 'auth'], function() {

    Route::get('/login', [
        'uses'=> 'UserController@loginview',
        'as'=> 'login',
        'middleware'=> 'guest',
    ]);
    
    Route::get('/register', [
        'uses'=> 'UserController@registerview',
        'as'=> 'register',
        'middleware'=> 'guest'
    ]);

    Route::post('/sigin', [
        'uses'=> 'UserController@Login',
        'as'=> 'sigin'
    ]);
    
    Route::post('/signup', [
        'uses'=> 'UserController@Register',
        'as'=> 'signup',
    ]);

    Route::get('/resetform', [
        'uses'=> 'UserController@passwordresetForm',
        'as'=> 'passwordresetform'
    ]);
    Route::get('/verify/{token}', 'UserController@verifyUser');
    Route::get('/resetPassword/{token}','UserController@resetPassword');
    
    Route::get('/resend', [
        'uses'=>'UserController@resendcode',
        'as'=> 'resend'
    ]);
    
    Route::post('/sendresetlink', [
        'uses'=> 'UserController@passwordRecovery',
        'as'=> 'resetlink',
    ]);
    
    Route::post('/changepassword', [
        'uses'=> 'UserController@changePassword',
        'as'=> 'changepassword'
    ]);
    
    Route::get('/resetpassword', [
        'uses'=> 'UserController@reset',
        'as'=> 'reset'
    ]);

    Route::get('/logout', [
        'uses'=> 'UserController@Logout',
        'as'=> 'logout'
    ]);


});

Route::get('/home', [
    'uses'=> 'DashboardController@index',
    'as'=> 'home',
    'middleware'=> ['auth', 'verifyaccount']
]);

Route::group(['prefix'=> 'user'], function() {

   Route::get('/paybills', [
    'uses'=> 'DashboardController@viewbills',
    'as'=> 'paybills'
   ]);

   
   Route::get('/billtype/{bill_id}', [
       'uses'=> 'DashboardController@getbilltype',
       'as'=> 'billtype'
   ]);

   Route::get('/mobiletopup', [
        'uses'=> 'DashboardController@viewmobile_topup',
        'as'=> 'getmobile_topup'
   ]);

   Route::post('/paybills', [
    'uses'=> 'DashboardController@PayBills',
    'as'=> 'paybills'
   ]);
    
   Route::post('/eedcpay', [
    'uses'=> 'DashboardController@eedcPayment',
    'as'=> 'eedcpay',
   ]);

   Route::post('/topup', [
        'uses'=> 'DashboardController@TopUp',
        'as'=> 'topup'
   ]);

});

Route::group(['prefix'=> 'datatable'], function() {
    Route::get('/recentTopups', [
        'uses'=> 'DatatablesController@getrecentTopups',
        'as'=> 'recenttopups'
    ]);

    Route::get('/transactions', [
        'uses'=> 'DatatablesController@getTransaction',
        'as'=> 'transaction',
    ]);
});










