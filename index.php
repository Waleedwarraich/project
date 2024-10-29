<?php
include "includes/header.inc"; 
?>

<main>
    <!-- Toast Notification -->
    <div id="toast-container">
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-' . $_SESSION['message']['type'] . '">' . $_SESSION['message']['text'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
    </div>

    <!-- Main Heading -->
    <!-- Random Image -->
    <?php
    $sql = "SELECT image FROM pets ORDER BY created_at DESC LIMIT 4";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $recentImages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="first ">
        <div class="firstHeading">
            <h1 id="mainHeadingHome">Pets Victoria</h1>
            <h2 id="welcomeHeading">WELCOME TO PET ADOPTION</h2>
        </div>

        <?php if (!empty($recentImages)): ?>
        <div id="carouselExample" class="carousel slide mx-auto" data-bs-ride="carousel" style="max-width: 600px;">
            <div class="carousel-inner">
                <?php foreach ($recentImages as $index => $image): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img src="<?php echo htmlspecialchars($image['image']); ?>" class="d-block w-100 carousel-img" alt="Pet Image">
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    <?php else: ?>
        <p class="text-center">No recent images available.</p>
    <?php endif; ?>
    </div>
    <div id="search">
    <form id="searchForm" method="get" action="search.php">
        <input id="floatingInputInvalid" type="text" name="query" placeholder="I am looking for...">
        <select class="petSelectionSearch" name="type">
            <option value="">Select your pet here</option>
            <option value="Dog">Dog</option>
            <option value="Cat">Cat</option>
        </select>
        <button type="submit" class="btn btn-success">Search</button>
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
