<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$title = "User Pets Collection";
include('includes/header.inc');
include('includes/nav.inc');

if (!isset($_SESSION['username'])) {
    header("Location: login.php?access+denied");
    exit;
}

include('includes/db_connect.inc');

$username = $_SESSION['username'];
$sql = "SELECT * FROM pets WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

echo "<div id='box2backgroundframe'>";
echo "<h2>" . htmlspecialchars($username) . "'s Collection</h2>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div id='box3backgroundframe'>";

        // Left Side (Image and Info)
        echo "<div class='left-side'>";
        echo "<div class='DetailsImageDiv'>";
        if (!empty($row['image'])) {
            echo "<img src='images/{$row['image']}' alt='" . htmlspecialchars($row['petname']) . "'>";
        } else {
            echo "<p>No image available for this pet.</p>";
        }
        echo "</div>";

        echo "<div class='pet-info'>";
        echo "<div class='agediv'>";
        echo "<span class='material-symbols-outlined'>alarm</span>";
        echo "<p>{$row['age']} months</p>";
        echo "</div>";

        echo "<div class='petsdiv'>";
        echo "<span class='material-symbols-outlined'>pets</span>";
        echo "<p>{$row['type']}</p>";
        echo "</div>";

        echo "<div class='location'>";
        echo "<span class='material-symbols-outlined'>location_on</span>";
        echo "<p>{$row['location']}</p>";
        echo "</div>";
        echo "</div>"; 

        // Edit and Delete Actions
        echo "<div class='pet-actions'>";
        echo "<a href='edit.php?petid={$row['petid']}' class='edit-button'>Edit</a>";
        echo "<button class='delete-button' onclick='confirmDelete({$row['petid']})'>Delete</button>";
        echo "</div>";
        
        echo "</div>"; // End Left Side

        // Right Side (Name and Description)
        echo "<div class='right-side'>";
        echo "<div class='pet-name'>";
        echo "<h2>" . htmlspecialchars($row['petname']) . "</h2>";
        echo "</div>";
        
        echo "<div class='pet-description'>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        echo "</div>";
        echo "</div>"; // End Right Side

        echo "</div>";
    }
} else {
    echo "<p>No pets found in your collection.</p>";
}

echo "</div>"; // End box2backgroundframe

$stmt->close();
$conn->close();
?>

<!-- Link to external JavaScript file -->
<script src="js/scripts.js"></script>

<?php
include('includes/footer.inc');
?>
