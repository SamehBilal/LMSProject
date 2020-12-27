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





Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/meetings-list', 'zoomController@meetingsList');
    Route::get('/meeting', function () {
        return view('startMeeting');
    });
    Route::group(['prefix' => 'admin', 'as' => 'admin' . '.', 'middleware'=>['role:admin|Super Admin']], function () {
        Route::get('/', function () {
            return view('dashboard');
        });
        Route::get('admins/deleted', 'AdminController@viewdeleted')->name('admins.deleted');
        Route::get('parents/deleted', 'ParentController@viewdeleted')->name('parents.deleted');
        Route::get('staff/deleted', 'StaffController@viewdeleted')->name('staff.deleted');
        Route::get('students/deleted', 'StudentController@viewdeleted')->name('students.deleted');
        Route::get('teachers/deleted', 'TeacherController@viewdeleted')->name('teachers.deleted');

        Route::post('restore/{id}', 'HelperController@restore')->name('restore');
        Route::post('forcedelete/{id}', 'HelperController@forcedelete')->name('forcedelete');

        // users management
        Route::resource('admins', 'AdminController');
        Route::resource('students', 'StudentController');
        Route::resource('parents', 'ParentController');
        Route::resource('staff', 'StaffController');
        Route::resource('teachers', 'TeacherController');
        // stages management
        Route::resource('stages', 'StageController');

        // classes management
        Route::resource('classes', 'ClassRoomController');

        // courses management
        Route::resource('courses', 'CourseController');

        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');


        Route::get('/delete/{id}', 'zoomController@deleteMeeting');
        Route::get('/create_meeting', function () {
            return view('create_meeting');
        });
        Route::post('/', 'zoomController@createMeeting');
    });


});
