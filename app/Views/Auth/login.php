<!--
Login page view

@author Radiant C. Juan <K230925@Student.kent.edu.au>
@copyright 2024 Radiant Juan - K230925
-->

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
    <h2 class="text-center">PHP online discussion forum</h2>
    <form method="POST">
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
    <hr>
    <p class="text-center">New user? <a href="/register">Register here</a></p>
</div>