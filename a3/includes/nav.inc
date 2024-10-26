<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a href="index.php" class="navbar-brand">
      <img src="images/logo.png" alt="home" style="height: 40px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link rounded" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link rounded" href="pets.php">Pets</a>
        </li>
        <li class="nav-item">
          <a class="nav-link rounded" href="gallery.php">Gallery</a>
        </li>
        <?php if (!empty($_SESSION['user'])) { ?>
          <li class="nav-item">
            <a class="nav-link rounded" href="add.php">Add New Country</a>
          </li>
          <li class="nav-item">
            <a class="nav-link rounded" href="logout.php">Logout</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link rounded" href="register.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link rounded" href="login.php">Login</a>
          </li>
        <?php } ?>
      </ul>
      
      <form class="d-flex">
        <input class="form-control me-2" type="text" placeholder="Search">
        <button class="btn btn-outline-secondary" type="submit">
          <span class="material-symbols-outlined">search</span>
        </button>
      </form>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
