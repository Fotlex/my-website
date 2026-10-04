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

    <nav class="navbar navbar-dark bg-dark p-3">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand d-flex align-items-center">
                <span class="text-light">History</span>
            </a>
            <?php if (isset($_COOKIE['User'])): ?>
                <form action="/logout.php" method="POST" class="d-flex">
                    <button class="btn btn-outline-danger" type="submit">Logout</button>
                </form>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="story-container">
            <div class="story-text">
                <p>какой-то текст.</p>
            </div>
            <img src="hack1.jpg" alt="фото_хакера" class="hacker-img">
        </div>

        <div class="text-center my-4">
            <button id="toggleButton" class="btn btn-primary">Open</button>
        </div>

        <div class="text-center">
            <img id="extraImage" src="hack1.jpg" alt="скрытое фото" class="hacker-img" style="display: none;">
        </div>
    </div>

    <div class="container mt-5 mb-5" style="max-width: 600px;">
        <form action="profile.php" id="postForm" class="d-flex flex-column gap-3" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label" for="postTitle">Post Title</label>
                <input type="text" name="postTitle" class="form-control hacker-input" id="postTitle" placeholder="Enter post Title" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="postContent">Post Content</label>
                <textarea name="postContent" class="form-control hacker-input" id="postContent" placeholder="Enter post Content" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="file">Upload file</label>
                <input type="file" name="file" class="form-control hacker-input" id="file">
            </div>

            <button class="btn btn-primary" type="submit" name="submit">Save Post</button>
        </form>
    </div>

    <script src="js/script.js"></script>
</body>
</html>

<?php
require_once('db.php');

if (!isset($_COOKIE['User'])) {
    header("Location: /login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $title = $_POST['postTitle'];
    $main_text = $_POST['postContent'];
    $imagePath = "";

    if (!$title || !$main_text) {
        die("no data post");
    }

    if (!empty($_FILES["file"]["name"])) {
        if (((@$_FILES["file"]["type"] == "image/gif") || (@$_FILES["file"]["type"] == "image/jpeg")
        || (@$_FILES["file"]["type"] == "image/jpg") || (@$_FILES["file"]["type"] == "image/pjpeg")
        || (@$_FILES["file"]["type"] == "image/x-png") || (@$_FILES["file"]["type"] == "image/png"))
        && (@$_FILES["file"]["size"] < 102400)) {
            
            if (!is_dir('upload')) {
                mkdir('upload', 0777, true);
            }

            $fileName = basename($_FILES["file"]["name"]);
            $uploadFile = "upload/" . $fileName;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFile)) {
                $imagePath = $uploadFile;
            }
        }
    }

    $sql = "INSERT INTO posts (title, main_text, image) VALUES ('$title', '$main_text', '$imagePath')";
    
    $result = mysqli_query($link, $sql);
    
    if (!$result) {
        echo "<div class='text-center text-danger mt-3'>Ошибка MySQL: " . mysqli_error($link) . "</div>";
    } else {
        echo "<h2 class='text-center text-success mt-3'>Пост успешно добавлен в базу!</h2>";
        exit();
    }
}
?>