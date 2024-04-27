<!--
Forums lists

@author Radiant C. Juan <K230925@Student.kent.edu.au>
@copyright 2024 Radiant Juan - K230925
-->
<div class="container mt-4">
    <h2>Forum</h2>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-group float-md-left">
                <select class="form-control" id="sortSelect">
                    <option value="name_asc" <?= \App\Config\Views\View::getData('sort_type') === 'name_asc' || empty(\App\Config\Views\View::getData('sort_type')) ? 'selected' : '' ?>>Sort by
                        Name (A-Z)
                    </option>
                    <option value="name_desc" <?= \App\Config\Views\View::getData('sort_type') === 'name_desc' ? 'selected' : '' ?>>Sort by Name (Z-A)</option>
                    <option value="created_at_asc" <?= \App\Config\Views\View::getData('sort_type') === 'created_at_asc' ? 'selected' : '' ?>>Sort by Created (Oldest First)</option>
                    <option value="created_at_desc" <?= \App\Config\Views\View::getData('sort_type') === 'created_at_desc' ? 'selected' : '' ?>>Sort by Created (Newest First)</option>
                    <option value="posts_count_asc" <?= \App\Config\Views\View::getData('sort_type') === 'posts_count_asc' ? 'selected' : '' ?>>Sort by Posts (Ascending)</option>
                    <option value="posts_count_desc" <?= \App\Config\Views\View::getData('sort_type') === 'posts_count_desc' ? 'selected' : '' ?>>Sort by Posts (Descending)</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row" id="forumCards">
        <div class="container mt-4">
            <h2>Forum Cards</h2>
            <div class="row">
                <?php foreach (\App\Config\Views\View::getData('data') as $forums): ?>
                    <div class="col-lg-4 mb-4">
                        <a href="/forums/<?= $forums['slug'] ?>/posts" class="card-link">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $forums['forum_name'] ?></h5>
                                    <p class="card-text"><?= $forums['description'] ?></p>
                                    <p class="card-text"><small class="text-muted">Created
                                            At: <?= $forums['created_at'] ?></small>
                                    </p>
                                    <p class="card-text"><small class="text-muted">Posts
                                            Count: <?= $forums['post_count'] ?></small></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
  $(document).ready(function () {
    $('#sortSelect').on('change', function (event) {
      location.href = '/forums?sort_type=' + $(event.currentTarget).val()
    });
  });
</script>