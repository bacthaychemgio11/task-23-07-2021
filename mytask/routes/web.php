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

Route::get('/home', ['middleware' => 'auth', 'uses' => 'UserController@index'])->name('home');

// DELETE USER
Route::post('/remove', ['middleware' => 'auth', 'uses' => 'UserController@destroy'])->name('remove');

// UPDATE USER
Route::post('/edit', ['middleware' => 'auth', 'uses' => 'UserController@update'])->name('update');

// ADD NEW USER
Route::get('/add-user', ['middleware' => 'auth', function () {
    return view('add-user');
}]);

Route::post('/add-user', ['middleware' => 'auth', 'uses' => 'UserController@store'])->name('store');


// AJAX HANDLE FORM FOR ADD/EDIT/DELETE USER
// Route::post('/add-ajax-user', ['middleware' => 'auth', 'uses' => 'AjaxUserController@store'])->name('storeUserAjax');
