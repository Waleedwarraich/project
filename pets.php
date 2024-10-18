<!DOCTYPE html>
<html lang="en">
<?php include('includes/header.inc') ?>
  <main>
        <h1 id="petsHeading">Discover Pets Victoria</h1>
        <p id="petsPara">Pets victoria is a dedicated pet adoption organization based in victoria, australia, focused on providing a safe and loving environment for pets in need. with a compassionate approach, pets victoria works tirelessly to rescue, rehabilitate, and rehome dogs, cats, and other animals. their mission is to connect these deserving pets with caring individuals and families, creating lifelong bonds. the organization offers a range of services, including adoption counseling, pet education, and community support programs, all aimed at promoting responsible pet ownership and reducing the number of homeless animals.</p>
        <img id="petsImage" src="./images/pets.jpeg" alt="No Image to preview">
    <table id="petsTable">
      <caption>Pets in Victoria</caption>
        <tr>
          <th>Pet</th>
          <th>Type</th>
          <th>Age</th>
          <th>Location</th>
        </tr>
        <?php
        $sql = "SELECT * FROM pets";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo '<td><a href="details.php?id=' . $row["id"] . '">' . $row["petname"] . '</a></td>';
                echo "<td>" . $row["type"] . "</td>";
                

                if ($row["age"] < 12) {
                    echo "<td>" . $row["age"] . " Months" . "</td>";
                } else {
                    $years = floor($row["age"] / 12);
                    echo "<td>" . $years . " Year(s)" . "</td>";
                }

                echo "<td>" . $row["location"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No pets found.</td></tr>";
        }
        ?>
    </table>
  </main>
<?php include "includes/footer.inc";?>