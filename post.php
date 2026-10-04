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
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <?php
                require_once('db.php');
                
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    
                    $sql = "SELECT * FROM posts WHERE id=$id";
                    $res = mysqli_query($link, $sql);
                    
                    if ($res && mysqli_num_rows($res) > 0) {
                        $rows = mysqli_fetch_array($res);
                        $title = $rows['title'];
                        $main_text = $rows['main_text'];
                        $image = $rows['image'];
                        
                        echo "<h1 class='mb-4'> " . htmlspecialchars($title) . " </h1>";
                        
                        if (!empty($image)) {
                            echo "<div class='mb-4'><img src='" . htmlspecialchars($image) . "' class='hacker-img' alt='Post image'></div>";
                        }
                        
                        echo "<p class='lead'> " . nl2br(htmlspecialchars($main_text)) . " </p>";
                    } else {
                        echo "<h3 class='text-danger'>Post not found</h3>";
                    }
                } else {
                    echo "<h3 class='text-danger'>No ID specified</h3>";
                }
                ?>
                <br>
                <a href="index.php" class="btn btn-primary mt-4">Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>