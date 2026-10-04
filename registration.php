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
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mb-4">Registration</h1>
                <form action="registration.php" method="POST" class="d-flex flex-column gap-3">
                    <input type="text" name="login" class="form-control hacker-input" placeholder="login" required>
                    <input type="email" name="email" class="form-control hacker-input" placeholder="email" required>
                    <input type="password" name="password" class="form-control hacker-input" placeholder="password" required>
                    
                    <button type="submit" name="submit" class="btn btn-primary text-center">Register</button>
                    
                    <p class="mt-3">Already have an account? <a href="login.php">Login</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
require_once('db.php');

if (isset($_COOKIE['User'])) {
    header("Location: /profile.php");
    exit();
}

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if (!$login || !$email || !$pass) {
        die("input all parameters");
    }

    $sql = "INSERT INTO users (username, email, pass) VALUES ('$login', '$email', '$pass')";
    
    if (!mysqli_query($link, $sql)) {
        echo "Не удалось добавить пользователя";
    } else {
        header("Location: /login.php");
        exit();
    }
}
?>