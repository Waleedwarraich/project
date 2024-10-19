<?php
// Check what server you are accessing
if (strstr($_SERVER['SERVER_NAME'], 'localhost')) {
    $host = 'localhost';
    $db = 'petsvictoria';
    $user = 'root';
    $pass = '';
} else {
    $host = 'talsprddb02.int.its.rmit.edu.au';
    $db = 's3994931';
    $user = 's3994931';
    $pass = 'Wali$1122';
}

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}
?>
