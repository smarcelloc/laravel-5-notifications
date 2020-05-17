<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;

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

Auth::routes();
Broadcast::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'PostController@index')->name('home');
    Route::get('notifications', 'NotificationController@Notifications')->name('notifications');
    Route::put('notifications-read', 'NotificationController@MarkAsRead');
    Route::put('notifications-all-read', 'NotificationController@MarkAllAsRead');
    Route::resource('post', 'PostController');
    Route::resource('comment', 'CommentController');
});

Route::get('/home', 'HomeController@index')->name('home');
