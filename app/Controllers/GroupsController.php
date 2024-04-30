<?php
/**
 * Groups page controller
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Controllers;

use App\Config\Views\View;
use App\Models\GroupsMembershipModel;
use App\Models\GroupsModel;
use App\Models\UserModel;
use App\Utilities\DebugHelper;

class GroupsController extends BaseController
{
    private $group_model;
    private $group_members_model;

    public function __construct()
    {
        parent::__construct();
        $this->requireAuthentication();
        $this->groups_model = new GroupsModel();
        $this->group_members_model = new GroupsMembershipModel();
    }

    /**
     * Home page of online forum
     *
     * @return void
     */
    public function index()
    {
        $groups = $this->groups_model->get_groups_with_member_counts();
        $group_invites = $this->group_members_model->get_group_membership_invites();
        View::render('Groups/index', compact('groups', 'group_invites'));
    }

    /**
     * Add groups
     *
     * @param array $request request payload
     *
     * @return void
     */
    public function add_group($request)
    {
        $user_id = $_SESSION['user_id'];
        $request['created_by'] = $user_id;
        $this->groups_model->create($request);
        header('Location: /groups');
        exit();
    }


    /**
     * Show groups members page
     *
     * @return void
     */
    public function group_members($request)
    {
        $group_members = $this->group_members_model->get_group_members($request['group_id']);
        $users = new UserModel();
        $list_of_users = $users->all();
        View::render('Groups/group_members', compact('group_members', 'list_of_users'));
    }
}