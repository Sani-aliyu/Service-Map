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

// Get fav_id from the URL parameters
$favId = $_GET['fav_id'];

// Prepare and execute the deletion query
$sql = "DELETE FROM favorites WHERE fav_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $favId);
$result = $stmt->execute();

// Prepare the JSON response
$response = array('success' => false);

if ($result) {
    $response['success'] = true;
}

// Close the database connections
$stmt->close();
$conn->close();

// Send a JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
