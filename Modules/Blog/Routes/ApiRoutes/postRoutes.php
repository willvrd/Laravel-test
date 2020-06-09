<?php

use Illuminate\Http\Request;

Route::prefix('/posts')->name('.posts')->middleware('auth:api')->group(function(){

    Route::get('/', 'Api\PostApiController@index')
    ->name('.index')
    ->middleware('can:blog.posts.index');

    Route::get('/{criteria}', 'Api\PostApiController@show')
    ->name('.show')
    ->middleware('can:blog.posts.index');

    /*
    Route::post('/', 'Api\PostApiController@create')
    ->name('.create')
    ->middleware('can:blog.posts.create');

    Route::put('/{criteria}', 'Api\PostApiController@update')
    ->name('.update')
    ->middleware('can:blog.posts.update');

    Route::delete('/{criteria}', 'Api\PostApiController@delete')
    ->name('.delete')
    ->middleware('can:blog.posts.delete');

    */


});
