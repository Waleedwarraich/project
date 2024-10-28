<?php
session_start();
session_destroy();
session_start();
$_SESSION['message'] = [
    'type' => 'success',
    'text' => 'Logout Successfully' 
];
header("Location: index.php");
exit();
?>
