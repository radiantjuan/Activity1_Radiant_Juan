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
use App\Utilities\DebugHelper;

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
                self::update_user_session($user_exists[0]);
                header('Location: /');
                exit();
            } else {
                View::render('Auth/login', ['error' => ['Incorrect credentials']]);
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

    /**
     * Register the users
     *
     * @param $requests request payload
     *
     * @return void
     */
    public function register_user($requests)
    {
        $user = new UserModel();
        try {
            $user->create(
                [
                    'username' => $requests['name'],
                    'password' => password_hash($requests['password'], PASSWORD_DEFAULT),
                    'email' => $requests['email']
                ]
            );
            header('location: /login');
            exit();
        } catch (\Exception $e) {
            View::render('Auth/registration', ['error' => ['Email is already taken']]);
        }


    }

    /**
     * Logout user and destroys user session
     *
     * @return void
     */
    public function logout_user()
    {
        session_start();
        session_destroy();
        // Redirect to login page or homepage after logout
        header('Location: /login');
        exit();
    }


    /**
     * Update user login session
     *
     * @param array $user
     *
     * @return void
     */
    public static function update_user_session($user)
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_info'] = serialize(
            [
                'id' => $user['id'],
                'email' => $user['email'],
                'username' => $user['username'],
                'role' => $user['role'],
                'avatar' => file_exists($_SERVER['DOCUMENT_ROOT'] . '/assets/' . 'tier' . $user['tier_level'] . '.png')
                    ? '/assets/tier' . $user['tier_level'] . '.png'
                    : 'https://placehold.co/150',
                'tier_level' => $user['tier_level']
            ]
        );
    }
}