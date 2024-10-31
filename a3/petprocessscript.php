<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

include('includes/db_connect.inc');

function validateInput($str)
{
    return trim(htmlspecialchars($str)); 
}

$petName = validateInput($_POST['petName']);
$petType = validateInput($_POST['petType']);
$petDescription = validateInput($_POST['petDescription']);
$petAge = (float) validateInput($_POST['petAge']); 
$petLocation = validateInput($_POST['petLocation']);
$imageCaption = validateInput($_POST['imageCaption']);


$image = '';
if (!empty($_FILES['imageUpload']['name'])) {
    $tmp = $_FILES['imageUpload']['tmp_name'];
    $image = $_FILES['imageUpload']['name'];
    $dest = "images/{$image}"; 
    if (!move_uploaded_file($tmp, $dest)) {
        echo "File upload failed.";
        exit; 
    }
}

$sql = "INSERT INTO pets (petname, type, description, age, location, caption, image, username) VALUES (?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdssss", $petName, $petType, $petDescription, $petAge, $petLocation, $imageCaption, $image, $_SESSION['username']); 
if ($stmt->execute()) {
    header("Location: gallery.php?success=true");
    exit(0);
} else {
    echo "An error has occurred: " . $stmt->error;
}
$conn->close();
?>
