<?php
/**
 * Home page controller
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Controllers;

use App\Config\Views\View;
use App\Models\PostModel;
use App\Utilities\DebugHelper;

class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->requireAuthentication();
    }

    /**
     * Home page of online forum
     *
     * @return void
     */
    public function index()
    {
        //establishes that the user needs to be logged in
        $post_model = new PostModel();
        $featured_posts = $post_model->get_featured_posts();
        $recent_posts = $post_model->get_recent_posts();
        View::render('Home/index', compact('featured_posts', 'recent_posts'));
    }
}