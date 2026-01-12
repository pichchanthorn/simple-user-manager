<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Trim & validate input
    $name = trim($_POST['name']);

    if ($name !== "") {

        // Prepared statement (security)
        $stmt = $conn->prepare("INSERT INTO users (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->close();
    }
}

header("Location: index.php");
exit;
