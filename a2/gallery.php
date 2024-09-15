<?php
include('includes/header.inc'); 
include('includes/nav.inc'); 
include('includes/db_connect.inc');  // Include the database connection

// Fetch data from the database, including the pet ID
$sql = "SELECT id, petname, image, description FROM pets";  // Adjust column names based on your DB structure
$result = $conn->query($sql);

?>

<body class="gallery-page">
<div id="box2backgroundframe">
    <div class="Gallery-Container">
        <h2>Pets Victoria has a lot to offer!</h2>
        <p>For almost two decades, Pets Victoria has helped in creating true social change by bringing pet adoption into the mainstream. Our work has helped make a difference to the Victorian rescue community and thousands of pets in need of rescue and rehabilitation. But, until every pet is safe, respected, and loved, we all still have big, hairy work to do.</p>

        <div class="petcontainer">

        <?php
        // Check if there are results
        if ($result->num_rows > 0) {
            // Loop through each row in the result set
            while($row = $result->fetch_assoc()) {
                $petId = $row['id'];           // Pet ID from DB
                $petName = $row['petname'];    // Pet name from DB
                $petImage = $row['image'];     // Image filename from DB
                $petDescription = $row['description']; // Description from DB
                
                // Output the pet info as HTML with a link to details.php passing the pet ID
                echo "<a href='details.php?id=$petId'>
                        <div class='image-container'>
                            <img src='images/$petImage' alt='$petName'>
                            <div class='name-box'>$petName</div>
                            <div class='overlay'>
                                <img src='images/search-icon.png' alt='Icon' class='overlay-icon'>
                                <span class='overlay-text'>Discover More!</span>
                            </div>
                        </div>
                      </a>";
            }
        } else {
            echo "No pets found!";
        }
        
        $conn->close();  // Close the database connection
        ?>

        </div>            
    </div>
</div>

<?php
include('includes/footer.inc'); 
?>

</body>
</html>
