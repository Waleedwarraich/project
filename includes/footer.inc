<?php
// Start the session if it hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<footer class="footer bg-brown text-center text-white py-1" style="background-color: #d87d42; padding: 10px 0; font-size: 0.9rem;">
    <a href="#"> 
        <?php if (isset($_SESSION['username'])): ?>
            <p style="margin: 5px;"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <?php else: ?>
            <p style="margin: 5px;">Username: Guest</p> <!-- Default text for non-logged in users -->
        <?php endif; ?>
    </a>
    
    <p style="margin: 5px;">© Copyright s3994931. All Rights Reserved | Designed for Pets Victoria</p>
    
    <script src="main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</footer>
</body>
</html>
