<?php
// Include header, navigation, and database connection files
include('includes/header.inc');
require_once 'includes/db_connect.inc';



// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user input
    $name = htmlspecialchars($_POST['petname']);
    $description = htmlspecialchars($_POST['description']);
    $type = htmlspecialchars($_POST['type']);
    $age = (int) $_POST['age'];
    $location = htmlspecialchars($_POST['location']);
    $imageCaption = htmlspecialchars($_POST['imageCaption']);
    
    // Handle image upload
    $image = $_FILES['image']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // Prepare SQL query to insert pet into the database
        $sql = "INSERT INTO pets (name, description, type, image, image_caption, age, location, added_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        // Execute the query with user input
        if ($stmt->execute([$name, $description, $type, $image, $imageCaption, $age, $location, $_SESSION['user_id']])) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Pet added successfully!'];
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'text' => 'Failed to add the pet. Please try again.'];
        }
    } else {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Image upload failed. Please try again.'];
    }

    // Redirect to avoid form resubmission on refresh
    header("Location: add.php");
    exit();
}
?>
<main>
    <h1 id="petsHeading">Add a Pet</h1>
    <p id="petsPara">You can add a new pet here.</p>

    <?php
    // Check if there's a message set in session
    if (isset($_SESSION['message'])) {
        // Display message (success or failure)
        echo '<div class="alert alert-' . $_SESSION['message']['type'] . '">' . $_SESSION['message']['text'] . '</div>';
        unset($_SESSION['message']); // Unset session message after displaying
    }
    ?>

    <!-- Pet addition form -->
    <form id="pet-form" action="add.php" method="post" enctype="multipart/form-data">
        <div class="container mt-5">
            <label for="pets-name">Pet Name:<i class="required">*</i></label>
            <input type="text" id="pets-name" name="petname" placeholder="Provide a name for the pet" required class="form-control mb-3">

            <label for="type">Type:<i class="required">*</i></label>
            <select id="type" name="type" required class="form-control mb-3">
                <option value="">--Choose an option--</option>
                <option value="Cat">Cat</option>
                <option value="Dog">Dog</option>
                <!-- Additional pet types can be added here -->
            </select>

            <label id='description'>Description:<i class="required">*</i></label>
            <textarea class="form-control mb-3" name="description" placeholder="Describe the pet briefly" required></textarea>

            <label for="image">Select Image:<i class="required">*</i></label>
            <input type="file" id="image" name="image" accept="image/*" required class="form-control mb-3">
            <p id="imageNotifier">Max size 500px</p>

            <label id='img_caption_title' for="image-caption">Image Caption:<i class="required">*</i></label>
            <input type="text" id="image-caption" name="imageCaption" placeholder="Describe the image in one word" required class="form-control mb-3">

            <label for="age">Age (Months):<i class="required">*</i></label>
            <input type="number" id="age" name="age" placeholder="Enter the age" required class="form-control mb-3">

            <label for="location">Location:<i class="required">*</i></label>
            <input type="text" id="location" name="location" placeholder="Enter the location" required class="form-control mb-3">

            <div class="btns">
                <button class="btn btn-success">Submit <i class="fa fa-check"></i></button>
                <a href="index.php" class="btn btn-danger">Cancel <i class="fa fa-close"></i></a>
            </div>
        </div>
    </form>
</main>

<?php include "includes/footer.inc"; ?>
