<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include("includes/db_connect.inc");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the username
    $hashedUsername = password_hash($username, PASSWORD_DEFAULT);

    // Prepare a statement to check for duplicate usernames
    $checkSql = "SELECT COUNT(*) FROM users WHERE username = ?";
    $stmtCheck = $conn->prepare($checkSql);
    if (!$stmtCheck) {
        die("Database query failed: " . $conn->error);
    }

    $stmtCheck->bind_param("s", $hashedUsername);
    $stmtCheck->execute();
    $stmtCheck->bind_result($userCount);
    $stmtCheck->fetch();
    $stmtCheck->close();

    if ($userCount > 0) {
        $_SESSION['err'] = "Username already taken. Please choose another.";
        header("Location: register.php?error=" . urlencode($_SESSION['err']));
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, reg_date) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Database query failed: " . $conn->error);
        }

        $stmt->bind_param("ss", $hashedUsername, $hashedPassword);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['usrmsg'] = "You have successfully registered";
            header("Location: register.php?success=" . urlencode($_SESSION['usrmsg']));
        } else {
            $_SESSION['err'] = "An error has occurred!";
            header("Location: register.php?error=" . urlencode($_SESSION['err']));
        }

        $stmt->close();
    }

    $conn->close();
    exit(0);
}
?>
