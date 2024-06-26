<?php

namespace App\Controllers;

class BaseController
{
    public function __construct()
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            // Set session lifetime to 30 minutes (1800 seconds)
            $sessionLifetime = 1800; // 30 minutes

            // Set the session cookie parameters
            session_set_cookie_params($sessionLifetime);
            session_start();
        }
    }

    /**
     * checks if the user is logged-in, if not it will redirect the user to login pages
     *
     * @return void
     */
    protected function requireAuthentication()
    {
        // Check if user is not logged in
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page
            header('Location: /login'); // Adjust the URL as needed
            exit();
        }
    }
}
