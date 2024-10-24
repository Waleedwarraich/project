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
    <div class="first ">
        <div class="firstHeading">
            <h1 id="mainHeadingHome">Pets Victoria</h1>
            <h2 id="welcomeHeading">WELCOME TO PET ADOPTION</h2>
        </div>

    <!-- Random Image -->
    <?php
    $images = ["./images/cat1.jpeg", "./images/dog1.jpeg", "./images/dog2.jpeg", "./images/cat4.jpeg", "./images/dog3.jpeg"];
    $randomImage = $images[array_rand($images)];
    ?>
    <img src="<?php echo $randomImage; ?>" alt="Random Pet Image" class="circle-img">
    </div>
    <div id="search">
    <form id="searchForm" method="get" action="search.php">
        <input id="floatingInputInvalid" type="text" name="query" placeholder="I am looking for...">
        <select name="type">
            <option value="">Select your pet here</option>
            <option value="Dog">Dog</option>
            <option value="Cat">Cat</option>
        </select>
        <button type="submit">Search</button>
    </form>
    </div>
    <div class="second">
    
    <h1 id="petsHeadingIndex">Discover Pets Victoria</h1>
    <p id="petsParaIndex">
PETS VICTORIA IS A DEDICATED PET ADOPTION ORGANIZATION BASED IN VICTORIA, AUSTRALIA, FOCUSED ON PROVIDING A SAFE AND LOVING ENVIRONMENT FOR PETS IN NEED. WITH A COMPASSIONATE APPROACH, PETS VICTORIA WORKS TIRELESSLY TO RESCUE, REHABILITATE, AND REHOME DOGS, CATS, AND OTHER ANIMALS. THEIR MISSION IS TO CONNECT THESE DESERVING PETS WITH CARING INDIVIDUALS AND FAMILIES, CREATING LIFELONG BONDS. THE ORGANIZATION OFFERS A RANGE OF SERVICES, INCLUDING ADOPTION COUNSELING, PET EDUCATION, AND COMMUNITY SUPPORT PROGRAMS,
ALL AIMED AT PROMOTING RESPONSIBLE PET OWNERSHIP AND REDUCING THE NUMBER OF HOMELESS ANIMALS.</p>
    </div>

</main>

<?php include "includes/footer.inc"; ?>
