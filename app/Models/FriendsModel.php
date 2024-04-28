<?php
/**
 * Messaging Models
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Models;

use App\Config\Database\BaseModel;

class FriendsModel extends BaseModel
{
    public $table = 'friend_requests';

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Retrieve all friends
     *
     * @return array
     */
    public function get_friends_list()
    {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT 
                CASE 
                    WHEN fr.sender_id = :user_id THEN receiver.username
                    ELSE sender.username
                END AS friend_name,
                CASE 
                    WHEN fr.sender_id = :user_id THEN receiver.email
                    ELSE sender.email
                END AS friend_email
            FROM 
                friend_requests fr
            JOIN 
                users sender ON fr.sender_id = sender.id
            JOIN 
                users receiver ON fr.receiver_id = receiver.id
            WHERE 
                fr.status = 'accepted'
            AND 
                (fr.sender_id = :user_id OR fr.receiver_id = :user_id);
            
            ";
        $friends = $this->query($sql, [':user_id' => $user_id]);
        return $friends;
    }

    /**
     * @return array|false
     */
    public function get_friend_requests()
    {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT 
                    fr.id AS request_id,
                    CASE 
                        WHEN fr.sender_id = :user_id THEN fr.receiver_id
                        ELSE fr.sender_id
                    END AS requester_id,
                    CASE 
                        WHEN fr.sender_id = :user_id THEN receiver.username
                        ELSE sender.username
                    END AS friend_name,
                    CASE 
                        WHEN fr.sender_id = :user_id THEN receiver.email
                        ELSE sender.email
                    END AS friend_email
                FROM 
                    friend_requests fr
                JOIN 
                    users sender ON fr.sender_id = sender.id
                JOIN 
                    users receiver ON fr.receiver_id = receiver.id
                WHERE 
                    fr.status = 'pending'
                    AND
                    fr.receiver_id = :user_id;
";
        $friends_requests = $this->query($sql, [':user_id' => $user_id]);
        return $friends_requests;
    }
}
