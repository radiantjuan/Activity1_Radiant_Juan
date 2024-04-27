<?php
/**
 * Home page controller
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Controllers;

use App\Config\Views\View;

class HomeController extends BaseController
{
    /**
     * Home page of online forum
     *
     * @return void
     */
    public function index() {
        //establishes that the user needs to be logged in
        $this->requireAuthentication();
        View::render('Home/index');
    }
}