<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$title = "Add Pet"; // Set the title for the page
include('includes/header.inc');
include('includes/nav.inc');
?>

<div id="box2backgroundframe">
    <div class="SUBHeadingAddPetDiv">
        <h2 class="subheadingaddpet">Add a Pet</h2>
        <p class="addDescriptionheading">You can add a new pet here</p>
    </div>

    <div id="petadd">
        <form action="petprocessscript.php" method="post" enctype="multipart/form-data">
            <label for="petName" class="required">Pet Name:</label>
            <input type="text" id="petName" name="petName" placeholder="Provide a name for the pet" class="PetNameInput" required><br>

            <label for="petType" class="required">Type:</label>
            <select id="petType" name="petType" class="add-pet" required>
                <option value="" disabled selected>Select an option</option>
                <option value="Cat">Cat</option>
                <option value="Dog">Dog</option>
            </select><br>

            <label for="petDescription" class="required">Description:</label>
            <textarea id="petDescription" name="petDescription" class="description-box" placeholder="Describe the pet briefly" required oninput="autoResize(this)"></textarea><br>
            <div id="descriptionError" style="display:none; color:red;">Description exceeds the maximum word limit of 300 words.</div>
            <div class="file-upload-container">
                <input type="file" id="imageUpload" name="imageUpload" accept="image/*" required>
                <small id="imageError" style="color: red; display: none;">MAX IMAGE SIZE: 500PX</small>
            </div><br>

            <label for="imageCaption" class="required">Image Caption:</label>
            <input type="text" id="imageCaption" name="imageCaption" placeholder="Describe the image in one word" class="ImageCaption" required><br>

            <label for="petAge" class="required">Age (months):</label>
            <input type="text" id="petAge" name="petAge" placeholder="Age of a pet in months" class="PetAge" required><br>
           
            <label for="petLocation" class="required">Location:</label>
            <input type="text" id="petLocation" name="petLocation" placeholder="Location of the pet" class="PetLocation" required><br>

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

<?php
include('includes/footer.inc');
?>

</body>
</html>
