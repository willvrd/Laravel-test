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

/*
* name: locale.admin.user
*/

Route::middleware('auth')->prefix('/user')->name('.user')->group(function(){

    require('BackendRoutes/userRoutes.php');
    require('BackendRoutes/rolesRoutes.php');
    require('BackendRoutes/passportRoutes.php');

});
