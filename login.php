<?php
// Enable error reporting for debugging during development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include necessary files
include('includes/header.inc');       // Assuming header includes HTML <head> and other markup
require_once 'includes/db_connect.inc';  // Database connection details

// Start the session at the top
// Check if session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Check if the form is submitted (login form)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and fetch user input
    $username = htmlspecialchars(trim($_POST['username']));
    $password = trim($_POST['password']);  // Password doesn't need special chars handling

    try {
        // Query to check if the username exists in the 'members' table
        $sql = "SELECT * FROM members WHERE username = ?";
        $stmt = $conn->prepare($sql);       // Use prepared statement to prevent SQL injection
        $stmt->execute([$username]);        // Execute the query with the user's username
        $user = $stmt->fetch();             // Fetch the user data if available

        // Verify if user exists and password matches
        if ($user && password_verify($password, $user['password'])) {
            // If login is successful, store relevant info in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to the index page or dashboard
            header("Location: index.php");
            exit();
        } else {
            // If login fails, display an error message
            $error_message = "Invalid username or password!";
        }
    } catch (PDOException $e) {
        // Catch any errors related to the database connection or query execution
        $error_message = "Error: " . $e->getMessage();
    }
}
?>

<!-- Login Form -->
<form method="post" action="login.php">
    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required placeholder="Enter your username">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required placeholder="Enter your password">
    </div>
    <div>
        <input type="submit" value="Login">
    </div>
</form>

<?php if (isset($error_message)): ?>
    <!-- Display the error message if login fails -->
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>

<!-- Include the footer -->
<?php include('includes/footer.inc'); ?>
