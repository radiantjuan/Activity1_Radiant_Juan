<?php
/**
 * Friends page controller
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Controllers;

use App\Config\Views\View;
use App\Models\FriendsModel;
use App\Models\PostModel;
use App\Models\UserModel;
use App\Utilities\DebugHelper;

class FriendsController extends BaseController
{
    private $friends_model;

    public function __construct()
    {
        parent::__construct();
        $this->friends_model = new FriendsModel();
        $this->requireAuthentication();
    }

    /**
     * Friends page
     *
     * @return void
     */
    public function index()
    {
        $friends = $this->friends_model->get_friends_list();
        $friends_request = $this->friends_model->get_friend_requests();
        $users_model = new UserModel();
        $users = $users_model->all();
        View::render('Friends/index', compact('friends', 'friends_request', 'users'));
    }

    /**
     * Process friend requests
     *
     * @param $request
     *
     * @return void
     */
    public function process_friend_request($request)
    {
        unset($request['_method']);
        $accept = $request['accept'] ? 'accepted' : 'rejected';
        $this->friends_model->update($request['request_id'], ['status' => $accept]);
        echo json_encode(['success' => true]);
    }

    public function send_friend_request($request) {
        $user_id = $_SESSION['user_id'];
        $this->friends_model->create([
            'sender_id' => $user_id,
            'receiver_id' => $request['friendDropdown']
        ]);
        header('Location: /friends');
        exit();
    }
}