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

//***********************
//******PUBLIC PART******
Route::view('/', 'welcome');

Route::view('details', 'details');
Route::view('mentions', 'mentions');
Route::view('sitemap', 'sitemap');

Route::get('contact', 'ContactController@showContactForm');
Route::post('contact', 'ContactController@sendContactForm');

Route::get('coweerkers', 'UserController@index');


//***************************
//*****CONTACTS MANAGEMENT*****
Route::get('contactUsers/{userId}', 'ContactController@showUsersContact')->middleware('auth');
Route::post('contactUsers/{userId}', 'ContactController@sendUsersContact')->middleware('auth');
Route::post('addContact', 'UserController@storeContact');
Route::delete('removeContact/{userId}', 'UserController@removeContact');


//***************************
//*****EVENTS MANAGEMENT*****
Route::get('events','EventController@index');
Route::get('modifyEvent/{eventId}', 'EventController@edit');
Route::patch('events/{event}', 'EventController@update');

Route::get('inscription/{eventId}', 'EventController@show')->middleware('auth');
Route::post('eventBooking', 'EventController@booking');
Route::delete('eventBooking/{eventId}', 'EventController@cancelBooking');

Route::post('inscription/{eventId}/paiement', 'PaymentController@create');


//****************************
//*****PROFILE MANAGEMENT*****
Route::get('myProfile', 'UserController@showAuth');
Route::patch('myProfile/{userId}', 'UserController@updateProfile');
Route::patch('myProfileIds/{userId}', 'UserController@updateIds');
Route::post('myProfile/avatar/{userId}', 'UserController@storeAvatar');
Route::get('myEvents','EventController@showMyEvents');
Route::get('myContacts','UserController@showMyContacts');
Route::patch('userInvisible/{userId}', 'UserController@makeInvisible');
Route::patch('userVisible/{userId}', 'UserController@makeVisible');
Route::delete('deleteMyprofile/{userId}', 'UserController@destroy');
Route::view('deleteUserConfirm', 'deleteUserConfirm')->name('deleteUserConfirm');


//**************************
//*****ADMIN MANAGEMENT*****
Route::post('eventCreation', 'EventController@store');
Route::get('futureEventsList', 'EventController@indexFuture');
Route::delete('futureEventsList/{eventId}', 'EventController@destroyFutureEvent');
Route::get('pastEventsList', 'EventController@indexPast');
Route::delete('pastEventsList/{eventId}', 'EventController@destroyPastEvent');
Route::get('events/list/{eventId}', 'EventController@showListEvent');

Route::get('usersList', 'UserController@indexAdmin');
Route::delete('deleteUser/{userId}', 'UserController@destroy');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//**************************
//*********SOCIALITE********
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
