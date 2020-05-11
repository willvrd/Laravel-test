<?php

use Illuminate\Routing\RouteGroup;
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

// View Home
Route::get('/', function () {
    return view('welcome');
});

// Auth Base Laravel
Auth::routes();

// View Home User
Route::get('/home', 'HomeController@index')->name('home');
