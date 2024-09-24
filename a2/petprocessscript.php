<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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
    if (move_uploaded_file($tmp, $dest)) {
        echo "File uploaded successfully.";
    } else {
        echo "File upload failed.";
    }
}

include('includes/db_connect.inc');

$sql = "INSERT INTO pets (petname, type, description, age, location, caption, image) VALUES (?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdsss", $petName, $petType, $petDescription, $petAge, $petLocation, $imageCaption, $image); // Changed here

if ($stmt->execute()) {
    header("Location: add.php?success=true");
    exit(0);
} else {
    echo "An error has occurred: " . $stmt->error;
}

$conn->close();
?>
