<?php
/**
 * Forums page controller
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Controllers;

use App\Config\Views\View;
use App\Models\ForumsModel;
use App\Utilities\DebugHelper;

class ForumsController extends BaseController
{
    private $forums_model;

    public function __construct()
    {
        parent::__construct();
        $this->forums_model = new ForumsModel();
        $this->requireAuthentication();
    }


    /**
     * Lists of forums page
     *
     * @return void
     */
    public function index()
    {
        $sort_type = empty($_GET['sort_type']) ? null : $_GET['sort_type'];
        $forums = $this->forums_model->get_all_forums_with_posts_counts($sort_type);
        View::render('Forums/index', ['data' => $forums, 'sort_type' => $sort_type]);
    }

    /**
     * Fetch all forum posts
     *
     * @param array $request request payload
     *
     * @return void
     */
    public function forum_posts($request)
    {
        $forum_detail = $this->forums_model->where(['slug' => $request['forum_slug']]);
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $sort_by = !empty($_GET['sort_by']) ? $_GET['sort_by'] : 'post.title';
        $sort_order = !empty($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';
        $search_term = !empty($_GET['q']) ? $_GET['q'] : null;
        $forum_posts = $this->forums_model->get_posts($request['forum_slug'], $page, $sort_by, $sort_order, $search_term);
        View::render('Forums/forum_posts', [
            'data' => [
                'forum_detail' => !empty($forum_detail) ? $forum_detail[0] : null,
                'posts' => !empty($forum_posts) ? $forum_posts : null
            ]
        ]);
    }

}