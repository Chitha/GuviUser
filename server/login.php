<?php
// Include necessary files for database connection and configuration
include_once 'config.php';
include_once 'db.php';
 
 
 
// Placeholder function to verify login credentials
function verifyLogin($username, $password)
{
    // Implement your login verification logic here
    // Example: Check if the username and hashed password match a record in the users table
    // This is a simplified example and should be adapted to your actual database structure and connection method
    $servername = 'localhost';
$dbname = 'guviuser';
$dbusername = 'chith';
$dbpassword = '@Nathan16';
    $conn = new mysqli($servername, $dbusername, $dbpassword,$dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // You should use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, login successful
            // Start a session
         session_start();

         // Store user information in the session
         $_SESSION['username'] = $user['username'];
         $_SESSION['user_id'] = $user['id']; // Include any other relevant information

            return true;
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process login form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verify login credentials
    if (verifyLogin($username, $password)) {
         
        // Return success response
        $response = ['status' => 'success', 'message' => 'Login successful!'];
    } else {
        // Return error response
        $response = ['status' => 'error', 'message' => 'Invalid username or password. Please try again.'];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
