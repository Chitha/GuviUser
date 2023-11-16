<?php
// Placeholder function to get user details from the database
function getUserDetails()
{
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
// Check if the 'username' is set in the session
if (isset($_SESSION['user_id'])) {
     
    $user_id =$_SESSION['user_id'];
 

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
}
}

// Get user details and return as JSON
$userDetails = getUserDetails();

header('Content-Type: application/json');
echo json_encode($userDetails);
?>
