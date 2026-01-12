<?php
session_start();
require "db.php";

/* ==================================================
   CSRF TOKEN GENERATION
================================================== */
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* ==================================================
   FETCH USERS
================================================== */
$stmt = $conn->prepare("SELECT id, name FROM users ORDER BY id DESC");
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Manager</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Main CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>

<!-- ==================================================
     THEME TOGGLE BUTTON
================================================== -->
<button class="theme-toggle" onclick="toggleTheme()" title="Toggle theme">
    <i data-feather="moon"></i>
</button>

<main class="container">

    <!-- ==================================================
         TITLE
    ================================================== -->
    <h2>
        <i data-feather="users"></i>
        Simple User Manager
    </h2>

    <!-- ==================================================
         ADD USER FORM
    ================================================== -->
    <form action="add.php" method="POST" class="add-form" autocomplete="off">
        <input
            type="text"
            name="name"
            placeholder="Enter name"
            required
        >
        <button type="submit" title="Add user">
            <i data-feather="plus"></i>
        </button>
    </form>

    <!-- ==================================================
         USER LIST
    ================================================== -->
    <div class="user-list">

        <?php if ($result->num_rows === 0): ?>
            <p style="text-align:center;color:var(--muted);margin-top:20px;">
                No users yet.
            </p>
        <?php endif; ?>

        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="user-item">

                <div class="username">
                    <?= htmlspecialchars($row['name']); ?>
                </div>

                <div class="actions">

                    <!-- EDIT BUTTON -->
                    <a class="edit"
                       href="edit.php?id=<?= $row['id']; ?>"
                       title="Edit user">
                        <i data-feather="edit"></i>
                    </a>

                    <!-- DELETE FORM -->
                    <form action="delete.php" method="POST" class="delete-form">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

                        <button type="submit"
                                class="delete-icon"
                                title="Delete user"
                                onclick="return confirm('Delete this user?')">
                            <i data-feather="trash-2"></i>
                        </button>
                    </form>

                </div>
            </div>
        <?php endwhile; ?>

    </div>

</main>

<!-- ==================================================
     FOOTER
================================================== -->
<footer class="footer">
    © <span id="year"></span> Developed by Pich Chanthorn – BBU IT Student
</footer>

<!-- ==================================================
     JAVASCRIPT
================================================== -->
<script src="script.js"></script>

<script>
/* =========================
   INITIALIZE ICONS
========================= */
feather.replace();

/* =========================
   THEME TOGGLE
========================= */
function toggleTheme(){
    document.body.classList.toggle("light");

    const icon = document.querySelector(".theme-toggle i");

    if(document.body.classList.contains("light")){
        icon.setAttribute("data-feather","sun");
    } else {
        icon.setAttribute("data-feather","moon");
    }

    feather.replace();
}
</script>

</body>
</html>
