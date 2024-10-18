<?php
session_start();

include "includes/db_connect.inc";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST['petname']) || empty($_POST['description']) || empty($_POST['imageCaption']) || empty($_POST['age']) || empty($_POST['location']) || empty($_POST['type'])) {
        $_SESSION['message'] = array('type' => 'error', 'text' => 'All fields are required.');
        header("Location: add.php");
        exit();
    }
    // Form data
    $petName = $_POST['petname'];
    $description = $_POST['description'];
    $imageCaption = $_POST['imageCaption'];
    $age = $_POST['age'];
    $location = $_POST['location'];
    $type = $_POST['type'];

    // File upload
    $targetDir = "images/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Check if file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check === false) {
        $_SESSION['message'] = array('type' => 'error', 'text' => 'File is not an image.');
        header("Location: add.php");
        exit();
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        $_SESSION['message'] = array('type' => 'error', 'text' => 'Sorry, your file is too large. Max file size is 500KB.');
        header("Location: add.php");
        exit();
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $_SESSION['message'] = array('type' => 'error', 'text' => 'Sorry, only JPG, JPEG, and PNG files are allowed.');
        header("Location: add.php");
        exit();
    }

    // Upload file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        // SQL query
        $sql = "INSERT INTO pets (petname, description, image, caption, age, location, type) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $petName, $description, $targetFile, $imageCaption, $age, $location, $type);

        // Execute query
        if ($stmt->execute()) {
            $_SESSION['message'] = array('type' => 'success', 'text' => 'Data saved successfully');
        } else {
            $_SESSION['message'] = array('type' => 'error', 'text' => 'Error: ' . $conn->error);
        }

        // Close statement
        $stmt->close();
    } else {
        $_SESSION['message'] = array('type' => 'error', 'text' => 'Sorry, there was an error uploading your file.');
    }

    // Close connection
    $conn->close();
} else {
    // If form is not submitted
    $_SESSION['message'] = array('type' => 'error', 'text' => 'Form submission error.');
}

// Redirect back to the form page
header("Location: add.php");
exit();
?>
