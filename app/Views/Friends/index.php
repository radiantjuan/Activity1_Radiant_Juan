<!--
Friends view

@author Radiant C. Juan <K230925@Student.kent.edu.au>
@copyright 2024 Radiant Juan - K230925
-->
<?php
$user_info = unserialize($_SESSION['user_info']);
$friends = empty(\App\Config\Views\View::getData('friends')) ? [] : \App\Config\Views\View::getData('friends');
$friends_request = empty(\App\Config\Views\View::getData('friends_request')) ? [] : \App\Config\Views\View::getData('friends_request');

$list_of_users = empty(\App\Config\Views\View::getData('users')) ? [] : \App\Config\Views\View::getData('users');
?>
<div class="container">
    <h2>Friends List</h2>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#friends">Friends</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#requests">Pending Requests</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Friends tab -->
        <div id="friends" class="container tab-pane active"><br>
            <div class="row">
                <div class="col-md-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                            data-target="#addFriendModal">
                        Add Friend
                    </button>
                </div>
            </div>
            <ul class="list-group">
                <?php foreach ($friends as $friend): ?>
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <img src="/assets/tier1.png" class="img-fluid rounded-circle" alt="Friend 1"
                                     style="weight: 64px; height: 64px">
                            </div>
                            <div class="col-md-10">
                                <h5 class="mb-1"><?= $friend['friend_name'] ?></h5>
                                <p class="mb-1"><?= $friend['friend_email'] ?></p>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Pending requests tab -->
        <div id="requests" class="container tab-pane fade"><br>
            <ul class="list-group">
                <!-- Pending request 1 -->
                <?php foreach ($friends_request as $friends_re): ?>
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <span class="badge badge-pill badge-primary">New</span>
                            </div>
                            <div class="col-md-8">
                                <h5 class="mb-1">Pending Request from <?= $friends_re['friend_name'] ?></h5>
                                <p class="mb-1"><?= $friends_re['friend_email'] ?></p>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-sm btn-accept"
                                        data-request_id="<?= $friends_re['request_id'] ?>">Accept
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm btn-reject"
                                        data-request_id="<?= $friends_re['request_id'] ?>">Reject
                                </button>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>
</div>

<!-- Add Friend Modal -->
<div class="modal fade" id="addFriendModal" tabindex="-1" role="dialog" aria-labelledby="addFriendModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="/friends/send-friend-request">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFriendModalLabel">Add Friend</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="friendDropdown">Choose friend:</label>
                        <select class="form-control" name="friendDropdown">
                            <?php foreach ($list_of_users as $list_of_user): ?>
                                <option value="<?= $list_of_user['id'] ?>"><?= $list_of_user['email'] ?>
                                    -<?= $list_of_user['username'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
  $(document).ready(function () {
    // Accept friend request
    $(document).on('click', '.btn-accept', function () {
      var request_id = $(this).data('request_id');

      $.ajax({
        url: '/friends', // Replace with your PHP script URL
        type: 'POST',
        data: {
          request_id: request_id,
          accept: 1,
          _method: 'PATCH'
        },
        success: function (response) {
          console.log(response);
          location.href = '/friends';
          // Add your success handling code here
        },
        error: function (xhr, status, error) {
          console.error(error);
          // Add your error handling code here
        }
      });
    });

    // Reject friend request
    $(document).on('click', '.btn-reject', function () {
      var request_id = $(this).data('request_id');
      $.ajax({
        url: '/friends', // Replace with your PHP script URL
        type: 'POST',
        data: {
          request_id: request_id,
          accept: 0,
          _method: 'PATCH'
        },
        success: function (response) {
          location.href = '/friends';
          console.log(response);
          // Add your success handling code here
        },
        error: function (xhr, status, error) {
          console.error(error);
          // Add your error handling code here
        }
      });
    });
  });
</script>
