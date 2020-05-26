<?php

use Illuminate\Http\Request;

Route::prefix('/users')->name('.users')->middleware('auth:api')->group(function(){

    Route::get('/', 'Api\UserApiController@index')
    ->name('.index')
    ->middleware('can:user.users.index');

    Route::get('/{criteria}', 'Api\UserApiController@show')
    ->name('.show')
    ->middleware('can:user.users.index');


});
