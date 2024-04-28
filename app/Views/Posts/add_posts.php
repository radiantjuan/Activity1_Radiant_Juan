<!--
Create new posts

@author Radiant C. Juan <K230925@Student.kent.edu.au>
@copyright 2024 Radiant Juan - K230925
-->
<?php

$forums = empty(\App\Config\Views\View::getData('forums')) ? [] : \App\Config\Views\View::getData('forums');
$chosen_forum = empty($_GET['forum']) ? null : $_GET['forum'];

?>
<div class="container mt-4">
    <!-- Page Title -->
    <h2>Create a New Post</h2>

    <!-- Post Form -->
    <form action="/posts/create-posts" method="POST">
        <!-- Title Input -->
        <div class="form-group">
            <label for="postTitle">Title</label>
            <input type="text" class="form-control" id="postTitle" name="title" required>
        </div>

        <!-- Forum Selection -->
        <div class="form-group">
            <label for="forumSelect">Select Forum</label>
            <select class="form-control" id="forumSelect" name="forum_id" required>
                <option value="">Choose a forum</option>
                <?php foreach ($forums as $forum): ?>
                    <option value="<?= $forum['id'] ?>" <?= $chosen_forum === $forum['slug'] ? 'selected' : '' ?>><?= $forum['forum_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Content Input -->
        <div class="form-group">
            <label for="postContent">Content</label>
            <textarea class="form-control" id="postContent" name="content" rows="6" required></textarea>
        </div>

        <!-- Excerpt Input -->
        <div class="form-group">
            <label for="postExcerpt">Excerpt</label>
            <textarea class="form-control" id="postExcerpt" name="excerpt" rows="3"></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
