<?php
// Include necessary files for database connection and configuration
include_once 'config.php';
include_once 'db.php';  


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form data
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = $_POST['email'];

    // Validate username availability
    if (!isUsernameAvailable($username)) {
        $response = ['status' => 'error', 'message' => 'Username is not available. Please choose another.'];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    // Perform additional validation as needed (e.g., email format, password strength)

    // Save to the database
    saveToDatabase($username, $password, $email);

    // Return success response
    $response = ['status' => 'success', 'message' => 'Signup successful!'];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

 
 
// Placeholder function to save user data to the database
function saveToDatabase($username, $password, $email)
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
    // You should use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $email);

    // Execute the statement
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

// Placeholder function to check if a username is available
function isUsernameAvailable($username)
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

    // You should use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    // Check if the username is available
    $isAvailable = $result->num_rows === 0;

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    return $isAvailable;
}

?>


 