<?php
$title = "Index page";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('includes/header.inc'); 
include('includes/nav.inc'); 
include('includes/db_connect.inc');  
include('fetch_images.php'); 
?>

<!-- Display the login banner only if the user is logged in and the banner hasn't been shown yet -->
<?php if (!empty($_SESSION['username']) && empty($_SESSION['banner_displayed'])): ?>
    <div class="login-banner">
        <p>Login Successful</p>
        <button class="close-banner" onclick="this.parentElement.style.display='none';">×</button>
    </div>
    <?php $_SESSION['banner_displayed'] = true; // Set flag to prevent showing again ?>
<?php endif; ?>

<div id="IndexPageDiv" class="indexpage">
    <div class="content-container">
        <div class="carousel-container">
            <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php foreach ($images as $index => $image): ?>
                    <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></button>
                    <?php endforeach; ?>
                </div>
                <div class="carousel-inner">
                    <?php foreach ($images as $index => $image): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img src="images/<?php echo htmlspecialchars($image); ?>" alt="Image <?php echo $index + 1; ?>" class="d-block carousel-image">
                    </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="text-container">
            <h1 class="home-page">PETS VICTORIA</h1>
            <h2 class="homepagetext">WELCOME TO PET <br>ADOPTION</h2>
        </div>
    </div>
</div>
        <form action="search.php" method="get" class="searchinfodiv">
            <div class="search-container">
                <input type="text" name="query" class="search-bar" placeholder="I AM LOOKING FOR ...">
                <select name="pet_type" class="pet-type-dropdown">
                    <option value="">Select pet type</option>
                    <option value="Cat">Cat</option>
                    <option value="Dog">Dog</option>
                </select>
                <button type="submit" class="search-button">Search</button>
            </div>
        </form>


        <div>
            <p class="centered-text">
                PETS VICTORIA is a dedicated pet adoption organization based in Victoria, Australia, focused on providing a safe and loving environment for pets in need. With a compassionate approach, Pets Victoria works tirelessly to rescue, rehabilitate, and rehome dogs, cats, and other animals. Their mission is to connect these deserving pets with caring individuals and families, creating lifelong bonds. The organization offers a range of services, including adoption counseling, pet education, and community support programs, all aimed at promoting responsible pet ownership and reducing the number of homeless animals.
            </p></div>
            </div>
<?php
include('includes/footer.inc'); 
?>
