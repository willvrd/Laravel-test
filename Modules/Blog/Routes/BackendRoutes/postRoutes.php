<?php

 //Posts
 Route::prefix('posts')->name('.posts')->group(function () {

    // Index
    Route::get('/', 'Admin\PostController@index')
    ->name('.index')
    ->middleware('can:blog.posts.index');

});
