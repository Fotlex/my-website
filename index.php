<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('db.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Симанков Александр</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mb-4">Log In!</h1>
                
                <div class="d-flex justify-content-center gap-3 mb-5">
                    <a href="registration.php" class="btn btn-primary">Registration</a>
                    <a href="login.php" class="btn btn-primary">Login</a>
                </div>

                <hr class="border-success">
                <h3 class="text-success mb-3">Posts:</h3>

                <?php
                require_once('db.php');
                
                $sql = "SELECT * FROM posts";
                $res = mysqli_query($link, $sql);
                
                if ($res && mysqli_num_rows($res) > 0) {
                    while ($post = mysqli_fetch_array($res)) {
                        echo "<a href='/post.php?id=" . $post["id"] . "' class='d-block mb-2 text-success'>" . htmlspecialchars($post["title"]) . "</a>";
                    }
                } else {
                    echo "<p class='text-muted'>No posts yet</p>";
                }
                ?>

            </div>
        </div>
    </div>

</body>
</html>