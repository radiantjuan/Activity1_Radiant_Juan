<?php
$post = empty(\App\Config\Views\View::getData('post')) ?: \App\Config\Views\View::getData('post');
$post_replies = empty(\App\Config\Views\View::getData('post_replies')) ? [] : \App\Config\Views\View::getData('post_replies');
?>
<div class="container mt-4">
    <!-- Forum Post -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title"><?= $post['title'] ?></h5>
            <small>Posted by <?= $post['title'] ?> on <?= date('Y-m-d', strtotime($post['post_date'])) ?></small>
        </div>
        <div class="card-body">
            <p class="card-text"><?= $post['content'] ?></p>
            <p class="card-text"><strong>Excerpt:</strong> <?= $post['excerpt'] ?></p>
        </div>
    </div>

    <!-- Reply Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">Reply to Post</h5>
        </div>
        <div class="card-body">
            <?php if (!empty(\App\Config\Views\View::getData('success'))): ?>
                <div class="alert alert-success">
                    <?= \App\Config\Views\View::getData('success') ?>
                </div>
            <?php endif; ?>
            <?php if (!empty(\App\Config\Views\View::getData('error'))): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (\App\Config\Views\View::getData('error') as $errors): ?>
                            <li>
                                <?= $errors ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="/posts/<?= $post['id'] ?>/reply">
                <div class="form-group">
                    <label for="replyContent">Your Reply</label>
                    <textarea class="form-control" name="replyContent" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Reply</button>
            </form>
        </div>
    </div>

    <!-- Replies Section -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Replies</h5>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($post_replies as $post_reply): ?>
                <li class="list-group-item" data-reply-id="<?= $post_reply['id'] ?>">
                    <p><?= $post_reply['content'] ?></p>
                    <small>Posted by <?= $post_reply['author'] ?> on <?= $post_reply['reply_date'] ?></small>
                    <div class="mt-2">
                        <button type="button" class="btn btn-outline-primary btn-sm mr-2 upvote"><i
                                    class="fas fa-arrow-up"></i></button>
                        <button type="button" class="btn btn-outline-primary btn-sm downvote"><i
                                    class="fas fa-arrow-down"></i></button>
                        <span class="badge badge-secondary vote-count"
                              data-reply-id="<?= $post_reply['id'] ?>"><?= $post_reply['votes'] ?> votes</span>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<!-- jQuery script for upvoting and downvoting -->
<script>
  $(document).ready(function () {
    $('.upvote').click(function () {
      var replyId = $(this).closest('li').data('reply-id');
      // Send an AJAX request to upvote the reply with the given ID
      $.ajax({
        url: '/posts/post_reply/vote',
        type: 'POST',
        data: {vote: 'up', reply_id: replyId, _method: 'PATCH'},
        success: function (response) {
          // Update the vote count
          $('.vote-count[data-reply-id="' + replyId + '"]').text(response.vote + ' votes');
        }
      });
    });

    $('.downvote').click(function () {
      var replyId = $(this).closest('li').data('reply-id');
      // Send an AJAX request to downvote the reply with the given ID
      $.ajax({
        url: '/posts/post_reply/vote',
        type: 'POST',
        data: {vote: 'down', reply_id: replyId, _method: 'PATCH'},
        success: function (response) {
          // Update the vote count
          $('.vote-count[data-reply-id="' + replyId + '"]').text(response.vote + ' votes');
        }
      });
    });
  });
</script>
