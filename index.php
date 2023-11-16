<?php
// Start the session
session_start();
// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Check if the user is authenticated (logged in)
if (isset($_SESSION['username'])) {
    // If authenticated, display the profile page
    include 'html/profile.html';
} else {
    // If not authenticated, display the login/signup page
    include 'html/index.html';
}

 
?>
