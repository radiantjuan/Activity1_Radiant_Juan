<?php
/**
 * Authentication controller
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Controllers\Auth;

use App\Config\Views\View;
use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        View::render('Auth/login');
    }

    /**
     * Login user session
     *
     * @param array $request request payload
     *
     * @return void
     */
    public function login_user($request)
    {
        if (!empty($request['email']) && !empty($request['password'])) {
            $email = $request['email'];
            $password = $request['password'];

            $user = new UserModel();
            $user_exists = $user->where(['email' => $email]);
            if (!empty($user_exists) && password_verify($password, $user_exists[0]['password'])) {
                $_SESSION['user_id'] = $user_exists[0]['id'];
                unset($_SESSION['login_error']);
                header('Location: /');
                exit();
            } else {
                $_SESSION['login_error'] = 'Incorrect login';
                header('Location: /login');
                exit();
            }
        }
    }

    /**
     * Registration page
     *
     * @return void
     */
    public function register()
    {
        View::render('Auth/registration');
    }

    public function register_user($requests)
    {
        $user = new UserModel();
        $user->create(
            [
                'username' => $requests['name'],
                'password' => password_hash($requests['password'], PASSWORD_DEFAULT),
                'email' => $requests['email']
            ]
        );

        header('location: /login');
        exit();
    }

    /**
     * Logout user and destroys user session
     *
     * @return void
     */
    public function logout_user() {
        session_start();
        session_destroy();
        // Redirect to login page or homepage after logout
        header('Location: /login');
        exit();
    }
}