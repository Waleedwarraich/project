<?php include "includes/header.inc" ?>
<main>
    <h1 id="petsHeading">Add a pet</h1>
    <p id="petsPara">You can add a new pet here</p>
    <?php
    session_start();

    // Check if there is a message set
    if (isset($_SESSION['message'])) {
        // Display the message
        echo '<div class="alert alert-' . $_SESSION['message']['type'] . '">' . $_SESSION['message']['text'] . '</div>';
        // Unset the session message
        unset($_SESSION['message']);
    }
    ?>
    <form id="pet-form" action="form-submit.php" method="post" enctype="multipart/form-data">
        <label for="pets-name">Pet Name:<i class="required">*</i></label>
        <input type="text" id="pets-name" name="petname" placeholder="Provide a name for the pet" required>
        
        <label for="type">Type:<i class="required">*</i></label>
        <select id="type" name="type" required>
            <option value="">--Choose an option--</option>
            <option value="Cat">Cat</option>
            <option value="Dog">Dog</option>
        </select>

        <label id='description'>Description:<i class="required">*</i></label>
        <textarea class="description" name="description" placeholder="Describe the pet briefly" required></textarea>

        <label for="image">Select Image:<i class="required">*</i></label>
        <input type="file" id="image" name="image" accept="image/*">
        <p id="imageNotifier">Max size 500px</p>

        <label id='img_caption_title' for="image-caption">Image Caption:<i class="required">*</i></label>
        <input type="text" id="image-caption" name="imageCaption" placeholder="Describe the image in one word" required>

        <label for="age">Age(Months):<i class="required">*</i></label>
        <input type="number"  step="1.0" id="age" name="age" placeholder="Enter the age" required>

        <label for="location">Location:<i class="required">*</i></label>
        <input type="text" id="location" name="location" placeholder="Enter the location" required>

        
        <div class="btns">
            <button id="submissionBtn">Submit <i class="fa fa-check"></i></button>
                <a href="index.php" id="cancelBtn">Cancel <i class="fa fa-close"></i></a>
        </div>
    </form>


</main>

<?php include "includes/footer.inc" ?>

