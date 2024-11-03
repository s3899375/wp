<?php
session_start();
include('includes/db_connect.inc');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$petId = isset($_POST['petId']) ? (int)$_POST['petId'] : 0;
$petName = validateInput($_POST['petName']);
$petType = validateInput($_POST['petType']);
$petDescription = validateInput($_POST['petDescription']);
$imageCaption = validateInput($_POST['imageCaption']);
$petAge = (float)validateInput($_POST['petAge']);
$petLocation = validateInput($_POST['petLocation']);

$imagePath = null;

if (isset($_FILES['imageUpload'])) {
    // Check for upload errors
    if ($_FILES['imageUpload']['error'] !== UPLOAD_ERR_OK) {
        echo "File upload error: " . $_FILES['imageUpload']['error'];
        exit; // Stop execution if there's an error
    }

    // Prepare the upload directory
    $uploadDir = 'images/';
    $imageFileName = basename($_FILES['imageUpload']['name']); // Get just the file name
    $imagePath = $uploadDir . $imageFileName; // Full path for upload

    // Attempt to move the uploaded file
    if (move_uploaded_file($_FILES['imageUpload']['tmp_name'], $imagePath)) {
        echo "File uploaded successfully to: {$imagePath}";
    } else {
        echo "Failed to move the uploaded file.";
        exit; // Stop execution if the file could not be moved
    }
}

// Prepare SQL query
if ($imagePath) {
    // Use only the file name for database storage
    $sql = "UPDATE pets SET petname = ?, type = ?, description = ?, caption = ?, age = ?, location = ?, image = ? WHERE petid = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssissis", $petName, $petType, $petDescription, $imageCaption, $petAge, $petLocation, $imageFileName, $petId, $_SESSION['username']); // Use $imageFileName here
} else {
    // Update SQL query without image
    $sql = "UPDATE pets SET petname = ?, type = ?, description = ?, caption = ?, age = ?, location = ? WHERE petid = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssisis", $petName, $petType, $petDescription, $imageCaption, $petAge, $petLocation, $petId, $_SESSION['username']);
}

// Execute the statement and handle the result
if ($stmt->execute()) {
    header("Location: index.php?update=success");
    exit;
} else {
    echo "Error updating pet details: " . $stmt->error;
}

$stmt->close();
$conn->close();

function validateInput($str) {
    return trim(htmlspecialchars($str));
}
?>
