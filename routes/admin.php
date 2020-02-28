<?php

Route::get('/home', [
    'uses'=> 'AdminController@index',
    'as'=> 'admin.index'
]);

Route::get('/bills', [
    'uses'=> 'AdminController@Totalbills',
    'as'=> 'total.bills'
]);

Route::get('/topups', [
    'uses'=> 'AdminController@Toptops',
    'as'=> 'total.topups'
]);

Route::get('/loans', [
    'uses'=> 'AdminController@TotalLoans',
    'as'=> 'total.loans'
]);

Route::get('/users', [
    'uses'=> 'AdminController@TotalUsers',
    'as'=> 'total.users'
]);

Route::get('/getbills', 'AdminController@getBills');

Route::get('/gettopups', 'AdminController@getTopups');

Route::get('/viewtopup/{id}', 'AdminController@viewTops');

Route::get('/viewbills/{id}', 'AdminController@viewBills');

Route::get('/getloans', 'AdminController@getLoans');

Route::get('/viewloans/{id}', 'AdminController@viewloans');

Route::post('/loanactions', 'AdminController@loanActions');

Route::get('/getusers', 'AdminController@getUsers');

Route::get('/viewusers/{id}', 'AdminController@viewusers');

Route::post('/useractions', 'AdminController@useractions');

Route::get('/gettransactions', 'AdminController@gettransactions');

Route::get('/getTrans', 'AdminController@getTrans');

Route::get('/viewusertrans/{id}', 'SortController@getusertrans');

Route::get('/notify/{id}', 'AdminController@shownotification');