<style>
    /* Add custom styles here */
    .container {
        max-width: 800px;
        margin-top: 50px;
    }
    .user-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
    .forum-post {
        margin-bottom: 20px;
    }
</style>
<div class="container">
    <h2>Welcome to the Discussion Forum</h2>
    <hr>
    <div class="row">
        <div class="col-md-8">
            <h4>Recent Posts</h4>
            <!-- Example Forum Post -->
            <div class="forum-post">
                <h5>Post Title</h5>
                <p>Posted by: <strong>Username</strong> | Date: <span class="text-muted">YYYY-MM-DD</span></p>
                <p>Post content goes here...</p>
            </div>
            <!-- More Forum Posts... -->
        </div>
        <div class="col-md-4">
            <h4>Online Users</h4>
            <!-- List of Online Users -->
            <ul class="list-group">
                <li class="list-group-item d-flex align-items-center">
                    <img src="user1.jpg" alt="User Avatar" class="user-avatar mr-2">
                    <span>User1</span>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <img src="user2.jpg" alt="User Avatar" class="user-avatar mr-2">
                    <span>User2</span>
                </li>
                <!-- More Online Users... -->
            </ul>
        </div>
    </div>
    <hr>
    <p class="text-center">Logged in as: <strong>Username</strong> | <a href="/logout">Logout</a></p>
</div>
