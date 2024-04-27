<!--
Navigation view

@author Radiant C. Juan <K230925@Student.kent.edu.au>
@copyright 2024 Radiant Juan - K230925
-->
<?php
$user_info = unserialize($_SESSION['user_info']);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Internet Forum</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/articles">Articles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/groups">Groups</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/add-new-article"><i class="fas fa-plus"></i> Post a new article</a>
            </li>
        </ul>
        <ul class="navbar-nav align-right">
            <li class="nav-item">
                <a class="nav-link" href="/user/<?=$user_info['id']?>">
                    <img src="<?= $user_info['avatar'] ?>"
                         alt="User Profile" class="rounded-circle" style="max-width: 30px; max-height: 30px;">
                    <?= $user_info['username']; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Inbox <i class="fas fa-envelope"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout">Logout</a>
            </li>
        </ul>
    </div>
</nav>