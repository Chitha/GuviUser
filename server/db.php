<?php
include_once 'config.php'; // Make sure this includes your database connection configuration
 
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function createUser($username, $password, $email) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $email);

    if ($stmt->execute()) {
        $user = [
            'username' => $username,
            'email' => $email,
            'id' => $stmt->insert_id
        ];

        saveUserToJsonFile($user); // Save to JSON file

        return true;
    } else {
        return false;
    }
}

function saveUserToJsonFile($user) {
    $users = getUsersFromJsonFile();
    $users[] = $user;

    file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
}

function getUsersFromJsonFile() {
    if (file_exists('users.json')) {
        $jsonContent = file_get_contents('users.json');
        return json_decode($jsonContent, true);
    } else {
        return [];
    }
}
?>

