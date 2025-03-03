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
    Route::get('/meetings_list', 'zoomController@meetingsList');
    Route::get('/startMeeting/{id}', 'zoomController@startmeeting')->name('start-meeting');
    Route::get('/meeting', function () {
        return view('startMeeting');
    });
    // Route::get('/meeting', function () {
    //     return view('startMeeting');
    // });
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard' . '.'], function () {
        Route::get('/', function () {
            return view('dashboard');
        });

        Route::group(['middleware' => ['role:Super Admin']], function () {
            Route::get('admins/deleted'  , 'ManageUsers\AdminController@viewdeleted')->name('admins.deleted');
            Route::get('parents/deleted' , 'ManageUsers\ParentController@viewdeleted')->name('parents.deleted');
            Route::get('staff/deleted'   , 'ManageUsers\StaffController@viewdeleted')->name('staff.deleted');
            Route::get('students/deleted', 'ManageUsers\StudentController@viewdeleted')->name('students.deleted');
            Route::get('teachers/deleted', 'ManageUsers\TeacherController@viewdeleted')->name('teachers.deleted');
    
            Route::post('restore/{id}'    , 'Helpers\HelperController@restore')->name('restore');
            Route::post('forcedelete/{id}', 'Helpers\HelperController@forcedelete')->name('forcedelete');

            Route::resource('roles', 'RoleController');
            Route::resource('permissions', 'PermissionController');
        });
 

        Route::group(['middleware' => ['role:Super Admin|admin']], function () {

            // users management
            Route::resource('admins'  , 'ManageUsers\AdminController');
            Route::resource('students', 'ManageUsers\StudentController');
            Route::resource('parents' , 'ManageUsers\ParentController');
            Route::resource('staff'   , 'ManageUsers\StaffController');
            Route::resource('teachers', 'ManageUsers\TeacherController');
            // stages management
            Route::resource('stages', 'StageController');

            // classes management
            Route::resource('classes'          , 'ClassRoomController');
            Route::get('session/create/{class}', 'SessionController@create')->name('session.create');
            Route::post('session/store'        , 'SessionController@store')->name('session.store');
            Route::get('session/{class}/edit'  , 'SessionController@edit')->name('session.edit');
            Route::put('session/update'        , 'SessionController@update')->name('session.update');

            // courses management
            Route::resource('courses', 'CourseController');

            // Attendance
            Route::resource('attendance', 'AttendanceController');
        });

        Route::get('/delete/{id}', 'zoomController@deleteMeeting');
        Route::get('/create_meeting', function () {
            return view('create_meeting');
        });
        Route::post('/create_meeting', 'zoomController@createMeeting');
    });


});
