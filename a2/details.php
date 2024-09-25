<?php
$title = "Pet Details";
include('includes/header.inc');
include('includes/nav.inc');
?>
<main>
    <div id="box2backgroundframe">
        <?php
        if (!empty($_GET['id'])) {
            include('includes/db_connect.inc');

            $petid = $_GET['id'];

            $sql = "SELECT * FROM pets WHERE petid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $petid);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div id='box3backgroundframe'>";

                    echo "<div class='DetailsImageDiv'>";
                    if (!empty($row['image'])) {
                        echo "<img src='images/{$row['image']}' alt='{$row['petname']}'>";
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

                    echo "<div class='pet-name'>";
                    echo "<h2>{$row['petname']}</h2>";
                    echo "</div>";

                    echo "<div class='pet-description'>";
                    echo "<p>{$row['description']}</p>";
                    echo "</div>";

                    echo "</div>";

                    $stmt->close();
                    $conn->close();
                }
            } else {
                echo "<div id='box3backgroundframe'>";
                echo "<h2>No details found for this pet.</h2>";
                echo "</div>";
            }
        } else {
            echo "<div id='box3backgroundframe'>";
            echo "<p>No pet ID provided.</p>";
            echo "</div>";
        }
        ?>
    </div>
    </main>
<?php
include('includes/footer.inc');
?>

</body>
</html>
