<?php
include('includes/header.inc');
require_once 'includes/db_connect.inc';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("DELETE FROM pets WHERE id = ? AND added_by = ?");
    $stmt->execute([$id, $_SESSION['user_id']]);
    echo "Pet deleted successfully!";
}
?>

<form method="post">
    <div class="container">
        <h2>Delete Pet</h2>
        <p>Are you sure you want to delete this pet?</p>
        <button type="submit">Yes, Delete</button>
    </div>
</form>

<?php include('includes/footer.inc'); ?>
