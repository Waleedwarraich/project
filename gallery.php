<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.inc"; ?>
<main>
    <h1 id="petsHeading">Pets Victoria has a lot to offer!</h1>
    <p id="petsPara">
        For almost two decades, pets victoria has helped in creating true social change by bringing pet adoption into the mainstream.
        Our work has helped make a difference to the victorian rescue community and thousands of pets in need of rescue and rehabilitation.
        But, until every pet is safe, respected, and loved, we all still have big, hairy work to do.
    </p>

    <!-- Pet Type Dropdown -->
    <label for="petTypeDropdown">Select type:</label>
    <select id="petTypeDropdown" onchange="filterPets()">
        <option value="all">All</option>
        <?php
        // Fetch distinct pet types for the dropdown
        $typeQuery = "SELECT DISTINCT type FROM pets";
        $typeStmt = $conn->prepare($typeQuery);
        $typeStmt->execute();
        $types = $typeStmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($types as $type) {
            echo '<option value="' . htmlspecialchars($type['type']) . '">' . htmlspecialchars($type['type']) . '</option>';
        }
        ?>
    </select>

    <!-- Pet Gallery -->
    <ul class="image-list" id="petGallery">
        <?php
        // Fetch all pets to display by default
        $sql = "SELECT * FROM pets";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            foreach ($result as $row) {
                echo '<li class="pet-item" data-type="' . htmlspecialchars($row["type"]) . '">';
                echo '<div class="image-container">';
                echo '<img src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
                echo '<h2>' . htmlspecialchars($row["name"]) . '</h2>';
                echo '<div class="overlay-text">';
                echo '<a href="details.php?id=' . htmlspecialchars($row["id"]) . '">Explore more</a>';
                echo '</div>';
                echo '</div>';
                echo '</li>';
            }
        } else {
            echo "<li>No images found.</li>";
        }
        ?>
    </ul>
</main>

<!-- JavaScript for Filtering Pets by Type -->
<script>
    function filterPets() {
        const selectedType = document.getElementById("petTypeDropdown").value;
        const petItems = document.querySelectorAll(".pet-item");

        petItems.forEach(item => {
            if (selectedType === "all" || item.getAttribute("data-type") === selectedType) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    }
</script>

<?php include "includes/footer.inc"; ?>
</html>
