<?php

/*
* name: locale.admin.blog.categories
*/

 //Posts
 Route::prefix('categories')->name('.categories')->group(function () {

    // Index
    Route::get('/', 'Admin\CategoryController@index')
    ->name('.index')
    ->middleware('can:blog.categories.index');

});
