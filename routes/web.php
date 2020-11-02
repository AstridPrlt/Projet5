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

Route::get('events','EventController@index');

Route::get('inscription/{eventId}', 'EventController@show')->middleware('auth');
Route::post('eventBooking', 'EventController@booking');

Route::view('coweerkers', 'coweerkers');

Route::get('myProfile', 'UserController@showAuth');
Route::patch('myProfile/{userId}', 'UserController@update');
Route::post('myProfile/avatar/{userId}', 'UserController@storeAvatar');
Route::get('myEvents','EventController@showMyEvents');

Route::post('eventCreation', 'EventController@store');
Route::get('futureEventsList', 'EventController@indexFuture');
Route::delete('futureEventsList/{eventId}', 'EventController@destroy');
Route::get('pastEventsList', 'EventController@indexPast');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
