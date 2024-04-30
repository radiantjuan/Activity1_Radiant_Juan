<?php
/**
 * Groups model
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Models;

use App\Config\Database\BaseModel;
use App\Utilities\DebugHelper;

class GroupsModel extends BaseModel
{
    public $table = 'groups';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retrieve groups with member counts
     *
     * @return array|false
     */
    public function get_groups_with_member_counts()
    {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT 
                g.id AS group_id,
                g.group_name,
                COUNT(gm.user_id) AS member_count
            FROM 
                groups g
            LEFT JOIN 
                group_memberships gm ON g.id = gm.group_id
            WHERE 
                g.created_by = :user_id OR gm.user_id = :user_id
            GROUP BY 
                g.id, g.group_name;";
        $groups = $this->query($sql, [':user_id' => $user_id]);
        return $groups;
    }
}