<?php

namespace App\Controllers;

use App\Models\UserModel;

class HomeController
{

    public function index()
    {
        $user = new UserModel();
        $user->find(1);
        echo "Welcome to the Home Paasdfasdfge!";
    }
}
