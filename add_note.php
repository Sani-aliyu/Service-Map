<?php
// Replace with your database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'backend';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();

// Get user_id from the session (you should have started the session)
$user_id = $_SESSION['user_id'];

// Get note, latitude, and longitude from the AJAX request
$note = $_POST['note'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// Perform the insertion into the notes table
$sql = "INSERT INTO notes (user_id, issue, latitude, longitude) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isdd", $user_id, $note, $latitude, $longitude);
$result = $stmt->execute();

// Prepare the response
$response = array();

if ($result) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

// Close the database connections
$stmt->close();
$conn->close();

// Send a JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
