<?php
// Include necessary files for database connection and configuration
include_once 'server\config.php';
include_once 'server\db.php';  
include_once 'server\profile.php';

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Start the session
session_start();

// Check if the user is authenticated (logged in)
if (isset($_SESSION['username'])) {
    // If authenticated, display the profile page
    include 'html/profile.html';
} else {
    // If not authenticated, display the login/signup page
    include 'html/index.html';
}
 


// Check if the form is submitted for login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Get user input
    $loginUsername = $_POST['loginUsername'];
    $loginPassword = $_POST['loginPassword'];

    // Prepare and execute the SQL statement to check login credentials
    $stmt = $conn->prepare('SELECT id, username, password FROM users WHERE username = ?');
    $stmt->bind_param('s', $loginUsername);
    $stmt->execute();
    $stmt->bind_result($userId, $dbUsername, $dbPassword);
    $stmt->fetch();

    if ($dbUsername && password_verify($loginPassword, $dbPassword)) {
        // Login successful
        session_start();
        $_SESSION['user_id'] = $userId;
        header('Location: profile.php'); // Redirect to the profile page
        exit();
    } else {
        // Login failed
        echo 'Login failed. Please check your credentials.';
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
