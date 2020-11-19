<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

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
    // return view('layouts.public');
    return view('welcome');
});

Route::view('details', 'details');

Route::get('contact', 'ContactController@show');
Route::post('contact', 'ContactController@store');

Route::get('coweerkers', 'UserController@index');
// Route::view('coweerkers', 'coweerkers');
// Route::get('coweerkers', 'UserController@index')->middleware('auth');

Route::view('contactUsers', 'contactUsers');

Route::get('events','EventController@index');
// Route::get('eventBooked/{eventId}','EventController@isEventBookedByAuth');
Route::get('modifyEvent/{eventId}', 'EventController@edit');
Route::patch('events/{event}', 'EventController@update');

Route::get('inscription/{eventId}', 'EventController@show')->middleware('auth');
Route::post('eventBooking', 'EventController@booking');
Route::delete('eventBooking/{eventId}', 'EventController@cancelBooking');

Route::get('myProfile', 'UserController@showAuth');
Route::patch('myProfile/{userId}', 'UserController@updateProfile');
Route::patch('myProfileIds/{userId}', 'UserController@updateIds');
Route::post('myProfile/avatar/{userId}', 'UserController@storeAvatar');
Route::get('myEvents','EventController@showMyEvents');
Route::delete('deleteMyprofile/{userId}', 'UserController@destroy');

Route::post('eventCreation', 'EventController@store');
Route::get('futureEventsList', 'EventController@indexFuture');
Route::delete('futureEventsList/{eventId}', 'EventController@destroyFutureEvent');
Route::get('pastEventsList', 'EventController@indexPast');
Route::delete('pastEventsList/{eventId}', 'EventController@destroyPastEvent');
Route::get('events/list/{eventId}', 'EventController@showListEvent');

Route::view('deleteUserConfirm', 'deleteUserConfirm')->name('deleteUserConfirm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//SOCIALITE
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
