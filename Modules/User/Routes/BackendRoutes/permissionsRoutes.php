<?php

/*
* name: locale.admin.user.permissions
*/

 Route::prefix('permissions')->name('.permissions')->group(function () {

    // Index
    Route::get('/', 'Admin\PermissionController@index')
    ->name('.index')
    ->middleware('can:user.permissions.index');

});
