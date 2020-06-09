<?php

 Route::prefix('users')->name('.users')->group(function () {

    // Index
    Route::get('/', 'Admin\UserController@index')
    ->name('.index')
    ->middleware('can:user.users.index');

});
