<?php
session_start();
include("includes/db_connect.inc");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare and bind
    $sql = "SELECT * FROM users WHERE username = ? AND password = SHA(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;  
        $_SESSION['loggedin'] = true;
        header("Location: index.php"); 
        exit();
    } else {
        $_SESSION['err'] = "Login failed";
        header("Location: login.php"); 
        exit();
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Please submit the login form.";
}
?>
