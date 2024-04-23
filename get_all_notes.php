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

// Fetch all notes from the database
$sql = "SELECT latitude, longitude, issue FROM notes";
$result = $conn->query($sql);

// Check if there are notes
if ($result->num_rows > 0) {
    $notes = array();

    // Fetch notes and add them to the array
    while ($row = $result->fetch_assoc()) {
        $notes[] = array(
            "latitude" => $row["latitude"],
            "longitude" => $row["longitude"],
            "note" => $row["issue"]
        );
    }

    // Return JSON response with notes
    echo json_encode(array("success" => true, "notes" => $notes));
} else {
    // No notes found
    echo json_encode(array("success" => false, "message" => "No notes found."));
}

// Close the database connection
$conn->close();
?>
