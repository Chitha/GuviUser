<?php
// Include necessary files for database connection and configuration

require '../vendor/autoload.php';
 
Predis\Autoloader::register();

 

// Start the session
session_start();


$redis = new Predis\Client();
 
// Generate session ID and expiration time
$sessionId = session_id();
// Retrieve session data
$storedSessionData = $redis->get($sessionId);
if ($storedSessionData !== false) {
    $session = json_decode($storedSessionData, true);
    // Use session data    
     
    include '../html/home.html';

} else {
    include '../html/index.html';
    echo "Session not found\n";
}
 
 
  

 
?>