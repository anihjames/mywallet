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


    Route::post('/update', [
        'uses'=> 'UserController@Update',
        'as'=> 'update'
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
    
    Route::post('/passwordreset', [
        'uses'=> 'UserController@changePassword',
        'as'=> 'newpassword'
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
    'middleware'=> 'adminroutes',
]);

Route::group(['prefix'=> 'user', 'middleware'=> ['auth', 'adminroutes']], function() {

    Route::get('/notifications', 'UsersController@notifications');
    
   Route::get('/paybills', [
    'uses'=> 'DashboardController@viewbills',
    'as'=> 'paybills',
   ]);

   Route::get('/takeloan', function() {
        return view('dashboard.loan');
   })->name('takeloan');

   
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
        'as'=> 'topups'
   ]);

   Route::post('/applyforloan', [
       'uses'=> 'LoanController@ApplyforLoan',
       'as'=> 'applyforloan'
   ]);

   Route::get('/editloan/{id}', 'LoanController@editloan');

    Route::post('/editloan', [
       'uses'=> 'LoanController@updateloan',
       'as'=> 'updateloan',
       ]);

    
       Route::get('/pay_loan', [
        'uses'=> 'LoanController@get_pay_loan',
        'as'=> 'get_pay_loan'
       ]);

       Route::get('/payloan', [
        'uses'=> 'LoanController@payloan',
        'as'=> 'get_payloan'
       ]);

       Route::get('/wallettopup', [
        'uses'=> 'DashboardController@wallet_topup',
        'as'=> 'wallet_topup'
   ]);

   Route::post('/wallet_topup', [
       'uses'=> 'PaymentController@topup',
       'as'=> 'topup'
   ]);

   Route::post('/payloan', [
       'uses'=> 'PaymentController@payloan',
       'as'=>'payloan'
   ]);
    
    

       

});

Route::group(['prefix'=> 'datatable', 'middleware'=> 'auth'], function() {
    Route::get('/recentTopups', [
        'uses'=> 'DatatablesController@getrecentTopups',
        'as'=> 'recenttopups'
    ]);

    Route::get('/transactions', [
        'uses'=> 'DatatablesController@getTransaction',
        'as'=> 'transaction',
    ]);

    Route::get('/trans', 'DatatablesController@gettrans');

    Route::get('/bills', 'DatatablesController@Bill');

    Route::get('/loantaken', 'DatatablesController@Loans');

    Route::post('/deleteloan', 'DatatablesController@deleteloan');

    Route::get('/getrecentloanpayment', 'DatatablesController@getrecent');

    
});

Route::group(['prefix'=> 'setting', 'middleware'=> 'auth'], function() {

    Route::get('/profile', [
        'uses'=> 'DashboardController@editprofile',
        'as'=> 'profile'
   ]);


   Route::get('/changepassword', [
        'uses'=> 'DashboardController@getchangepassword',
        'as'=> 'changepassword'
   ]);

   Route::get('/deleteaccount', [
        'uses'=> 'DashboardController@DeleteAccount',
        'as'=> 'deleteAccount'
   ]);

   Route::post('/passwordchange', [
    'uses'=> 'DashboardController@changePassword',
    'as'=> 'passwordchange'
   ]);

   Route::post('/accountdelete', [
    'uses'=> 'DashboardController@Destory',
    'as'=> 'destory'
   ]);


});


Route::group(['prefix'=> 'payment', 'middleware'=>'auth'], function() {

    Route::get('/callback', [
        'uses' => 'PaymentController@handleGatewayCallback',
        'as'=> 'callback'
    ]); 

    Route::post('/payloan', [
        'uses' => 'PaymentController@redirectToGateway',
        'as' => 'makepayments'
    ]);
});










