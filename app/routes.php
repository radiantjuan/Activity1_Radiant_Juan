<?php

use App\Config\Routes\Route;

Route::get('/', 'HomeController', 'index');
Route::get('/about', 'AboutController', 'index');
// Add more routes as needed

// Dispatch the request
Route::dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);