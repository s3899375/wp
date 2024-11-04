
<?php
$title = "Pet delete";
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit; 
}
include('includes/header.inc');
include('includes/nav.inc');

// Check if the petid is passed via GET request
$petid = isset($_GET['id']) ? intval($_GET['id']) : null;
?>
<div id="parentdeletebackgroundframe">
    <div id='deletebackgroundframe'>
        <h2>Bye! bye!</h2>
        <div class="deletebanner">
            <p>deleted</p>
        </div>
        <p>We have to see a pet record go, but we are sure you had a good reason for deleting it.</p>


        <p>Maybe you can fill the gap by adding a new and exciting animal?</p>    
        
        <div class='addmorediv'>
            <a href='add.php' class='addpet-card-link'>
                <div class='deleteaddmore-container'>
                    <img src='images/pets.jpg' alt="Add a new pet">
                    <div class='name-box'>
                        <h3 class='normal-text'>Add a new pet</h3>            
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<?php
include('includes/footer.inc');
?>
