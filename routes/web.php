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
    return view('welcome');
})->name('/');

Auth::routes();

Route::get('/start', 'HomeController@start')->name('start');

Route::get('/verification', 'HomeController@verification')->name('verification');

Route::group(["middleware" => ["auth","basicadmin"]], function(){

    Route::get('/Basicindex', 'BasicAdminController@index')->name('basicadmin');

    Route::post('/verify', 'BasicAdminController@verify')->name('BasicAdmin.verify');

    Route::post('/search/{email}', 'BasicAdminController@search')->name('BasicAdmin.search');

});

Route::group(["middleware" => ["auth","admin"]], function(){

    Route::get('/Adminindex', 'AdminController@index')->name('admin');

    Route::post('/create', 'AdminController@create')->name('Admin.create');

    Route::GET('/timer', 'AdminController@timer')->name('Admin.timer');

    Route::GET('/timer2', 'AdminController@timer2')->name('Admin.timer2');

    Route::post('/editexamp/{id}', 'AdminController@editexamp')->name('Admin.editexamp');

    Route::GET('/deleteexam/{id}', 'AdminController@deleteexam')->name('Admin.deleteexam');

    Route::post('/createquestion', 'AdminController@createquestion')->name('Admin.createquestion');

    Route::GET('/viewquestions/{id}', 'AdminController@viewquestions')->name('Admin.viewquestions');

    Route::post('/editquestionp/{id}', 'AdminController@editquestionp')->name('Admin.editquestionp');

    Route::GET('/deletequestion/{id}', 'AdminController@deletequestion')->name('Admin.deletequestion');

    Route::GET('/viewenroll/{id}', 'AdminController@viewenroll')->name('Admin.viewenroll');
});

Route::group(["middleware" => ["auth","user"]], function(){

    Route::get('/Userindex', 'UserController@index')->name('user');

    Route::post('/enroll', 'UserController@enroll')->name('User.enroll');

    Route::get('/profile', 'UserController@profile')->name('User.profile');

    Route::post('/updateprofile/{id}', 'UserController@updateprofile')->name('User.updateprofile');
});


Route::get('ajax', function(){ return view('ajax'); });