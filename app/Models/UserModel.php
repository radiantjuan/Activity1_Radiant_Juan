<?php
/**
 * User model
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Models;

use App\Config\Database\BaseModel;

class UserModel extends BaseModel
{
    public $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Find user by ID
     *
     * @param int|string $user_id User ID
     *
     * @return mixed
     */
    public function find_user_by_id($user_id)
    {
        return $this->find($user_id);
    }

    /**
     * Update user data in the database and return the updated data
     *
     * @param int|string $user_id User ID
     * @param array      $data    data to be patched
     *
     * @return array
     */
    public function update_user($user_id, $data)
    {
        $this->update($user_id, $data);
        return $this->find($user_id);
    }
}