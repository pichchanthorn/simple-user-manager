<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "user_manager";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed");
}

$conn->set_charset("utf8mb4");
