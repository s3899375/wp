<?php
include('includes/db_connect.inc');

$images = [];
$sql = "SELECT image FROM pets ORDER BY petid DESC LIMIT 4"; 

$result = $conn->query($sql); 

if ($result) {

    while ($row = $result->fetch_assoc()) {
        $images[] = $row['image']; 
    }
} else {

    echo "Error fetching images: " . $conn->error;
}


$conn->close();
?>