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
* name: locale.backend.blog
*/

Route::middleware('auth')->prefix('/blog')->name('.blog')->group(function(){

    //======  POSTS
    require('BackendRoutes/postRoutes.php');


});
