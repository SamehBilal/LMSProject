<?php

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
    return view('create_meeting');
});
Route::post('/', 'zoomController@createMeeting');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/meetings-list', 'zoomController@meetingsList');
Route::get('/delete/{id}', 'zoomController@deleteMeeting');

Route::get('/meeting', function () {
    return view('startMeeting');
});
});
