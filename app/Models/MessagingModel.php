<?php
/**
 * Messaging Models
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Models;

use App\Config\Database\BaseModel;

class MessagingModel extends BaseModel
{
    public $table = 'private_messages';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get inbox messages
     *
     * @param int $page  current page
     * @param int $limit number of items per page
     *
     * @return array
     */
    public function get_inbox($page = 1, $limit = 10)
    {
        $user_id = $_SESSION['user_id'];
        // Calculate the offset based on the page number and limit
        $offset = ($page - 1) * $limit;

        // Construct the SQL query with pagination
        $sql = "SELECT 
                pm.message AS message_content,
                sender.username AS sender_name,
                receiver.username AS receiver_name,
                pm.sent_at AS sent_date
            FROM 
                private_messages pm
            LEFT JOIN 
                users sender ON pm.sender_id = sender.id
            LEFT JOIN 
                users receiver ON pm.receiver_id = receiver.id
            WHERE pm.receiver_id = :user_id
            ORDER BY 
                pm.sent_at DESC
            LIMIT 
                $limit OFFSET $offset";

        $params = [':user_id' => $user_id];
        $messages = $this->query($sql, $params);

        // Calculate the total number of posts
        $total_posts_sql = "SELECT COUNT(*) total_messages
            FROM 
                private_messages pm
            WHERE pm.receiver_id = :user_id;";


        $total_posts = $this->query($total_posts_sql, $params)[0]['total_messages'];

        // Calculate the total number of pages
        $total_pages = ceil($total_posts / $limit);

        // Return the messages
        return compact('messages', 'total_pages');
    }

    /**
     * Get sent messages
     *
     * @param int $page  current page
     * @param int $limit number of items per page
     *
     * @return array
     */
    public function get_sent($page = 1, $limit = 10)
    {
        $user_id = $_SESSION['user_id'];
        // Calculate the offset based on the page number and limit
        $offset = ($page - 1) * $limit;

        // Construct the SQL query with pagination
        $sql = "SELECT 
                pm.message AS message_content,
                receiver.username AS receiver_name,
                pm.sent_at AS sent_date
            FROM 
                private_messages pm
            INNER JOIN 
                users receiver ON pm.receiver_id = receiver.id
            WHERE pm.sender_id = :user_id
            ORDER BY 
                pm.sent_at DESC
            LIMIT 
                $limit OFFSET $offset";

        $params = [':user_id' => $user_id];
        $messages = $this->query($sql, $params);

        // Calculate the total number of posts
        $total_posts_sql = "SELECT COUNT(*) total_messages
            FROM 
                private_messages pm
            WHERE pm.receiver_id = :user_id;";


        $total_posts = $this->query($total_posts_sql, $params)[0]['total_messages'];

        // Calculate the total number of pages
        $total_pages = ceil($total_posts / $limit);

        // Return the messages
        return compact('messages', 'total_pages');
    }

    /**
     * Retrieve all receipients for sending message
     *
     * @return array
     */
    public function get_receipients() {
        $sql = "SELECT id, email, username FROM users";
        $receipients = $this->query($sql);
        return compact('receipients');
    }

}