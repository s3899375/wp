<?php
session_start();
include("includes/db_connect.inc");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ? AND password = SHA(?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Database query failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        $_SESSION['usrmsg'] = "Welcome back, $username!";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['errorMessage'] = "Invalid username or password";
        header("Location: login.php");
    }

    $stmt->close();
    $conn->close();
}
?>
