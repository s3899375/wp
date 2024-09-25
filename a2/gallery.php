<?php
$title = "Pet gallery";
include('includes/header.inc'); 
include('includes/nav.inc'); 
include('includes/db_connect.inc');  


$sql = "SELECT petid, petname, image, description FROM pets";  
$result = $conn->query($sql);
?>

<main>
    <body class="gallery-page">
    <div id="box2backgroundframe">
        <div class="Gallery-Container">
            <h2>Pets Victoria has a lot to offer!</h2>
            <p>For almost two decades, Pets Victoria has helped in creating true social change by bringing pet adoption into the mainstream. Our work has helped make a difference to the Victorian rescue community and thousands of pets in need of rescue and rehabilitation. But, until every pet is safe, respected, and loved, we all still have big, hairy work to do.</p>

            <div class="petcontainer">

            <?php

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $petId = $row['petid'];           
                    $petName = $row['petname'];    
                    $petImage = $row['image'];
                    $petDescription = $row['description']; 
                    
                    
                    echo "<a href='details.php?id=$petId'>
                    <div class='image-container'>
                        <img src='images/$petImage' alt='$petName'>
                        <div class='name-box'><h2>$petName</h2></div>
                        <div class='overlay'>
                            <span class='material-symbols-outlined'>search</span>
                            <span class='overlay-text'>Discover More!</span>
                        </div>
                    </div>
                </a>";
                    
                }
            } else {
                echo "No pets found!";
            }
            
            $conn->close();  
            ?>

            </div>            
        </div>
    </div>
    </main>
<?php
include('includes/footer.inc'); 
?>

</body>
</html>
