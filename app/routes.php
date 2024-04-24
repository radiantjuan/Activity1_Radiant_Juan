<?php

use App\Config\Routes\Route;

Route::get('/', \App\Controllers\HomeController::class, 'index');
Route::get('/posts', \App\Controllers\PostsController::class, 'index');
Route::get('/posts/{tae}', \App\Controllers\PostsController::class, 'show');
//Route::get('posts', 'PostsController', 'index');
// Add more routes as needed

// Dispatch the request
Route::dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);