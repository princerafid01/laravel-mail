<?php
use Illuminate\Http\Request;

Route::post('auth/login', 'Api\AuthController@login');
Route::post('auth/forgot', 'Api\AuthController@forgot');
Route::post('auth/reset-password', 'Api\AuthController@resetPass');
Route::group(['middleware' => 'jwt.auth'], function(){
    Route::get('auth/user', 'Api\AuthController@user');
    Route::post('auth/logout', 'Api\AuthController@logout');



    //home
    Route::get('home', 'Api\HomeController@index');

//    users
    Route::get('users', 'Api\UserController@index');
    Route::get('user/{id}', 'Api\UserController@getUser');
    Route::post('user', 'Api\UserController@addUser');
    Route::get('roles', 'Api\UserController@roles');
    Route::post('role', 'Api\UserController@addRole');
    Route::delete('role/{id}', 'Api\UserController@deleteRole');
    Route::get('role/perms/{id}', 'Api\UserController@perms');
    Route::post('role/perms/{id}', 'Api\UserController@perms');

//    Transaction
    Route::post('transaction/add', 'Api\TransactionController@add');
    Route::post('transaction/addGexpense', 'Api\TransactionController@addGexpense');
    Route::get('transaction/list', 'Api\TransactionController@getTransactions');
    Route::get('transaction/{id}', 'Api\TransactionController@view');
    Route::post('transaction/{id}', 'Api\TransactionController@update');
    Route::delete('transaction/{id}', 'Api\TransactionController@delete');
    Route::get('transactions/getMonthlyGexpense', 'Api\TransactionController@getMonthlyGexpense');



    //Trips
    Route::get('trips','Api\TripController@index');
    Route::get('trip/{id}', 'Api\TripController@getTrip');
    Route::post('trip/add', 'Api\TripController@add');
    Route::delete('trip/{id}', 'Api\TripController@delete');

//    ships
    Route::get('ship/getData/{id}','Api\ShipController@getData');

    //notifications
    Route::get('notifications','Api\NotificationController@index');
    Route::get('mark_all_read','Api\NotificationController@mark_all_read');
    Route::get('mark_read/{id}', 'Api\NotificationController@mark_read');
});
Route::group(['middleware' => 'jwt.refresh'], function(){
    Route::get('auth/refresh', 'Api\AuthController@refresh');
});
Route::get('animation', function (){
    return view('animation');
});
// Mail
Route::get('test/email', 'Api\MailController@index');
Route::get('test/email/2', 'Api\MailController@test');
Route::get('mailRead/{id}', 'Api\MailController@updateMailRead');
Route::get('mailRead/{id}', 'Api\MailController@updateMailRead');
Route::post('sendMail', 'Api\MailController@sendMail');
