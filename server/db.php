<?php
include_once 'config.php'; // Make sure this includes your database connection configuration


    $conn = new mysqli($servername, $dbusername, $dbpassword,$dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }   
?>

