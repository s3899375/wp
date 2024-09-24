<?php
//Check what server you are accessing
if (strstr($_SERVER['SERVER_NAME'], 'localhost')) {
    $servername = "talsprddb02.int.its.rmit.edu.au";
    $username = "s3899375";
    $password = "Rmit1234!";
    $dbname = "s3899375";
} else {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "library";
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
