<?php

namespace App\Models;

use App\Config\Database\BaseModel;

class PostRepliesModel extends BaseModel
{
    public $table = 'posts_replies';

    public function __construct()
    {
        parent::__construct();
    }
}