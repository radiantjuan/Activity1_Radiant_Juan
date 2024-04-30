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
    /**
     * Login page
     *
     * @return void
     */
    public function login()
    {
        View::render('Auth/login', ['error' => empty($_SESSION['error']) ? null : $_SESSION['error']]);
        unset($_SESSION['error']);
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
                $_SESSION['error'] = 'Incorrect username/password';
                header('Location: /');
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
        View::render('Auth/registration', ['error' => $_SESSION['error']]);
        unset($_SESSION['error']);
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
        $this->errors = $this->validate_inputs($requests);
        if (!empty($this->errors)) {
            $_SESSION['error'] = $this->errors;
            header('location: /register');
            exit();
        }

        try {
            if (empty($this->errors)) {
                $user->create(
                    [
                        'username' => $requests['username'],
                        'password' => password_hash($requests['password'], PASSWORD_DEFAULT),
                        'email' => $requests['email']
                    ]
                );
                unset($_SESSION['error']);
                header('location: /login');
                exit();
            }

            throw new \Exception('User cannot be registered, please contact Administrator', '422');

        } catch (\Exception $e) {
            if ($e->getCode() === '23000') {
                $_SESSION['error'] = ['Email is already taken'];
            }

            if ($e->getCode() === 422) {
                $_SESSION['error'] = [$e->getMessage()];
            }

            header('location: /register');
            exit();
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


    /**
     * Validate input fields
     *
     * @param $inputs request payload to be validated
     *
     * @return array
     */
    public function validate_inputs($inputs)
    {
        $errors = [];

        // Validate username
        if (!isset($inputs['username']) || empty($inputs['username'])) {
            $errors[] = 'Username is required';
        } elseif (strlen($inputs['username']) > 55) {
            $errors[] = 'Username must be maximum 55 characters';
        }

        // Validate email
        if (!isset($inputs['email']) || empty($inputs['email']) || !filter_var($inputs['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        }

        // Validate password
        if (!isset($inputs['password']) || empty($inputs['password'])) {
            $errors[] = 'Password is required';
        } elseif (!preg_match('/^(?=.*[!@#$%^&*])(?=.*[A-Z])(?=.*[0-9]).{8,}$/', $inputs['password'])) {
            $errors[] = 'Password should consist of at least 1 special character, 1 uppercase letter, and 1 number, and be at least 8 characters long';
        }

        return $errors;
    }
}