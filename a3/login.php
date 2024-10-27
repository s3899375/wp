<?php
$title = "login"; 
include('includes/header.inc');
include('includes/nav.inc');
include('includes/db_connect.inc'); // Fixed typo in 'include'
session_start(); 
?>
<div id="box4backgroundframe">
    <div class="login-container">
        <div class="login-form">
            <h2>Sign in</h2>
            <p>login to access pets victoria</p>
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
            <p class="new-to-site">New to Pets victoria? <a href="register.php">Join now</a></p>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const showPassword = document.querySelector('.show-password');
        if (passwordField.type === "password") {
            passwordField.type = "text";
            showPassword.textContent = "hide";
        } else {
            passwordField.type = "password";
            showPassword.textContent = "show";
        }
    }
</script>

<?php
include('includes/footer.inc'); 
?>
