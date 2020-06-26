<?php

use Illuminate\Http\Request;

Route::prefix('/categories')->name('.categories')->middleware('auth:api')->group(function(){

    Route::get('/', 'Api\CategoryApiController@index')
    ->name('.index')
    ->middleware('can:blog.categories.index');

    Route::get('/{criteria}', 'Api\CategoryApiController@show')
    ->name('.show')
    ->middleware('can:blog.categories.index');

    Route::post('/', 'Api\CategoryApiController@create')
    ->name('.create')
    ->middleware('can:blog.categories.create');

    Route::put('/{criteria}', 'Api\CategoryApiController@update')
    ->name('.update')
    ->middleware('can:blog.categories.update');

    Route::delete('/{criteria}', 'Api\CategoryApiController@delete')
    ->name('.delete')
    ->middleware('can:blog.categories.delete');

});
