<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.inc"?>
<main>
    <h1 id="petsHeading">Pets Victoria has a lot to offer!</h1>
    <p id="petsPara">For almost two decades, pets victoria has helped in creating true social change by bringing pet adoption into the mainstream. our work has helped make a difference to the victorian rescue community and thousands of pets in need of rescue and rehabilitation. but, until every pet is safe, respected, and loved, we all still have big, hairy work to do.</p>

    <ul class="image-list">

        <?php
       $sql = "SELECT * FROM pets";
       $stmt = $conn->prepare($sql);
       $stmt->execute();
       $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array

       // Check if any pets were found
       if (count($result) > 0) {
           foreach ($result as $row) {
                echo '<li>';
                echo '<div class="image-container">';
                echo '<img src="' . $row["image"] . '" alt="' . $row["name"] . '">';
                echo '<h2>' . $row["name"] . '</h2>';
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