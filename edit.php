<?php
include('inc/header.inc');
include('inc/nav.inc');
require_once 'inc/db_connect.inc';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $type = htmlspecialchars($_POST['type']);

    // Handle image update
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $image);
        $sql = "UPDATE pets SET name = ?, description = ?, type = ?, image = ? WHERE id = ? AND added_by = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $description, $type, $image, $id, $_SESSION['user_id']]);
    } else {
        $sql = "UPDATE pets SET name = ?, description = ?, type = ? WHERE id = ? AND added_by = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $description, $type, $id, $_SESSION['user_id']]);
    }

    echo "Pet updated successfully!";
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM pets WHERE id = ? AND added_by = ?");
    $stmt->execute([$id, $_SESSION['user_id']]);
    $pet = $stmt->fetch();
}

if (!$pet) {
    echo "Pet not found!";
    exit();
}
?>

<form method="post" enctype="multipart/form-data">
    <div class="container">
        <h2>Edit Pet</h2>
        <input type="text" name="name" value="<?= htmlspecialchars($pet['name']) ?>" required>
        <textarea name="description" required><?= htmlspecialchars($pet['description']) ?></textarea>
        <select name="type" required>
            <option value="Dog" <?= $pet['type'] == 'Dog' ? 'selected' : '' ?>>Dog</option>
            <option value="Cat" <?= $pet['type'] == 'Cat' ? 'selected' : '' ?>>Cat</option>
            <!-- Additional options -->
        </select>
        <input type="file" name="image">
        <input type="submit" value="Update Pet">
    </div>
</form>

<?php include('inc/footer.inc'); ?>
