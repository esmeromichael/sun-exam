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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'UserController@index');
Route::post('/create', 'UserController@create');
Route::get('/delete', 'UserController@destroy');
Route::get('/validate-email', 'UserController@validateEmail');

Route::get('/login', 'UserController@login');