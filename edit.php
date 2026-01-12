<?php
session_start();
require "db.php";

/*
|--------------------------------------------------------------------------
| 1. Validate request
|--------------------------------------------------------------------------
*/
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

/*
|--------------------------------------------------------------------------
| 2. Fetch user securely
|--------------------------------------------------------------------------
*/
$stmt = $conn->prepare("SELECT id, name FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$user   = $result->fetch_assoc();

$stmt->close();

if (!$user) {
    header("Location: index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| 3. Generate CSRF token (optional but recommended)
|--------------------------------------------------------------------------
*/
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>

    <link rel="stylesheet" href="style.css">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>

<!-- Theme Toggle -->
<button class="theme-toggle" onclick="toggleTheme()" title="Toggle theme">
    <i data-feather="moon"></i>
</button>

<main class="container">

    <h2>
        <i data-feather="edit-3"></i>
        Edit User
    </h2>

    <!-- Edit Form -->
    <form action="update.php" method="POST">

        <input type="hidden" name="id" value="<?= $user['id']; ?>">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

        <input
            type="text"
            name="name"
            value="<?= htmlspecialchars($user['name']); ?>"
            placeholder="Enter name"
            required
            autocomplete="off"
        >

        <button type="submit" title="Save">
            <i data-feather="save"></i>
        </button>

    </form>

    <!-- Back link -->
    <div class="back-wrapper">
        <a href="index.php" class="back-btn">
            <i data-feather="arrow-left"></i>
            Back to User Manager
        </a>
    </div>


</main>

<!-- JS -->
<script src="script.js"></script>

<script>
  feather.replace();
</script>

</body>
</html>
