<?php
$title = "Search Results";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('includes/header.inc'); 
include('includes/nav.inc'); 
include('includes/db_connect.inc'); // Connect to the database

// Retrieve search parameters from the form submission
$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$pet_type = isset($_GET['pet_type']) ? trim($_GET['pet_type']) : '';

// Prepare the SQL query based on the input parameters
$sql = "SELECT * FROM pets WHERE 1";
$params = [];

if (!empty($query)) {
    $sql .= " AND (petname LIKE ? OR description LIKE ?)";
    $params[] = '%' . $query . '%';
    $params[] = '%' . $query . '%';
}

if (!empty($pet_type)) {
    $sql .= " AND type = ?";
    $params[] = $pet_type;
}

// Use the correct connection variable
$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $types = str_repeat('s', count($params)); // Assuming all parameters are strings
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

echo "<div id='box2backgroundframe'>";
echo "<h2>Search Results</h2>";

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
        echo "</div>"; // End pet-info

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

        echo "</div>"; // End box3backgroundframe
    }
} else {
    echo "<p>No pets found matching your criteria.</p>";
}

echo "</div>"; // End box2backgroundframe

$stmt->close();
$conn->close();
?>

<?php
include('includes/footer.inc'); 
?>
