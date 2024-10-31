<footer id="footerindex">
    <?php if (isset($_SESSION['username'])): ?>
        <p>
            <a href="user.php" style="text-decoration: none; color: inherit;">
                <?php echo htmlspecialchars($_SESSION['username']); ?>
            </a>
        </p>
    <?php endif; ?>
    <p>
        &copy; Copyright S3899375. All Rights Reserved | Designed for Pets Victoria
    </p>
</footer>
</body>
</html>
