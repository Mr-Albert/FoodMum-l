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
    return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//make it api
Route::get('notification', 'NotificationController@index')->name('notificationPage');//gets the notifications page
Route::get('notification/all/{noOfNotifications?}', 'NotificationController@showAll')->name('notificationInPage');//gets the notifications for the notificaitons page with details  
Route::get('notification/{noOfNotifications}', 'NotificationController@show')->name('notificationBar');//gets the notifications for the icon in the top bar 
Route::put('notification/create', 'NotificationController@update')->name('putNotification');//create a notification 
