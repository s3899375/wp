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
$petAge = validateInput($_POST['petAge']);
$petLocation = validateInput($_POST['petLocation']);


$imagePath = null;
if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] === UPLOAD_ERR_OK) {
    
    $uploadDir = 'uploads/'; 
    $imagePath = $uploadDir . basename($_FILES['imageUpload']['name']);
    move_uploaded_file($_FILES['imageUpload']['tmp_name'], $imagePath);
}

// Prepare SQL query
if ($imagePath) {
    // Update SQL query with image
    $sql = "UPDATE pets SET petname = ?, type = ?, description = ?, caption = ?, age = ?, location = ?, image = ? WHERE petid = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssisisi", $petName, $petType, $petDescription, $imageCaption, $petAge, $petLocation, $imagePath, $petId, $_SESSION['username']);
    header("Location: index.php");
} else {
    // Update SQL query without image
    $sql = "UPDATE pets SET petname = ?, type = ?, description = ?, caption = ?, age = ?, location = ? WHERE petid = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssisis", $petName, $petType, $petDescription, $imageCaption, $petAge, $petLocation, $petId, $_SESSION['username']);
    header("Location: index.php");
}


if ($stmt->execute()) {
    echo "Pet details updated successfully!";
} else {
    echo "Error updating pet details: " . $conn->error;
}

$stmt->close();
$conn->close();

function validateInput($str) {
    return trim(htmlspecialchars($str));
}
?>
