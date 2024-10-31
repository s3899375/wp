<?php
$title = "Register"; 
include('includes/header.inc');
include('includes/nav.inc');
include('includes/db_connect.inc');
session_start(); 

$errorMessage = isset($_SESSION['err']) ? $_SESSION['err'] : '';
$successMessage = isset($_SESSION['usrmsg']) ? $_SESSION['usrmsg'] : '';

unset($_SESSION['err']);
unset($_SESSION['usrmsg']);
?>

<div id="box4backgroundframe">
    <div class="login-container">
        <div class="login-form">
            <h2>Register</h2>
            <p>Create your account to join Pets Victoria</p>

            <form action="process_register.php" method="post">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="register-button">Register</button>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModalLabel">Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js_folder/main.js"></script>
