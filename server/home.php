<?php
// Include necessary files for database connection and configuration
 
 

// Start the session
session_start();

// Check if the user is authenticated (logged in)
if (isset($_SESSION['username'])) {
    // If authenticated, display the profile page
    include '../html/home.html';
} else {
    // If not authenticated, display the login/signup page
    include '../html/index.html';
}
 

 
?>