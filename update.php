<?php
session_start();
require "db.php";

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
| 2. Validate CSRF token (optional but recommended)
|--------------------------------------------------------------------------
*/
if (isset($_SESSION['csrf_token'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token");
    }
}

/*
|--------------------------------------------------------------------------
| 3. Validate input
|--------------------------------------------------------------------------
*/
if (
    !isset($_POST['id'], $_POST['name']) ||
    !is_numeric($_POST['id']) ||
    trim($_POST['name']) === ""
) {
    header("Location: index.php?error=invalid_input");
    exit;
}

$id   = (int) $_POST['id'];
$name = trim($_POST['name']);

/*
|--------------------------------------------------------------------------
| 4. Update user (Prepared Statement)
|--------------------------------------------------------------------------
*/
$stmt = $conn->prepare("UPDATE users SET name = ? WHERE id = ?");
$stmt->bind_param("si", $name, $id);

if (!$stmt->execute()) {
    // In real projects, log this instead of showing
    die("Update failed. Please try again.");
}

$stmt->close();

/*
|--------------------------------------------------------------------------
| 5. Redirect back
|--------------------------------------------------------------------------
*/
header("Location: index.php?updated=1");
exit;
