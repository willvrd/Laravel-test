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

$locale = \App::getLocale();

/*
* name: locale.user
*/
Route::prefix('/user')->name($locale.'.user')->group(function(){




});

/*
* name: locale.auth
*/
Route::prefix('/auth')->name($locale.'.auth')->group(function(){

    require('WebRoutes/authRoutes.php');

});
