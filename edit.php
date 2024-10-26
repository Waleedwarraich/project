<?php
// Include header, navigation, and database connection files
include('includes/header.inc');
require_once 'includes/db_connect.inc';


// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the form was submitted and ID exists (for editing)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    // Sanitize user input
    $id = $_GET['id'];
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $type = htmlspecialchars($_POST['type']);
    $age = (int) $_POST['age'];
    $location = htmlspecialchars($_POST['location']);
    $imageCaption = htmlspecialchars($_POST['imageCaption']);

    // Handle image update if a new one is uploaded
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $image);
        $sql = "UPDATE pets SET name = ?, description = ?, type = ?, image = ?, caption = ?, age = ?, location = ? WHERE id = ? AND added_by = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $description, $type, $image, $imageCaption, $age, $location, $id, $_SESSION['user_id']]);
    } else {
        $sql = "UPDATE pets SET name = ?, description = ?, type = ?, caption = ?, age = ?, location = ? WHERE id = ? AND added_by = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $description, $type, $imageCaption, $age, $location, $id, $_SESSION['user_id']]);
    }

    $_SESSION['message'] = ['type' => 'success', 'text' => 'Pet updated successfully!'];
    header("Location: edit.php?id=$id");
    exit();
}

// If the form is not submitted but the pet ID exists (for pre-filling the form)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM pets WHERE id = ? AND added_by = ?");
    $stmt->execute([$id, $_SESSION['user_id']]);
    $pet = $stmt->fetch();

    if (!$pet) {
        echo "Pet not found!";
        exit();
    }
}

// Display messages if set
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-' . $_SESSION['message']['type'] . '">' . $_SESSION['message']['text'] . '</div>';
    unset($_SESSION['message']);
}
?>

<!-- Pet editing form -->
<form method="post" enctype="multipart/form-data">
    <div class="container mt-5">
        <h2>Edit Pet</h2>

        <label for="pets-name">Pet Name:<i class="required">*</i></label>
        <input type="text" id="pets-name" name="name" value="<?= htmlspecialchars($pet['name']) ?>" placeholder="Provide a name for the pet" required class="form-control mb-3">

        <label for="type">Type:<i class="required">*</i></label>
        <select id="type" name="type" required class="form-control mb-3">
            <option value="Cat" <?= $pet['type'] == 'Cat' ? 'selected' : '' ?>>Cat</option>
            <option value="Dog" <?= $pet['type'] == 'Dog' ? 'selected' : '' ?>>Dog</option>
            <!-- Additional options can be added -->
        </select>

        <label id='description'>Description:<i class="required">*</i></label>
        <textarea class="form-control mb-3" name="description" placeholder="Describe the pet briefly" required><?= htmlspecialchars($pet['description']) ?></textarea>

        <label for="image">Select Image:<i class="required">*</i></label>
        <input type="file" id="image" name="image" accept="image/*" class="form-control mb-3">
        <p id="imageNotifier">Max size 500px</p>

        <label id='img_caption_title' for="image-caption">Image Caption:<i class="required">*</i></label>
        <input type="text" id="image-caption" name="imageCaption" value="<?= htmlspecialchars($pet['caption']) ?>" placeholder="Describe the image in one word" required class="form-control mb-3">

        <label for="age">Age (Months):<i class="required">*</i></label>
        <input type="number" id="age" name="age" value="<?= htmlspecialchars($pet['age']) ?>" placeholder="Enter the age" required class="form-control mb-3">

        <label for="location">Location:<i class="required">*</i></label>
        <input type="text" id="location" name="location" value="<?= htmlspecialchars($pet['location']) ?>" placeholder="Enter the location" required class="form-control mb-3">

        <div class="btns">
            <button class="btn btn-success">Update Pet <i class="fa fa-check"></i></button>
            <a href="index.php" class="btn btn-danger">Cancel <i class="fa fa-close"></i></a>
        </div>
    </div>
</form>

<?php include('includes/footer.inc'); ?>
