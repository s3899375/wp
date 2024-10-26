<nav id="box1">
  <div class="container-fluid">
    <a class="navbar-brand" href="javascript:void(0)">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar" aria-controls="mynavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div  id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link rounded" href="countriestable.php">Countries Table</a>
        </li>
        <li class="nav-item">
          <a class="nav-link rounded" href="countries.php">Countries Gallery</a>
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
        <button class="btn btn-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
