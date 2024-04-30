<!--
Groups page view

@author Radiant C. Juan <K230925@Student.kent.edu.au>
@copyright 2024 Radiant Juan - K230925
-->
<?php
$groups = empty(\App\Config\Views\View::getData('groups')) ? [] : \App\Config\Views\View::getData('groups');
$pending_invites = empty(\App\Config\Views\View::getData('group_invites')) ? [] : \App\Config\Views\View::getData('group_invites');
?>
<div class="container mt-4">
    <h2>Groups</h2>
    <div class="row">
        <div class="col-md-6">
            <ul class="list-group">
                <?php foreach ($groups as $group): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="/groups/<?= $group['group_id'] ?>/group_members"
                           class="group-link"><?= $group['group_name'] ?></a>
                        <span class="badge badge-primary badge-pill"><?= $group['member_count'] ?> members</span>
                    </li>
                <?php endforeach; ?>
                <!-- Add more groups here -->
            </ul>
        </div>
    </div>
    <hr>
    <h2>Pending Invites</h2>
    <div class="row">
        <div class="col-md-6">
            <ul class="list-group">
                <?php foreach ($pending_invites as $invite): ?>
                    <li class="list-group-item">
                        <?= $invite['group_name'] ?> - Invited by <?= $invite['invited_by'] ?>
                    </li>
                <?php endforeach; ?>
                <!-- Add more pending invites here -->
            </ul>
        </div>
    </div>
    <hr>
    <h2>Add New Group</h2>
    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="/groups/add-group">
                <div class="form-group">
                    <label for="groupName">Group Name</label>
                    <input type="text" class="form-control" name="group_name" placeholder="Enter group name">
                </div>
                <button type="submit" class="btn btn-primary">Add Group</button>
            </form>
        </div>
    </div>
</div>
