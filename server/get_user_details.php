<?php


require '../vendor/autoload.php';

Predis\Autoloader::register();


// Placeholder function to get user details from the database
function getUserDetails()
{
    include_once 'db.php';
    session_start();

    
    include_once '../vendor/autoload.php';

Predis\Autoloader::register();


    
$redis = new Predis\Client();
 
// Generate session ID and expiration time
$sessionId = session_id();
// Retrieve session data
$storedSessionData = $redis->get($sessionId);
if ($storedSessionData !== false) {
    $session = json_decode($storedSessionData, true);
     
    $user_id =$session['user_id'];
 

    // You should use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("s", $user_id);

    // Execute the statement
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();
 $userDetails = $result->fetch_assoc();

 // Close the connection
 $conn->close();

 return $userDetails;

} else {
    include '../html/index.html';
    echo "Session not found\n";
}


// Check if the 'username' is set in the session
if (isset($_SESSION['user_id'])) {
     
   
}
}

// Get user details and return as JSON
$userDetails = getUserDetails();

header('Content-Type: application/json');
echo json_encode($userDetails);
?>
