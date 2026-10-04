<?php
$servername = "127.0.0.1";
$username = "root";
$password = "password";
$dbName = "first";

$link = mysqli_connect($servername, $username, $password);
if (!$link) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS `first`";
if (!mysqli_query($link, $sql)) {
    echo "Не удалось создать БД: " . mysqli_error($link);
}
mysqli_close($link);

$link = mysqli_connect($servername, $username, $password, $dbName);
if (!$link) {
    die("Ошибка подключения к БД first: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS users (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(15) NOT NULL,
  email VARCHAR(50) NOT NULL,
  pass VARCHAR(20) NOT NULL
)";
if (!mysqli_query($link, $sql)) {
    echo "Не удалось создать таблицу users: " . mysqli_error($link);
}

$sql = "CREATE TABLE IF NOT EXISTS posts (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  main_text TEXT NOT NULL,
  image VARCHAR(255) DEFAULT NULL
)";
if (!mysqli_query($link, $sql)) {
    echo "Не удалось создать таблицу posts: " . mysqli_error($link);
}
?>