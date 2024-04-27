<?php
/**
 * Database connection establisher
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

use App\Config\Routes\Route;

Route::get('/', \App\Controllers\HomeController::class, 'index');

Route::get('/login', \App\Controllers\Auth\AuthController::class, 'login');
Route::post('/login', \App\Controllers\Auth\AuthController::class, 'login_user');
Route::get('/logout', \App\Controllers\Auth\AuthController::class, 'logout_user');

//registration routes
Route::get('/register', \App\Controllers\Auth\AuthController::class, 'register');
Route::post('/register', \App\Controllers\Auth\AuthController::class, 'register_user');

//users routes
Route::get('/user/{id}', \App\Controllers\UsersController::class, 'index');
Route::patch('/user/{id}', \App\Controllers\UsersController::class, 'update_user');

//forums
Route::get('/forums', \App\Controllers\ForumsController::class, 'index');
Route::get('/forums/{forum_slug}/posts', \App\Controllers\ForumsController::class, 'forum_posts');

// Dispatch the request
Route::dispatch($_POST['_method'] ?? $_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);