<!--
Home page view

@author Radiant C. Juan <K230925@Student.kent.edu.au>
@copyright 2024 Radiant Juan - K230925
-->

<?php
$featured_content = \App\Config\Views\View::getData('featured_posts');
$recent_posts = \App\Config\Views\View::getData('recent_posts');

?>
<div class="forum-header text-center mt-5">
    <h1>Welcome to the PHP online discussion forum</h1>
    <p>A place to discuss anything and everything about PHP!</p>
</div>

<div class="container mt-4">
    <div class="row">
        <!-- Featured Content Section -->
        <div class="col-lg-8">
            <h2>Featured Content</h2>
            <?php foreach ($featured_content as $featured): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <a href="/discussion1" class="card-title"><h5><?= $featured['post_title'] ?></h5></a>
                        <p class="card-text"><?= $featured['post_excerpt'] ?></p>
                        <p class="card-text"><small class="text-muted">Author: <a
                                        href="/author1"><?= $featured['author_name'] ?></a> | Forum: <a
                                        href="/forum1"><?= $featured['forum_name'] ?></a></small></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- Add more featured content cards here -->
        </div>

        <!-- Recent Posts and Discussions Section -->
        <div class="col-lg-4">
            <h2>Recent Posts and Discussions</h2>
            <div class="list-group">
                <?php foreach ($recent_posts as $recent_post): ?>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?= $recent_post['post_title'] ?></h5>
                            <small><?= \App\Utilities\DateFormatHelper::formatDate($recent_post['post_date']) ?></small>
                        </div>
                        <p class="mb-1"><?= $recent_post['post_excerpt'] ?></p>
                        <p class="mb-1"><small class="text-muted">Author: <?= $recent_post['author_name'] ?> |
                                Forum: <?= $recent_post['forum_name'] ?></small>
                        </p>
                    </a>
                <?php endforeach; ?>
                <!-- Add more recent posts and discussions list items here -->
            </div>
        </div>
    </div>
</div>