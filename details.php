<?php include "includes/header.inc"?>
<main>
    <?php
    include "includes/db_connect.inc";
    // Fetch pet details from database
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
        <img style="display: block; margin: 0 auto;" src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>"><br>
        <div class="detail-container">
            <div class="detail-item">
                <i class="fas fa-clock"></i><br>
                <span class="detail-value"><?php echo $row['age']; ?> Months</span>
            </div>
            <div class="detail-item">
                <i class="fas fa-paw"></i><br>
                <span class="detail-value"><?php echo $row['type']; ?></span>
            </div>
            <div class="detail-item">
                <i class="fas fa-location-arrow"></i><br>
                <span class="detail-value"><?php echo $row['location']; ?></span>
            </div>
        </div>
        <div class="name"><?php echo $row['name']; ?></div>
        <div class="description"><?php echo $row['description']; ?></div>
        <?php
    } else {
        echo "pet not found.";
    }
}
    ?>
</main>
<?php include "includes/footer.inc";?>





