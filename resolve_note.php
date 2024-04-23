<?php
// Database connection details
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

// Check if latitude and longitude are provided in the POST request
if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Update the Status column to 1 for the provided latitude and longitude using prepared statement
    $sql = "UPDATE notes SET Status = 'Resolved' WHERE Latitude = ? AND Longitude = ?";

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $latitude, $longitude);

    if ($stmt->execute()) {
        $response = array("success" => true);
    } else {
        $response = array("success" => false);
    }

    // Close the statement
    $stmt->close();
} else {
    $response = array("success" => false);
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
