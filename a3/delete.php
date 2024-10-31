<?php
session_start();
include('includes/db_connect.inc');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}


$petId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($petId > 0) {
    // Prepare the SQL delete statement
    $sql = "DELETE FROM pets WHERE petid = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $petId, $_SESSION['username']);

    // Execute the delete statement
    if ($stmt->execute()) {
        echo "Pet deleted successfully!";
        header("Location: index.php"); // Redirect to homepage or pet listing after deletion
        exit;
    } else {
        echo "Error deleting pet: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid pet ID.";
}

$conn->close();
?>
