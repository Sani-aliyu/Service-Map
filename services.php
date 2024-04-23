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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data
    $name = $_POST["name"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $opening_hours = $_POST["opening_hours"];
    $longitude = $_POST["longitude"];
    $latitude = $_POST["latitude"];

    // SQL query to insert data into the 'hospital' table
    $sql = "INSERT INTO services (name, description,  category, opening_hours, longitude, latitude)
            VALUES ('$name', '$description', '$category', '$opening_hours', '$longitude', '$latitude')";

    // Perform the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to a new page upon successful registration
        header("Location: upload.php");
        exit(); // Ensure that no other content is sent after the header
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

// Close the database connection
$conn->close();
?>
