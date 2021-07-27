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
});

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');

// DELETE USER
Route::get('/remove/{id}', 'UserController@destroy')->name('remove');

// GET USER INFORMATION FOR UPDATING
Route::get('/edit/{id}', 'UserController@edit')->name('edit');

// UPDATE USER
Route::post('/edit', 'UserController@update')->name('update');

// ADD NEW USER
Route::get('/add-user', function () {
    return view('add-user');
});

Route::post('/add-user', 'UserController@store')->name('store');
