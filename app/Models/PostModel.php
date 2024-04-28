<?php
/**
 * Posts model
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Models;

use App\Config\Database\BaseModel;
use App\Utilities\DebugHelper;

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
                    posts.id AS id,
                    posts.title AS post_title,
                    posts.excerpt AS post_excerpt,
                    users.username AS author_name,
                    forums.forum_name AS forum_name,
                    forums.slug AS slug
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
                    posts.id AS id,
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

    /**
     * Get posts by ID
     *
     * @param int    $user_id     forum slug
     * @param int    $page        current pagination page
     * @param string $sort_by     sorting by
     * @param string $sort_order  sorting order
     * @param string $search_term search term
     *
     * @return array
     */
    public function get_posts_by_user_id($user_id, $page = 1, $sort_by = 'post_date', $sort_order = 'DESC', $search_term = '')
    {
        $posts_per_page = self::DEFAULT_POST_PER_PAGE;

        // Calculate the offset based on the current page
        $offset = ($page - 1) * $posts_per_page;

        // Define the allowed sort columns and orders
        $allowed_columns = ['title', 'post_date'];
        $allowed_orders = ['ASC', 'DESC'];

        // Validate the sort column and order
        if (!in_array($sort_by, $allowed_columns)) {
            $sort_by = 'post_date'; // Default to 'post_date' if invalid
        }
        if (!in_array($sort_order, $allowed_orders)) {
            $sort_order = 'DESC'; // Default to 'DESC' if invalid
        }

        // SQL query to fetch posts with pagination and sorting
        $sql = "SELECT posts.id, posts.title, posts.excerpt, posts.content, posts.post_date, posts.posts_status, forums.forum_name AS forum_name
            FROM posts
            JOIN forums ON posts.forum_id = forums.id
            WHERE posts.user_id = :user_id";

        // Append search condition if search term is not empty
        if (!empty($search_term)) {
            $sql .= " AND (posts.title LIKE :search_term OR posts.content LIKE :search_term)";
        }

        $sql .= " ORDER BY $sort_by $sort_order
              LIMIT $offset, $posts_per_page;";

        // Execute the query with pagination parameters and search term
        $params = [':user_id' => $user_id];
        if (!empty($search_term)) {
            $params[':search_term'] = "%$search_term%"; // Surround the search term with wildcards
        }
        $posts = $this->query($sql, $params);

        // Calculate the total number of posts
        $total_posts_sql = "SELECT COUNT(*) as total_posts
                        FROM posts
                        WHERE posts.user_id = :user_id";

        // Append search condition if search term is not empty
        if (!empty($search_term)) {
            $total_posts_sql .= " AND (posts.title LIKE :search_term OR posts.content LIKE :search_term)";
        }

        $total_posts_sql .= ";";

        $total_posts = $this->query($total_posts_sql, $params)[0]['total_posts'];

        // Calculate the total number of pages
        $total_pages = ceil($total_posts / $posts_per_page);
        // Return the posts along with pagination information
        return ['posts' => $posts, 'total_pages' => $total_pages];
    }
}