<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.inc"?>
<main>
    <h1 id="petsHeading">Pets Victoria has a lot to offer!</h1>
    <p id="petsPara">For almost two decades, pets victoria has helped in creating true social change by bringing pet adoption into the mainstream. our work has helped make a difference to the victorian rescue community and thousands of pets in need of rescue and rehabilitation. but, until every pet is safe, respected, and loved, we all still have big, hairy work to do.</p>

    <ul class="image-list">

        <?php
       $sql = "SELECT * FROM pets";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li>';
                echo '<div class="image-container">';
                echo '<img src="' . $row["image"] . '" alt="' . $row["petname"] . '">';
                echo '<h2>' . $row["petname"] . '</h2>';
                echo '<div class="overlay-text">';
                echo '<a href="details.php?id=' . $row["id"] . '">Explore more</a>';
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
<?php include "includes/footer.inc";?>