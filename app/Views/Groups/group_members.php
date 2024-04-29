<!--
Group members page view

@author Radiant C. Juan <K230925@Student.kent.edu.au>
@copyright 2024 Radiant Juan - K230925
-->
<?php
$group_members = empty(\App\Config\Views\View::getData('group_members')) ? [] : \App\Config\Views\View::getData('group_members');
$list_of_users = empty(\App\Config\Views\View::getData('list_of_users')) ? [] : \App\Config\Views\View::getData('list_of_users');
?>
<div class="container mt-4">
    <h2>Group Membership - Group Name</h2>
    <hr>
    <h3>Members</h3>
    <div class="row">
        <div class="col-md-6">
            <ul class="list-group">
                <?php foreach ($group_members as $group_member): ?>
                    <li class="list-group-item"><?= $group_member['username'] ?>(<?= $group_member['email'] ?>)</li>
                <?php endforeach; ?>
                <!-- Add more members here -->
            </ul>
        </div>
    </div>
    <hr>
    <h3>Invite Members</h3>
    <div class="row">
        <div class="col-md-6">
            <form>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <select class="form-control" name="email">
                        <option value="">Select email</option>
                        <?php foreach ($list_of_users as $list_of_user): ?>
                            <option value="<?= $list_of_user['id'] ?>"><?= $list_of_user['email'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Invite</button>
            </form>
        </div>
    </div>
</div>