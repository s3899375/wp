<?php
$title = "Pet gallery";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('includes/header.inc'); 
include('includes/nav.inc'); 
include('includes/db_connect.inc');  // Include the database connection

// Fetch data from the database, including the pet ID and type
$sql = "SELECT petid, petname, image, description, type FROM pets";  // Adjust column names based on your DB structure
$result = $conn->query($sql);

// Initialize an array to hold the pets for filtering
$pets = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pets[] = $row;  // Store each pet in an array
    }
}
$conn->close();  // Close the database connection
?>

<div id="box2backgroundframe">
    <div class="Gallery-Container">
        <h2>Pets Victoria has a lot to offer!</h2>
        <p>For almost two decades, Pets Victoria has helped in creating true social change by bringing pet adoption into the mainstream. Our work has helped make a difference to the Victorian rescue community and thousands of pets in need of rescue and rehabilitation. But, until every pet is safe, respected, and loved, we all still have big, hairy work to do.</p>

        <!-- Dropdown for filtering pets -->
        <div class="filter-container">
            <!-- <label for="petFilter" class="sr-only">Filter by Pet Type</label> -->
            <select id="petFilter" onchange="filterPets()" aria-label="Filter by Pet Type">
                <option value="all" disabled selected>Select type</option> <!-- Default disabled option -->
                <option value="all">All</option>
                <option value="Cat">Cat</option>
                <option value="Dog">Dog</option>
            </select>


            <span class="material-symbols-outlined filter-icon">filter_list</span>
        </div>


        <div class="petcontainer" id="petContainer">
        <?php
        // Display pets
        foreach ($pets as $row) {
            $petId = $row['petid'];           
            $petName = $row['petname'];    
            $petImage = $row['image'];
            $petDescription = $row['description']; 
            $petType = $row['type']; // Get the pet type
            
            echo "<div class='pet-card' data-type='$petType'>
                <a href='details.php?id=$petId' class='pet-card-link'>
                    <div class='image-container'>
                        <img src='images/$petImage' alt='$petName'>
                        <div class='name-box'>
                            <h3 class='normal-text' id='pet-name-$petId'>$petName</h3>            
                        </div>
                        <div class='overlay'>
                            <span class='material-symbols-outlined'>search</span>
                            <span class='overlay-text'>Discover More!</span>
                        </div>
                    </div>
                </a>
              </div>";
        }
        ?>
        </div>            
    </div>
</div>

<!-- Include the external JavaScript file -->
<script src="js_folder/main.js"></script>

<?php
include('includes/footer.inc'); 
?>
