<?php
$title = "Register"; 
include('includes/header.inc');
include('includes/nav.inc');
include('includes/db_connect.inc');
session_start(); 
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

<?php
include('includes/footer.inc'); 
?>
