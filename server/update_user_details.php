<?php
// updateProfile.php

// Include the database connection
$servername = 'localhost';
$dbname = 'guviuser';
$dbusername = 'chith';
$dbpassword = '@Nathan16';
    $conn = new mysqli($servername, $dbusername, $dbpassword,$dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user_id =$_SESSION['user_id'];;
    $newAge = $_POST['newAge'];   
    $newEmail = $_POST['newEmail'];    
    $newContact = $_POST['newContact'];

    $stmt = $conn->prepare("UPDATE users SET email = ?, age = ?, contact = ? WHERE id = ?");
    $stmt->bind_param("sisi", $newEmail,$newAge, $newContact, $user_id);
    
    $stmt->execute();
     

    $stmt->close();
    $conn->close();
     
} else {
     
}
?>
 