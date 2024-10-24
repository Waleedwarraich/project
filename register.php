<?php
include('includes/header.inc');
require_once 'includes/db_connect.inc';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = htmlspecialchars($_POST['email']);

    $sql = "INSERT INTO members (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$username, $password, $email])) {
        echo "Registration successful!";
    } else {
        echo "Error: Could not register.";
    }
}
?>

<form id="registerForm" method="post" action="register.php">
    <h1>Enter the following to register: </h1>
    <input type="text" name="username" required placeholder="Username">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
    <input type="submit" value="Register">
</form>

<?php include('includes/footer.inc'); ?>
