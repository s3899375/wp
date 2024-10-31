<?php
$title = "Login"; 
include('includes/header.inc');
include('includes/nav.inc');
include('includes/db_connect.inc');
session_start(); 


$errorMessage = isset($_SESSION['err']) ? $_SESSION['err'] : '';

unset($_SESSION['err']);
?>

<div id="box4backgroundframe">
    <div class="login-container">
        <div class="login-form">
            <h2>Sign in</h2>
            <p>Login to access Pets Victoria</p>
            <form action="process_login.php" method="post">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <span class="show-password" onclick="togglePassword()">show</span>
                </div>
                <button type="submit" class="sign-in-button">Sign in</button>
            </form>
            <p class="new-to-site">New to Pets Victoria? <a href="register.php">Join now</a></p>
        </div>
    </div>
</div>

<div class="modal" id="loginErrorModal" tabindex="-1" aria-labelledby="loginErrorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginErrorModalLabel">Login Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                if ($errorMessage) {
                    echo "<div style='color: red;'>$errorMessage</div>";
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="js_folder/main.js"></script>

