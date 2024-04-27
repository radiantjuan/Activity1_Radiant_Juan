<?php
/**
 * Posts page controller
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Controllers;

use App\Config\Views\View;
use App\Models\PostModel;
use App\Models\PostRepliesModel;
use App\Utilities\DebugHelper;

class PostsController extends BaseController
{
    private $post_model;

    private $post_replies_model;

    public function __construct()
    {
        parent::__construct();
        $this->post_model = new PostModel();
        $this->post_replies_model = new PostRepliesModel();
        $this->requireAuthentication();
    }


    /**
     * Lists of forums page
     *
     * @return void
     */
    public function index()
    {
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
}