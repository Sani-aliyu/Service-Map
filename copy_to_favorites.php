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

// Get latitude and longitude from the URL parameters
// Get latitude and longitude from the AJAX request
$lat = $_POST['lat'];
$lng = $_POST['lng'];

// Get user_id from the session (you should have started the session)
$user_id = $_SESSION['user_id'];

// Query the source table to get details based on latitude, longitude, and user_id
$sourceSql = "SELECT * FROM services WHERE latitude = ? AND longitude = ?";
$sourceStmt = $conn->prepare($sourceSql);
$sourceStmt->bind_param("dd", $lat, $lng);
$sourceStmt->execute();
$result = $sourceStmt->get_result();

// Prepare the data to be inserted into the target table
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Customize the insertion logic based on your table structure
    $name = $row['name'];
    $description = $row['description'];
    $category = $row['category'];
    $opening_hours = $row['opening_hours'];

    // Perform the insertion into the target table (e.g., favorites)
    $targetSql = "INSERT INTO favorites (user_id, name, description, category, opening_hours, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $targetStmt = $conn->prepare($targetSql);
    $targetStmt->bind_param("issssdd", $user_id, $name, $description, $category, $opening_hours, $lat, $lng);
    $targetStmt->execute() or die($conn->error);

    // Close the database connections
    $targetStmt->close();
}

// Close the database connections
$sourceStmt->close();
$conn->close();

// Send a JSON response (customize based on your needs)
header('Content-Type: application/json');
echo json_encode(['success' => true]);
?>
