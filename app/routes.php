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

//posts
Route::get('/posts', \App\Controllers\PostsController::class, 'index');
Route::get('/posts/add-posts', \App\Controllers\PostsController::class, 'add_posts');
Route::post('/posts/create-posts', \App\Controllers\PostsController::class, 'create_posts');
Route::delete('/posts/delete', \App\Controllers\PostsController::class, 'delete_post');
Route::get('/posts/{post_id}', \App\Controllers\PostsController::class, 'show');
Route::post('/posts/{post_id}/reply', \App\Controllers\PostsController::class, 'reply_to_post');
Route::patch('/posts/post_reply/vote', \App\Controllers\PostsController::class, 'vote_reply');

//inbox
Route::get('/messages/inbox', \App\Controllers\MessagingController::class, 'inbox');
Route::get('/messages/sent', \App\Controllers\MessagingController::class, 'sent');
Route::post('/messages/send_message', \App\Controllers\MessagingController::class, 'get_all_users');

//friends
Route::get('/friends', \App\Controllers\FriendsController::class, 'index');
Route::patch('/friends', \App\Controllers\FriendsController::class, 'process_friend_request');
Route::post('/friends/send-friend-request', \App\Controllers\FriendsController::class, 'send_friend_request');


//groups
Route::get('/groups', \App\Controllers\GroupsController::class, 'index');
Route::post('/groups/add-group', \App\Controllers\GroupsController::class, 'add_group');
Route::get('/groups/{group_id}/group_members', \App\Controllers\GroupsController::class, 'group_members');


// Dispatch the request
Route::dispatch($_POST['_method'] ?? $_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);