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

Route::get('/verification', 'HomeController@verification')->name('verification');

Route::group(["middleware" => ["auth","basicadmin"]], function(){

    Route::get('/start', 'HomeController@start')->name('start');

    Route::get('/Basicindex', 'BasicAdminController@index')->name('basicadmin');

    Route::post('/verify', 'BasicAdminController@verify')->name('BasicAdmin.verify');

    Route::post('/search/{email}', 'BasicAdminController@search')->name('BasicAdmin.search');

});

Route::group(["middleware" => ["auth","admin"]], function(){

    Route::get('/Adminindex', 'AdminController@index')->name('admin');

    Route::post('/create', 'AdminController@create')->name('Admin.create');

    Route::GET('/timer', 'AdminController@timer')->name('Admin.timer');
});

Route::group(["middleware" => ["auth","user"]], function(){

    Route::get('/Userindex', function () {
        return view('user.index');
    })->name('user');


});


Route::get('ajax', function(){ return view('ajax'); });