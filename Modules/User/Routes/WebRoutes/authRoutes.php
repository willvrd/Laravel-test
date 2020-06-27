<?php

// Login
Route::get('/', 'Auth\LoginController@showLoginForm')
->name('.login');

Route::post('login', 'Auth\LoginController@login')
->name('.login.post');

// Logout
Route::post('logout', 'Auth\LoginController@logout')
->name('.logout');
