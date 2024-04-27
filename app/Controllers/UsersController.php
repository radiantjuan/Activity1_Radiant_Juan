<?php
/**
 * Users page controller
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Controllers;

use App\Config\Views\View;
use App\Models\UserModel;
use App\Utilities\DebugHelper;

class UsersController extends BaseController
{
    private $errors;

    private $user_model;

    private $user_info;


    public function __construct()
    {
        parent::__construct();
        $this->user_info = unserialize($_SESSION['user_info']);
        $this->user_model = new UserModel();
        $this->requireAuthentication();
    }

    /**
     * User edit profile page
     *
     * @return void
     */
    public function index($requests)
    {
        View::render('Users/index', [
            'data' => $this->user_info,
            'success' => $_SESSION['success'],
            'error' => $_SESSION['error']
        ]);
        unset($_SESSION['success'], $_SESSION['error']);
    }

    /**
     * update user information
     *
     * @param $request
     *
     * @return void
     */
    public function update_user($request)
    {
        $this->requireAuthentication();
        $update = $this->user_model->find_user_by_id($request['id']);
        $request['password'] = empty($request['password']) ? $update['password'] : $request['password'];

        if ($update['role'] !== 'admin') {
            $request['tier_level'] = $update['tier_level'];
            $request['role'] = $update['role'];
        }

        //validate user inputs
        $this->errors = $this->validate_inputs($request);

        if (empty($this->errors)) {
            //unset unnecessary data
            unset($request['_method']);

            try {
                $updated_user = $this->user_model->update_user($request['id'], $request);
                //update user session once the user has been updated
                \App\Controllers\Auth\AuthController::update_user_session($updated_user);
                $_SESSION['success'] = 'Your profile is now updated!';
                header('Location: /user/' . $updated_user['id']);
                exit();
            } catch (\Exception $e) {
                $_SESSION['error'] = 'Something is not right';
                header('Location: /user/' . $update['id']);
                exit();
            }

        } else {
            $_SESSION['error'] = $this->errors;
        }

        header('Location: /user/' . $update['id']);
        exit();
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

        // Validate tier_level
        if (!isset($inputs['tier_level']) || !is_numeric($inputs['tier_level'])) {
            $errors[] = 'Tier level must be numeric';
        }

        // Validate role
        $allowed_roles = ['admin', 'moderator', 'user'];
        if (!isset($inputs['role']) || !in_array($inputs['role'], $allowed_roles)) {
            $errors[] = 'Invalid role';
        }

        return $errors;
    }
}