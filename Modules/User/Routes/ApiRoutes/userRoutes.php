<?php

use Illuminate\Http\Request;

/*
Route::middleware('auth:api')->get('/user/v1', function (Request $request) {
    return $request->user();
});
*/

Route::prefix('/users')->name('.users')->group(function(){

    Route::get('/', 'Api\UserApiController@index')
    ->name('.index');

    Route::get('/{criteria}', 'Api\UserApiController@show')
    ->name('.show');


});
