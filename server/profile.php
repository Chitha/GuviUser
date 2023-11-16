<?php
// updateProfile.php

// Include the database connection
include_once 'db.php';

// Start the session
session_start();

// Check if the user is authenticated (logged in)
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Get the input data from the AJAX request
    $newAge = $_POST['newAge'];
    $newDob = $_POST['newDob'];
    $newContact = $_POST['newContact'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE users SET age = ?, dob = ?, contact = ? WHERE username = ?");
    $stmt->bind_param("isss", $newAge, $newDob, $newContact, $username);

    // Execute the statement
    if ($stmt->execute()) {
        // Update session data with new values
        $_SESSION['age'] = $newAge;
        $_SESSION['dob'] = $newDob;
        $_SESSION['contact'] = $newContact;
        
        header("Location: ../html/home.html");
        //echo "Profile updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // If not authenticated, redirect to the login page or handle as needed
    header("Location: ../html/index.html");
}

// Close the connection
$conn->close();
?>
