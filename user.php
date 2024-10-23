<?php
include('includes/header.inc');
require_once 'includes/db_connect.inc';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM pets WHERE added_by = ?");
$stmt->execute([$_SESSION['user_id']]);
?>

<div class="container">
    <h2>My Pets</h2>
    <?php while ($pet = $stmt->fetch()): ?>
        <div class="pet">
            <img src="./<?= htmlspecialchars($pet['image']) ?>" alt="<?= htmlspecialchars($pet['name']) ?>">
            <h3><?= htmlspecialchars($pet['name']) ?></h3>
            <a href="details.php?id=<?= $pet['id'] ?>">View Details</a>
        </div>
    <?php endwhile; ?>
</div>

<?php include('includes/footer.inc'); ?>
