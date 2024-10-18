<?php include "includes/header.inc"?>
<main>
    <?php
    include "includes/db_connect.inc";
    // Fetch pet details from database
    $sql = "SELECT * FROM pets WHERE id = ?"; // Assuming you have a unique id for each pet
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET['id']); // Assuming you pass the id as a parameter in the URL
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <img style="display: block; margin: 0 auto;" src="<?php echo $row['image']; ?>" alt="<?php echo $row['petname']; ?>"><br>
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
        <div class="name"><?php echo $row['petname']; ?></div>
        <div class="description"><?php echo $row['description']; ?></div>
        <?php
    } else {
        echo "pet not found.";
    }
    ?>
</main>
<?php include "includes/footer.inc";?>