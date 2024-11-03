<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

include('includes/db_connect.inc');

function validateInput($str) {
    return trim(htmlspecialchars($str));
}

$petName = validateInput($_POST['petName']);
$petType = validateInput($_POST['petType']);
$petDescription = validateInput($_POST['petDescription']);
$petAge = (float) validateInput($_POST['petAge']);
$petLocation = validateInput($_POST['petLocation']);
$imageCaption = validateInput($_POST['imageCaption']);

// Handle image upload if a new one is provided
$image = '';
if (!empty($_FILES['imageUpload']['name'])) {
    $tmp = $_FILES['imageUpload']['tmp_name'];
    $image = $_FILES['imageUpload']['name'];
    $dest = "images/{$image}";

    // Debugging output
    echo "Temporary file: {$tmp}<br>";
    echo "Destination: {$dest}<br>";
    if (!file_exists($tmp)) {
        echo "Temporary file does not exist.<br>";
    } else {
        echo "Temporary file exists.<br>";
    }

    // Attempt to move the uploaded file
    if (move_uploaded_file($tmp, $dest)) {
        echo "File uploaded successfully.";
    } else {
        echo "File upload failed.";
    }
}

// Insert the new pet into the database
$sql = "INSERT INTO pets (petname, type, description, age, location, caption, image, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $conn->prepare($sql)) {
    // Bind parameters
    $stmt->bind_param("sssdssss", $petName, $petType, $petDescription, $petAge, $petLocation, $imageCaption, $image, $_SESSION['username']);
    
    // Execute the statement
    if ($stmt->execute()) {
        header("Location: gallery.php?add=success");
        exit;
    } else {
        echo "An error has occurred: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "SQL Error: " . $conn->error;
}

$conn->close();
?>
