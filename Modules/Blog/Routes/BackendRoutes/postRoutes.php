<?php

/*
* name: locale.admin.blog.posts
*/

 //Posts
 Route::prefix('posts')->name('.posts')->group(function () {

    // Index
    Route::get('/', 'Admin\PostController@index')
    ->name('.index')
    ->middleware('can:blog.posts.index');

});
