<?php
// ... (Database connection code)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "backend";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Get latitude and longitude from the AJAX request
$lat = $_GET['lat'];
$lng = $_GET['lng'];

// Perform a query to check if the location exists in the services database
$sql = "SELECT * FROM services WHERE latitude = ? AND longitude = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("dd", $lat, $lng);
$stmt->execute();
$result = $stmt->get_result();

// Prepare the response
$response = array();

if ($result->num_rows > 0) {
    // Location exists in the services database
    $response['exists'] = true;
} else {
    // Location doesn't exist in the services database
    $response['exists'] = false;
}

// Close the database connection
$stmt->close();
$conn->close();

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
