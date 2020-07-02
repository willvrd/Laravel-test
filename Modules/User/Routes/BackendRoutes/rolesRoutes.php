<?php

/*
* name: locale.admin.user.roles
*/

 Route::prefix('roles')->name('.roles')->group(function () {

    // Index
    Route::get('/', 'Admin\RoleController@index')
    ->name('.index')
    ->middleware('can:user.roles.index');

});
