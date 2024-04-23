<?php
// Replace these values with your actual database credentials
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

// Process the form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $password = mysqli_real_escape_string($conn, $_POST['Password']);
    $dob = mysqli_real_escape_string($conn, $_POST['DOB']);
    $phone = mysqli_real_escape_string($conn, $_POST['Phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['Gender']);

    // Hash the password
    //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert data into the "user" table
    $sql = "INSERT INTO user (username, email, password, dob, phone, gender)
            VALUES ('$username', '$email', '$password', '$dob', '$phone', '$gender')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to a new page upon successful registration
         header("Location: index.php");
        exit; // Ensure that no other content is sent after the header
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="indexstyle.css">
        
    <!-- ===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <title>ServiceMap</title>
</head>
<body>
    <nav>
        <div class="nav-bar">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#">ServiceMap</a></span>

            <div class="menu">
                <div class="logo-toggle">
                    <span class="logo"><a href="#">ServiceMap</a></span>
                    <i class='bx bx-x siderbarClose'></i>
                </div>

                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="darkLight-searchBox">
                <div class="dark-light">
                    <i class='bx bx-moon moon'></i>
                    <i class='bx bx-sun sun'></i>
                </div>

                <div class="searchBox">
                   <div class="searchToggle">
                    <i class='bx bx-x cancel'></i>
                    <i class='bx bx-search search'></i>
                   </div>

                    <div class="search-field">
                        <input type="text" placeholder="Search...">
                        <i class='bx bx-search'></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="regcon">
           <div class="wrapper">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="POST">
      <h2>Signup</h2>
      
      <div class="input-field">
        <input type="text" name="username" maxlength="15"required><br>
        <label>choose a username</label>
      </div>

        <div class="input-field">
          <input type="email" name="Email" maxlength="50" required>
        <label>Enter your email</label>
      </div>
      <div class="input-field">
        <input type="password" name="Password" id="password">
        <label>Enter Password</label>
      </div>
      <input type="checkbox" id="show-password-checkbox" onclick="togglePasswordVisibility()"  style="transform: scale(1.0);">show password</input>



      <div class="input-field">
        <input type="date" name="DOB" required >
        <label>Date of Birth</label>
      </div>

      <div class="input-field">
        <input type="number" name="Phone" maxlength="10">
        <label>phone Number</label>
      </div>
      
     
          <div>
            <label>Gender:</label>
            <label for="male" class="radio-inline"><input type="radio" name="Gender" value="M" id="male">Male</label>
            <label for="female" class="radio-inline"><input type="radio" name="Gender" value="F" id="female">Female</label>
          </div>

      
      <div class="policy-text">
        <input type="checkbox" id="policy">
        <label for="policy">
            I agree to the
            <a href="#" class="option">Terms & Conditions</a>
        </label>
    </div>
    <br>

      <button type="submit">REGISTER</button>
      <div class="register">
        <p>Already have an account? <a href="index.php">LOGIN</a></p>
      </div>
    </form>
    
    </div>
    </div>

</body>
</html>

    <script src="indexscript.js"></script>
    <script>
 function togglePasswordVisibility() {
    var passwordField = document.getElementById("password");
    var showPasswordCheckbox = document.getElementById("show-password-checkbox");

    if (showPasswordCheckbox.checked) {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}
</script>
</body>
</html>