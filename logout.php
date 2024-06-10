<?php
session_start(); // Start the session

// Unset the specific session variable
unset($_SESSION["user"]);

// Destroy the session
session_destroy();

// Redirect the user to the index.php page
header("Location: index.php");
exit(); // Ensure no further code is executed after redirection
?>