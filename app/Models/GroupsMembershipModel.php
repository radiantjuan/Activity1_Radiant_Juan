<?php
/**
 * Groups Membership model
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Models;

use App\Config\Database\BaseModel;

class GroupsMembershipModel extends BaseModel
{
    public $table = 'group_memberships';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retrieve all group members
     *
     * @param int $group_id Group ID
     *
     * @return array|false
     */
    public function get_group_members($group_id)
    {
        $sql = "SELECT 
                u.id AS user_id,
                u.username AS username,
                u.email AS email
            FROM 
                group_memberships gm
            INNER JOIN 
                users u ON gm.user_id = u.id
            WHERE 
                gm.group_id = :selected_group_id;
            ";
        $group = $this->query($sql, [':selected_group_id' => $group_id]);
        return $group;
    }
}