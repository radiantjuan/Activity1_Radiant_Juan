<?php

/**
 * Messaging controller
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Controllers;

use App\Config\Views\View;
use App\Models\MessagingModel;
use App\Utilities\DebugHelper;

class MessagingController extends BaseController
{
    private $messaging_model;

    public function __construct()
    {
        parent::__construct();
        $this->messaging_model = new MessagingModel();
        $this->requireAuthentication();
    }

    /**
     * Inbox page controller
     *
     * @return void
     */
    public function inbox()
    {
        $current_page = empty($_GET['current_page']) ? 1 : $_GET['current_page'];
        $messages = $this->messaging_model->get_inbox($current_page);
        $receipients = $this->messaging_model->get_receipients();
        $active_page = 'inbox';
        View::render('Messaging/inbox', compact('messages', 'active_page', 'receipients'));
    }

    /**
     * Inbox page controller
     *
     * @return void
     */
    public function sent()
    {
        $current_page = empty($_GET['current_page']) ? 1 : $_GET['current_page'];
        $messages = $this->messaging_model->get_sent($current_page);
        $receipients = $this->messaging_model->get_receipients();
        $active_page = 'sent';
        View::render('Messaging/sent', compact('messages', 'active_page', 'receipients'));
    }

    public function get_all_users($request)
    {
        $sender_id = $_SESSION['user_id'];
        $this->messaging_model->create([
            'sender_id' => $sender_id,
            'receiver_id' => $request['recipient'],
            'message' => $request['message']
        ]);
        header('Location: /messages/sent');
        exit();
    }
}