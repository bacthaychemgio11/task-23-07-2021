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

// GET USER
Route::get('/get-users', ['middleware' => 'auth', 'uses' => 'UserController@getUsers'])->name('get-users');

// DELETE USER
Route::post('/remove', ['middleware' => 'auth', 'uses' => 'UserController@destroy'])->name('remove');

// UPDATE USER
Route::post('/edit', ['middleware' => 'auth', 'uses' => 'UserController@update'])->name('update');

// ADD NEW USER
Route::get('/add-user', ['middleware' => 'auth', function () {
    return view('add-user');
}]);

Route::post('/add-user', ['middleware' => 'auth', 'uses' => 'UserController@store'])->name('store');

// GETTING USER INFORMATION FOR EDITTING
Route::post('/getInforUser', ['middleware' => 'auth', 'uses' => 'UserController@edit'])->name('getUserInfo');

// GETTING CHART DATA AT HOME PAGE
Route::get('/get-data-chart', ['middleware' => 'auth', 'uses' => 'UserController@getDataChart'])->name('getChartData');

// GETTING CONTRACTS DATA AT HOME PAGE FOR USER
Route::get('/get-contracts-user', ['middleware' => 'auth', 'uses' => 'ContractController@getContractsOfUser'])->name('getContractsForUser');
