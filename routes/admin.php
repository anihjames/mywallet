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

Route::get('/getbills', 'AdminController@getBills');

Route::get('/gettopups', 'AdminController@getTopups');

Route::get('/viewtopup/{id}', 'AdminController@viewTops');

Route::get('/getloans', 'AdminController@getLoans');