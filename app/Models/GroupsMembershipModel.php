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


    /**
     * Retrieve all group membership invites
     *
     * @return array
     */
    public function get_group_membership_invites()
    {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT
                    i.id AS invite_id,
                    i.group_id,
                    g.group_name,
                    i.user_id AS invited_user_id,
                    u.username AS invited_user_name,
                    i.joined_at,
                    i.invitation_status,
                    ui.email AS invited_by
                FROM
                    group_memberships i
                INNER JOIN
                    groups g ON i.group_id = g.id
                INNER JOIN
                    users u ON i.user_id = u.id
                LEFT JOIN
                    users ui ON i.invited_by = ui.id
                WHERE
                    i.invitation_status = 'pending';
";
        $pending_invites = $this->query($sql, [':user_id' => $user_id]);
        return $pending_invites;
    }
}