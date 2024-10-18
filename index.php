
<?php include "includes/header.inc" ?>
<main>
    <div id="toast-container">
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="' . $_SESSION['message']['type'] . '">' . $_SESSION['message']['text'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
    </div>
    <h1 id="mainHeadingHome">Pets Victoria</h1>
    <h2 id="welcomeHeading">WELCOME TO PET ADOPTION</h2>
    <img src="./images/main.jpg" alt="Apostles Image" class="circle-img">
</main>
<?php include "includes/footer.inc"?>
