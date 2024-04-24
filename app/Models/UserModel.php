<?php

namespace App\Models;
use App\Config\Database\BaseModel;
use App\Config\Database\DatabaseConnection;

class UserModel extends BaseModel
{
    public $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }
}