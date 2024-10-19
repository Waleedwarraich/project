<footer class="footer bg-brown text-center text-white py-3" style="background-color: #d87d42;">
    <a href="#">T&Cs</a> 
    <br>
    <p>© Copyright <?php echo date('Y'); ?>. All Rights Reserved | Designed for Pets Victoria</p>
    <p>Username: <?php echo htmlspecialchars($_SESSION['username']); ?></p> <!-- Assuming user is logged in and session contains 'username' -->
    <script src="main.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</footer>
</body>
</html>
