<?php
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

// Get the search term from the client-side
$searchTerm = $_GET['searchTerm'];

// Query the database
$sql = "SELECT * FROM services WHERE category LIKE '%$searchTerm%'";
$result = $conn->query($sql);

// Process the query result
$locations = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $locations[] = array(
            'name' => $row['name'],
            'description' => $row['description'],
            'opening_hours' => $row['opening_hours'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude']
        );
    }
}

// Close the database connection
$conn->close();

// Return the result as JSON
echo json_encode($locations);
?>
