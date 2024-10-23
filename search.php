
<?php
include('includes/header.inc');
require_once 'includes/db_connect.inc';

$searchTerm = isset($_GET['query']) ? '%' . htmlspecialchars($_GET['query']) . '%' : '';
$typeFilter = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : '';

$sql = "SELECT * FROM pets WHERE name LIKE ? OR description LIKE ?";
if ($typeFilter) {
    $sql .= " AND type = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$searchTerm, $searchTerm, $typeFilter]);
} else {
    $stmt = $conn->prepare($sql);
    $stmt->execute([$searchTerm, $searchTerm]);
}
?>

<!-- Display search results -->
<div class="container">
    <h2>Search Results</h2>
    <div class="results">
        <?php while ($pet = $stmt->fetch()): ?>
            <div class="pet">
                <img src="images/<?= htmlspecialchars($pet['image']) ?>" alt="<?= htmlspecialchars($pet['name']) ?>">
                <h3><?= htmlspecialchars($pet['name']) ?></h3>
                <a href="details.php?id=<?= $pet['id'] ?>">View Details</a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include('includes/footer.inc'); ?>