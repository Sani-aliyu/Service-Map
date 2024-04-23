<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace these with your database connection details
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

    // Retrieve user details from the form
    $user_id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $email = $_POST['Email'];
    $password = $_POST['Password']; 
    $dob = $_POST['DOB'];
    $phone = $_POST['Phone'];
    $gender = isset($_POST['Gender']) ? $_POST['Gender'] : '';

    // Update user details in the database
    $sql = "UPDATE user SET username = ?, email = ?, password = ?, dob = ?, phone = ?, gender = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $username, $email, $password, $dob, $phone, $gender, $user_id);
    $result = $stmt->execute();

    if ($result) {
        header('Location: profile.php');
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
