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

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    // View Home
    Route::get('/', function () {
        return view('welcome');
    });

    // Auth Base Laravel
    //Auth::routes();

    // View Home User
    Route::get('/backend', 'HomeController@index')->name('backend');

    // View SPA
    Route::get('/spa', function () {
        return view('spa');
    });

});
