<?php
session_start();
include "db.php";

/*
|--------------------------------------------------------------------------
| 1. Only allow POST request
|--------------------------------------------------------------------------
*/
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| 2. CSRF Protection
|--------------------------------------------------------------------------
*/
if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) ||
    $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Invalid CSRF token");
}

/*
|--------------------------------------------------------------------------
| 3. Validate ID
|--------------------------------------------------------------------------
*/
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_POST['id'];

/*
|--------------------------------------------------------------------------
| 4. Secure delete with prepared statement
|--------------------------------------------------------------------------
*/
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    die("Delete failed. Please try again.");
}

$stmt->close();

/*
|--------------------------------------------------------------------------
| 5. (Optional) Regenerate CSRF token after delete
|--------------------------------------------------------------------------
*/
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

/*
|--------------------------------------------------------------------------
| 6. Redirect
|--------------------------------------------------------------------------
*/
header("Location: index.php?deleted=1");
exit;
