<?php include "includes/header.inc"; ?>
<main class="mainDetails">
    <?php
    include "includes/db_connect.inc";
    // Fetch pet details from the database
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $pet_id = intval($_GET['id']); // Get the pet id from the URL and sanitize it as an integer
        
        // Prepare SQL statement to fetch pet details
        $sql = "SELECT * FROM pets WHERE id = :id"; // Use named placeholders in PDO
        $stmt = $conn->prepare($sql); // Prepare the SQL query
        $stmt->bindValue(':id', $pet_id, PDO::PARAM_INT); // Bind the id value to the SQL query
        
        $stmt->execute(); // Execute the query
        
        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch a single row as an associative array
        
        if ($row) {
    ?>
    
        <img class="detailImage" src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>"><br>
        <div class="detail-container">
            <div class="detail-item">
                <i class="fas fa-clock"></i><br>
                <span class="detail-value"><?php echo htmlspecialchars($row['age']); ?> Months</span>
            </div>
            <div class="detail-item">
                <i class="fas fa-paw"></i><br>
                <span class="detail-value"><?php echo htmlspecialchars($row['type']); ?></span>
            </div>
            <div class="detail-item">
                <i class="fas fa-location-arrow"></i><br>
                <span class="detail-value"><?php echo htmlspecialchars($row['location']); ?></span>
            </div>
        </div>
        <div class="name"><?php echo htmlspecialchars($row['name']); ?></div>
        <div class="description"><?php echo htmlspecialchars($row['description']); ?></div>
        
        <div class="action-buttons">
            <a href="edit.php?id=<?php echo intval($row['id']); ?>" class="btn edit-btn btn-primary">Edit</a>
            <a href="delete.php?id=<?php echo intval($row['id']); ?>" class="btn delete-btn btn-danger" onclick="return confirm('Are you sure you want to delete this pet?');">Delete</a>
        </div>
    <?php
        } else {
            echo "Pet not found.";
        }
    } else {
        echo "Invalid pet ID.";
    }
    ?>
</main>
<?php include "includes/footer.inc"; ?>
