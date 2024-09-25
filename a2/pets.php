<?php
$title = "Pets";
include('includes/header.inc');
include('includes/nav.inc'); 
include('includes/db_connect.inc');

// Fetch pet data including the pet's unique ID
$sql = "SELECT petid, petname, type, age, location FROM pets";
$result = $conn->query($sql);
?>


<div id="box2backgroundframe">
    <h2 class="petssubhead">Discover Pets Victoria</h2>
    <p class="centered-text">
        PETS VICTORIA is a dedicated pet adoption organization based in Victoria, Australia, focused on providing a safe and loving environment for pets in need. With a compassionate approach, Pets Victoria works tirelessly to rescue, rehabilitate, and rehome dogs, cats, and other animals. Their mission is to connect these deserving pets with caring individuals and families, creating lifelong bonds. The organization offers a range of services, including adoption counseling, pet education, and community support programs, all aimed at promoting responsible pet ownership and reducing the number of homeless animals.
    </p>

    <div class="content-container">
        <img id="petsimage" src="images/pets.jpeg" alt="home">
        <table id="pet-table">
            <thead>
                <tr id="pettabletext">
                    <th>Pet</th>
                    <th>Type</th>
                    <th>Age</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Fetch pet information and create a hyperlink under the pet's name
                        $petId = $row['petid'];
                        $petName = htmlspecialchars($row['petname']);
                        $petType = htmlspecialchars($row['type']);
                        $petAge = htmlspecialchars($row['age']);
                        $petLocation = htmlspecialchars($row['location']);

                        echo "<tr>";
                        // Create a hyperlink to the details.php page for the pet
                        echo "<td><a href='details.php?id=$petId'>$petName</a></td>";
                        echo "<td>$petType</td>";
                        echo "<td>$petAge months</td>";
                        echo "<td>$petLocation</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No pets available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<?php
include('includes/footer.inc');
?>
</body>
</html>
