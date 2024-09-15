<?php

include('includes/header.inc');
?>
<h1>Pet Details</h1>
<?php
include('includes/nav.inc');
?>

<?php
if (!empty($_GET['petid'])) {
    include('includes/db_connect.inc');

    $petid = $_GET['petid'];

    $sql = "SELECT * FROM pets WHERE petid = ?";  

    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("i", $id);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            print "<h2>{$row['petname']}</h2>";
            print "<h3>Type: {$row['type']}</h3>";
            print "<h4>Age: {$row['age']} months | Location: {$row['location']}</h4>";
            print "<p>Description: {$row['description']}</p>";
            if (!empty($row['image'])) {
                echo "<div class='DetailsImageDiv'>";
                echo "<img src='images/{$row['image']}' alt='{$row['petname']}'>";
                echo "</div>";
            } else {
                echo "<p>No image available for this pet.</p>";
            }
        }
    } else {
        echo "<p>No details found for this pet.</p>";
    }


    $stmt->close();
    $conn->close();
}
?>

<?php
include('includes/footer.inc');
?>
