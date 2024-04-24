<style>
    /* Add custom styles here */
    .container {
        max-width: 400px;
        margin-top: 50px;
    }

    .form-group {
        margin-bottom: 20px;
    }
</style>

<div class="container">
    <h2 class="text-center">Registration Form</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
    <hr>
    <p class="text-center">Already have an account? <a href="/login">Login</a></p>
</div>