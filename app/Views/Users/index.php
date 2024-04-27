<!--
User edit view

@author Radiant C. Juan <K230925@Student.kent.edu.au>
@copyright 2024 Radiant Juan - K230925
-->

<?php

use App\Config\Views\View;

$username = empty(View::getData('data')['username']) ? null : View::getData('data')['username'];
$email = empty(View::getData('data')['email']) ? null : View::getData('data')['email'];
$role = empty(View::getData('data')['role']) ? null : View::getData('data')['role'];
$tier_level = empty(View::getData('data')['tier_level']) ?: View::getData('data')['tier_level'];
$avatar = empty(View::getData('data')['avatar']) ? null : View::getData('data')['avatar'];

?>
<style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        max-width: 500px;
        margin-top: 50px;
    }

    .form-group {
        margin-bottom: 20px;
    }
</style>
<div class="container mb-5">
    <h2>Edit Profile</h2>
    <hr>
    <?php if (!empty(View::getData('error'))): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (View::getData('error') as $errors): ?>
                    <li>
                        <?= $errors ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if (!empty(View::getData('success'))): ?>
        <div class="alert alert-success">
            <?= View::getData('success') ?>
        </div>
    <?php endif; ?>
    <form method="POST">
        <input type="hidden" name="_method" value="PATCH">
        <div class="form-group">
            <label for="username">Name:</label>
            <input type="text" class="form-control" name="username" value="<?= $username ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="<?= $email ?>">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password">
        </div>
        <?php if (in_array($role, ['admin', 'moderator'])): ?>
            <div class="form-group">
                <label for="tier_level">Tier Level:</label>
                <input type="number" class="form-control" name="tier_level" value="<?= $tier_level ?>">
            </div>
            <?php if ($role === 'admin'): ?>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select class="form-control" name="role">
                        <option value="admin" <?= $role !== 'admin' ?: 'selected' ?>>Admin</option>
                        <option value="moderator" <?= $role !== 'moderator' ?: 'selected' ?>>Moderator
                        </option>
                        <option value="user" <?= $role !== 'user' ?: 'selected' ?>>User</option>
                    </select>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="form-group">
            <label for="avatar">Avatar Rank:</label>
            <img class="mt-3"
                 src="<?= $avatar ?>"
                 alt="" style="max-width: 150px; max-height: 150px;">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="/" class="btn btn-secondary">Cancel</a>
    </form>
</div>
