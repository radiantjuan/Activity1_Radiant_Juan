<?php

namespace App\Controllers;

use App\Models\UserModel;

class PostsController
{

    public function index()
    {
        echo "Welcome to the Home PostsController!";
    }

    public function show($request)
    {
        echo "Welcome to the Home show!";
    }
}
