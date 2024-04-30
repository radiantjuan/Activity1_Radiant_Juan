<?php
/**
 * Posts page controller
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Controllers;

use App\Config\Views\View;
use App\Models\ForumsModel;
use App\Models\PostModel;
use App\Models\PostRepliesModel;
use App\Utilities\DebugHelper;

class PostsController extends BaseController
{
    private $post_model;

    private $post_replies_model;

    private $forum_model;

    private $errors;

    public function __construct()
    {
        parent::__construct();
        $this->post_model = new PostModel();
        $this->post_replies_model = new PostRepliesModel();
        $this->forum_model = new ForumsModel();
        $this->requireAuthentication();
    }


    /**
     * Lists of forums page
     *
     * @return void
     */
    public function index($request)
    {
        $user_id = $_SESSION['user_id'];
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $sort_by = !empty($_GET['sort_by']) ? $_GET['sort_by'] : 'post.title';
        $sort_order = !empty($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';
        $search_term = !empty($_GET['q']) ? $_GET['q'] : null;
        $posts = $this->post_model->get_posts_by_user_id($user_id, $page, $sort_by, $sort_order, $search_term);
        View::render('Posts/user_posts', compact('posts'));
    }

    /**
     * Lists of forums page
     *
     * @return void
     */
    public function add_posts($request)
    {
        $forums = $this->forum_model->all();
        View::render('Posts/add_posts', compact('forums'));
    }

    /**
     * Create a new posts
     *
     * @param array $request
     *
     * @return void
     */
    public function create_posts($request)
    {
        $current_user_id = $_SESSION['user_id'];
        $this->errors = $this->validate_post_fields($request);
        if (empty($this->errors)) {
            $request['user_id'] = $current_user_id;
            $created_posts = $this->post_model->create($request);
        }
        header('Location: /posts/' . $created_posts);
        exit;
    }

    /**
     * Post page
     *
     * @param array $request request payload
     *
     * @return void
     */
    public function show($request)
    {
        $post_id = $request['post_id'];
        $post = $this->post_model->get_post_details($post_id);
        $post_replies = $this->post_model->get_post_replies($post_id);
        View::render('Posts/show', [
            'post' => !empty($post) ? $post : null,
            'post_replies' => !empty($post_replies) ? $post_replies : [],
            'error' => empty($_SESSION['error']) ? null : $_SESSION['error'],
            'success' => empty($_SESSION['success']) ? null : $_SESSION['success']
        ]);
        unset($_SESSION['error']);
        unset($_SESSION['success']);
    }

    /**
     * Adding reply to a post
     *
     * @param array $request request payload
     *
     * @return void
     */
    public function reply_to_post($request)
    {
        $current_user_id = $_SESSION['user_id'];
        $data = [
            'user_id' => (int)$current_user_id,
            'post_id' => $request['post_id'],
            'content' => $request['replyContent'],
            'votes' => 0
        ];

        if (empty($data['content'])) {
            $_SESSION['error'] = ['Please enter a reply'];
            header('Location: /posts/' . $request['post_id']);
            exit();
        }

        try {
            $this->post_replies_model->create($data);
            $_SESSION['success'] = 'Reply added successfully';
        } catch (\Exception $e) {
            $_SESSION['error'] = [$e->getMessage()];
            header('Location: /posts/' . $request['post_id']);
            exit();
        }

        header('Location: /posts/' . $request['post_id']);
        exit();
    }

    /**
     * Voting up and down a reply
     *
     * @param array $request request payload
     *
     * @return string
     */
    public function vote_reply($request)
    {
        header('Content-Type: application/json');

        $post_reply = $this->post_replies_model->find($request['reply_id']);
        $vote = $post_reply['votes'];
        if ($request['vote'] === 'up') {
            $vote += 1;
        } else {
            $vote -= 1;
        }

        $this->post_replies_model->update($request['reply_id'], ['votes' => $vote]);
        $post_reply = $this->post_replies_model->find($request['reply_id']);
        echo json_encode(['vote' => $post_reply['votes']]);
    }


    /**
     * Validate input fields
     *
     * @param array $request_payload request payload to be validated
     *
     * @return array
     */
    private function validate_post_fields($request_payload)
    {
        $errors = [];

        // Validate title
        if (empty($request_payload['title'])) {
            $errors[] = "Title is required.";
        }

        if (strlen($request_payload['title']) > 50) {
            $errors[] = "Title should be 50 characters max";
        }

        // Validate forum ID
        if (empty($request_payload['forum_id'])) {
            $errors[] = "Forum is required.";
        }

        // Validate content
        if (empty($request_payload['content'])) {
            $errors[] = "Content is required.";
        }

        // Validate excerpt if provided
        if (empty($request_payload['excerpt'])) {
            $errors[] = "Excerpt must be less than 255 characters.";
        }

        // Validate featured flag
        if (!in_array($request_payload['featured'], [0, 1])) {
            $errors[] = "Invalid value for featured flag.";
        }

        return $errors;
    }

    public function delete_post($request)
    {
        $this->post_model->delete($request['post_id']);
        header('Location: /posts');
        exit();
    }

}