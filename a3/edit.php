<?php
$title = "Edit Pet";
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php?access+denied");
    exit; 
}
include('includes/header.inc');
include('includes/nav.inc');
include('includes/db_connect.inc');
function validateInput($str) {
    return trim(htmlspecialchars($str));
}

// Get the pet ID from the URL
$petId = isset($_GET['petid']) ? (int)$_GET['petid'] : 0;

if ($petId > 0) {
    // Fetch the existing pet data
    $sql = "SELECT * FROM pets WHERE petid = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $petId, $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $pet = $result->fetch_assoc();
    } else {
        echo "Pet not found or you don't have permission to edit this pet.";
        exit;
    }
} else {
    echo "Invalid Pet ID.";
    exit;
}

$stmt->close();
?>

<div id="box2backgroundframe">
    <div class="SUBHeadingAddPetDiv">
        <h2 class="subheadingaddpet">Edit Pet</h2>
        <p class="addDescriptionheading">Edit the details of your pet here</p>
    </div>

    <div id="petadd">
        <form action="petprocessedit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="petId" value="<?php echo $pet['petid']; ?>">
            <label for="petName" class="required">Pet Name:</label>
            <input type="text" id="petName" name="petName" value="<?php echo htmlspecialchars($pet['petname']); ?>" placeholder="Provide a name for the pet" class="PetNameInput" required><br>

            <label for="petType" class="required">Type:</label>
            <select id="petType" name="petType" class="add-pet" required>
                <option value="" disabled>Select an option</option>
                <option value="Cat" <?php echo ($pet['type'] == 'Cat') ? 'selected' : ''; ?>>Cat</option>
                <option value="Dog" <?php echo ($pet['type'] == 'Dog') ? 'selected' : ''; ?>>Dog</option>
            </select><br>

            <label for="petDescription" class="required">Description:</label>
            <textarea id="petDescription" name="petDescription" class="description-box" placeholder="Describe the pet briefly" required oninput="autoResize(this)"><?php echo htmlspecialchars($pet['description']); ?></textarea><br>

            <div class="file-upload-container">
                <label for="imageUpload">Upload New Image (optional):</label>
                <input type="file" id="imageUpload" name="imageUpload" accept="image/*">
                <small id="imageError" style="color: red; display: none;">MAX IMAGE SIZE: 500PX</small>
            </div><br>

            <label for="imageCaption" class="required">Image Caption:</label>
            <input type="text" id="imageCaption" name="imageCaption" value="<?php echo htmlspecialchars($pet['caption']); ?>" placeholder="Describe the image in one word" class="ImageCaption" required><br>

            <label for="petAge" class="required">Age (months):</label>
            <input type="text" id="petAge" name="petAge" value="<?php echo htmlspecialchars($pet['age']); ?>" placeholder="Age of a pet in months" class="PetAge" required><br>
           
            <label for="petLocation" class="required">Location:</label>
            <input type="text" id="petLocation" name="petLocation" value="<?php echo htmlspecialchars($pet['location']); ?>" placeholder="Location of the pet" class="PetLocation" required><br>

            <div class="AddButtonsDiv">
                <button type="submit" class="submit">
                    <span class="material-symbols-outlined">Add_task</span>Submit
                </button>
                <button type="reset" class="clear">
                    <span class="material-symbols-outlined">clear</span>Clear
                </button>
            </div>
        </form>
    </div>
</div>

<?php include('includes/footer.inc'); ?>
