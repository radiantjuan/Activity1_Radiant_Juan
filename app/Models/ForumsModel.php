<?php
/**
 * Forums model
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Models;

use App\Config\Database\BaseModel;
use App\Utilities\DebugHelper;

class ForumsModel extends BaseModel
{
    public $table = 'forums';

    const DEFAULT_POST_PER_PAGE = 5;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fetch all forums with posts count
     *
     * @param string $sort_option sort by options
     *
     * @return array|false
     */
    public function get_all_forums_with_posts_counts($sort_option)
    {
        switch ($sort_option) {
            case 'name_asc':
                $sort_by = 'f.forum_name';
                $sort_order = 'ASC';
                break;
            case 'name_desc':
                $sort_by = 'f.forum_name';
                $sort_order = 'DESC';
                break;
            case 'created_at_asc':
                $sort_by = 'f.created_at';
                $sort_order = 'ASC';
                break;
            case 'created_at_desc':
                $sort_by = 'f.created_at';
                $sort_order = 'DESC';
                break;
            case 'posts_count_asc':
                $sort_by = 'post_count';
                $sort_order = 'ASC';
                break;
            case 'posts_count_desc':
                $sort_by = 'post_count';
                $sort_order = 'DESC';
                break;
            default:
                // Default sorting by forum name (A-Z)
                $sort_by = 'f.forum_name';
                $sort_order = 'ASC';
                break;
        }

// Construct the SQL query with dynamic sorting
        $sql = "
            SELECT 
                f.forum_name,
                f.description,
                f.created_at,
                f.slug,
                COUNT(p.id) AS post_count
            FROM 
                forums f
            LEFT JOIN 
                posts p ON f.id = p.forum_id
            GROUP BY 
                f.id
            ORDER BY 
                $sort_by $sort_order;
        ";
        return $this->query($sql);
    }


    /**
     * Get forum posts
     *
     * @param string $slug        forum slug
     * @param int    $page        current pagination page
     * @param string $sort_by     sorting by
     * @param string $sort_order  sorting order
     * @param string $search_term search term
     *
     * @return array
     */
    public function get_posts($slug, $page = 1, $sort_by = 'post_date', $sort_order = 'DESC', $search_term = '')
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
        $sql = "SELECT posts.id, posts.title, posts.excerpt, posts.content, posts.post_date, users.username AS author
            FROM posts
            JOIN forums ON posts.forum_id = forums.id
            JOIN users ON posts.user_id = users.id
            WHERE forums.slug = :slug";

        // Append search condition if search term is not empty
        if (!empty($search_term)) {
            $sql .= " AND (posts.title LIKE :search_term OR posts.content LIKE :search_term)";
        }

        $sql .= " ORDER BY $sort_by $sort_order
              LIMIT $offset, $posts_per_page;";

        // Execute the query with pagination parameters and search term
        $params = [':slug' => $slug];
        if (!empty($search_term)) {
            $params[':search_term'] = "%$search_term%"; // Surround the search term with wildcards
        }
        $posts = $this->query($sql, $params);

        // Calculate the total number of posts
        $total_posts_sql = "SELECT COUNT(*) as total_posts
                        FROM posts
                        JOIN forums ON posts.forum_id = forums.id
                        WHERE forums.slug = :slug";

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