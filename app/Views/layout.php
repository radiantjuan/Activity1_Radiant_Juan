<!-- layout.php -->
<!--
Layout view

@author Radiant C. Juan <K230925@Student.kent.edu.au>
@copyright 2024 Radiant Juan - K230925
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
            integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .forum-header {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 0;
        }

        .forum-post {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            padding-right: 15px;
        }

        .navbar-nav .nav-item.active {
            font-weight: bold;
        }

        .navbar-brand img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 5px;
        }
    </style>
    <title>
        Online Discussion Forum
    </title>
</head>
<body>
<?php
//
$user_logged_in = empty($_SESSION['user_id']) ? false : $_SESSION['user_id'];
?>

<?php
if (!empty($user_logged_in)) {
    include 'nav.php';
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <main>
                <?= $content ?>
            </main>
        </div>
    </div>
</div>
<?php
if (!empty($user_logged_in)) {
    include 'footer.php';
}
?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>