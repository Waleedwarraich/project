<?php
include "includes/header.inc"; 
?>
<main>
    <!-- Toast Notification -->
    <div id="toast-container">
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="toast ' . $_SESSION['message']['type'] . '">' . $_SESSION['message']['text'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
    </div>

    <!-- Main Heading -->
    <h1 id="mainHeadingHome">Pets Victoria</h1>
    <h2 id="welcomeHeading">WELCOME TO PET ADOPTION</h2>

    <!-- Random Image -->
    <?php
    $images = ["./images/cat1.jpeg", "./images/dog1.jpeg", "./images/dog2.jpeg", "./images/cat4.jpeg", "./images/dog3.jpeg"];
    $randomImage = $images[array_rand($images)];
    ?>
    <img src="<?php echo $randomImage; ?>" alt="Random Pet Image" class="circle-img">

</main>

<?php include "includes/footer.inc"; ?>
