    <nav>
        <div id="box1">
        <div class="NAV-container">
            
            <a href="index.php" class="home-link">
                <div class="home-button">
                    <img src="images/logo.png" alt="home">
                </div>
            </a>
            
    
            <select class="nav-select" onchange="navigatePage()">
                <option value="" disabled selected>Select an option</option>
                <option value="index.php">Home Page</option>
                <option value="pets.php">Pets Page</option>
                <option value="add.php">Add a Pet Page</option>
                <option value="gallery.php">Gallery Page</option>
            </select>
            
            <script src="main.js"></script>
        </div>
        <div class="search-container">
            <input type="text" placeholder="Search" class="search-input">
            <button class="search-button">
                <span class="material-symbols-outlined">search</span> 
            </button>
        </div>        
    </div>
</nav>