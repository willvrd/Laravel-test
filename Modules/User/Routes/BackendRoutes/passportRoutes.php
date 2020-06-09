<?php

 Route::prefix('passport')->name('.passport')->group(function () {

    // Index
    Route::get('/', function () {
        return view('user::admin.passport.index');
    })->name('.index');

});
