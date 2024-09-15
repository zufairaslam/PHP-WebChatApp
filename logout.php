<?php
include 'includes/session.php'; // Include session start file

session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

header("Location: login.php"); // Redirect to the login page
exit();
?>
