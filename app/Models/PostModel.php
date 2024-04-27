<?php
/**
 * Posts model
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Models;

use App\Config\Database\BaseModel;

class PostModel extends BaseModel
{
    public $table = 'posts';

    const DEFAULT_POST_PER_PAGE = 5;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get post details
     *
     * @param int $post_id
     *
     * @return array
     */
    public function get_post_details($post_id)
    {
        $sql = 'SELECT posts.id, posts.title, posts.content, posts.excerpt, posts.post_date, 
                       users.username AS author, forums.forum_name AS forum
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                INNER JOIN forums ON posts.forum_id = forums.id
                WHERE posts.id = :post_id;';
        $post = $this->query($sql, [':post_id' => $post_id]);
        return $post[0];
    }

    /**
     * Get post replies
     *
     * @param int $post_id post ID
     *
     * @return mixed
     */
    public function get_post_replies($post_id)
    {
        $sql = 'SELECT pr.id, pr.user_id, pr.post_id, pr.content, pr.votes, pr.reply_date, u.username AS author
                FROM posts_replies pr
                JOIN users u ON pr.user_id = u.id
                WHERE pr.post_id = :post_id
                ORDER BY pr.votes DESC;';
        $post_replies = $this->query($sql, [':post_id' => $post_id]);
        return $post_replies;
    }

    /**
     * Fetch all featured posts
     *
     * @return array
     */
    public function get_featured_posts()
    {
        $sql = "SELECT 
                    posts.title AS post_title,
                    posts.excerpt AS post_excerpt,
                    users.username AS author_name,
                    forums.forum_name AS forum_name
                FROM 
                    posts
                INNER JOIN 
                    users ON posts.user_id = users.id
                INNER JOIN 
                    forums ON posts.forum_id = forums.id
                WHERE 
                    posts.featured = 1;";
        $featured_posts = $this->query($sql);
        return $featured_posts;
    }

    /**
     * Fetch all featured posts
     *
     * @return array
     */
    public function get_recent_posts()
    {
        $sql = "SELECT 
                    posts.title AS post_title,
                    posts.post_date,
                    posts.excerpt AS post_excerpt,
                    users.username AS author_name,
                    forums.forum_name AS forum_name
                FROM 
                    posts
                INNER JOIN 
                    users ON posts.user_id = users.id
                INNER JOIN 
                    forums ON posts.forum_id = forums.id
                ORDER BY 
                    posts.post_date DESC
                LIMIT 5;
                ";
        $recent_posts = $this->query($sql);
        return $recent_posts;
    }
}