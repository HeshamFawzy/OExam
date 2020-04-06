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



Route::get('/Basicindex', 'BasicAdminController@index')->name('basicadmin');

Route::post('/verify', 'BasicAdminController@verify')->name('BasicAdmin.verify');














Route::get('/Adminindex', function () {
    return view('admin.index');
})->name('admin');


Route::get('/Userindex', function () {
    return view('user.index');
})->name('user');


Route::get('ajax', function(){ return view('ajax'); });