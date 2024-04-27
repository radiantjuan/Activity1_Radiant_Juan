<!--
Forums posts lists

@author Radiant C. Juan <K230925@Student.kent.edu.au>
@copyright 2024 Radiant Juan - K230925
-->
<?php
$forum_name = !empty(App\Config\Views\View::getData('data')['forum_detail'])
    ? App\Config\Views\View::getData('data')['forum_detail']['forum_name']
    : null;
$forum_description = !empty(App\Config\Views\View::getData('data')['forum_detail'])
    ? App\Config\Views\View::getData('data')['forum_detail']['description']
    : null;
$forum_slug = !empty(App\Config\Views\View::getData('data')['forum_detail'])
    ? App\Config\Views\View::getData('data')['forum_detail']['slug']
    : null;
$posts = !empty(\App\Config\Views\View::getData('data')['posts']) ? \App\Config\Views\View::getData('data')['posts']['posts'] : [];
$posts_total_pages = !empty(\App\Config\Views\View::getData('data')['posts']) ? \App\Config\Views\View::getData('data')['posts']['total_pages'] : [];

$current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
$prev_page_url = !empty($_GET['page']) ? '/forums/' . $forum_slug . '/posts?page=' . ((int)$current_page - 1) : '';
$next_page_url = !empty($_GET['page']) ? '/forums/' . $forum_slug . '/posts?page=' . ((int)$current_page + 1) : '';

?>
<div class="container mt-4">
    <!-- Forum Title -->
    <h2><?= $forum_name ?></h2>

    <!-- Forum Description -->
    <p><?= $forum_description ?></p>

    <!-- New Post Button -->
    <a href="/new-post" class="btn btn-primary mb-3">New Post</a>

    <!-- Search Form -->
    <form action="/forums/<?= $forum_slug ?>/posts" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" name="q" placeholder="Search posts">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Sorting Controls -->
    <div class="btn-group mb-3" role="group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
            Sort By
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="/forums/<?= $forum_slug ?>/posts?sort_by=title&sort_order=ASC">Title (A-Z)</a>
            <a class="dropdown-item" href="/forums/<?= $forum_slug ?>/posts?sort_by=title&sort_order=DESC">Title (Z-A)</a>
            <a class="dropdown-item" href="/forums/<?= $forum_slug ?>/posts?sort_by=post_date&sort_order=ASC">Date (Oldest First)</a>
            <a class="dropdown-item" href="/forums/<?= $forum_slug ?>/posts?sort_by=post_date&sort_order=DESC">Date (Newest First)</a>
        </div>
    </div>

    <!-- Post List -->
    <div class="list-group">
        <?php foreach ($posts as $post) : ?>
            <a href="/posts/<?= $post['id'] ?>" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?= $post['title'] ?></h5>
                    <small><?= $post['post_date'] ?></small>
                </div>
                <p class="mb-1"><?= $post['excerpt'] ?></p>
                <small><?= $post['author'] ?></small>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="<?= $prev_page_url ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $posts_total_pages; $i++) : ?>
                <li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
                    <a class="page-link"
                       href="/forums/<?= $forum_slug ?>/posts?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item">
                <a class="page-link" href="<?= $next_page_url ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

