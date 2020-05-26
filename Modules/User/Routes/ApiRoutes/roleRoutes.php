<?php

use Illuminate\Http\Request;

Route::prefix('/roles')->name('.roles')->middleware('auth:api')->group(function(){

    Route::get('/', 'Api\RoleApiController@index')
    ->name('.index')
    ->middleware('can:user.roles.index');

    Route::get('/{criteria}', 'Api\RoleApiController@show')
    ->name('.show')
    ->middleware('can:user.roles.index');

    Route::post('/assign', 'Api\RoleApiController@assign')
    ->name('.assign')
    ->middleware('can:user.roles.assign');

    Route::post('/unassign', 'Api\RoleApiController@unassign')
    ->name('.unassign')
    ->middleware('can:user.roles.unassign');


});
