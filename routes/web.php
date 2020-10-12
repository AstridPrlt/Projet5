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
    return view('layouts.public');
});

// Route::view('details', 'details');

Route::get('eventsList', 'EventController@index');
Route::post('eventBooking', 'EventController@booking');

// Route::view('coweerkers', 'coweerkers');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
