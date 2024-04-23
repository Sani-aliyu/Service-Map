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

    $email = $_POST['Email'];
    $plainPassword = $_POST['Password'];

    // Query the database to check credentials
    $sql = "SELECT user_id, email, password FROM user WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ss", $email, $plainPassword);
    
    // Execute the query
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($user_id, $resultEmail, $resultPassword);

    // Fetch the result
    $stmt->fetch();

    if ($resultEmail && $resultPassword === $plainPassword) {
        // Correct credentials, start a session with user_id
        $_SESSION['user_id'] = $user_id;
        header('Location: home.php'); // Redirect to the home page
        exit;
    } else {
        // Incorrect credentials, show an error message
        echo '<script>alert("Invalid email or password. Please try again.");</script>';
    }

    $stmt->close();
    $conn->close();
}
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
                    <li><a href="#" onclick="scrollToFooter()">About</a></li>
                    <li><a href="#" onclick="scrollToFooter()">Services</a></li>
                    <li><a href="#" onclick="scrollToFooter()">Contact</a></li>
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
 <div class="main">
    <div class="container">
        <div class="box box1">
            <p> Dear Service Explorers,
                We're thrilled to welcome you to a whole new dimension of exploration and discovery! At [ServiceMap, we believe that every journey,
                 whether it's around the corner or across continents, should be an adventure filled with excitement and convenience.
                Imagine a world where finding your way is not just a task but a delightful experience. 
                A world where hidden treasures and local gems are unveiled with just a tap. That's precisely what ServiceMap brings to your fingertips.</p>
        </div>

        <?php if (isset($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

        <div class="box box2">
           <div class="wrapper">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="Post">
      <h2>Login</h2>
        <div class="input-field">
        <input type="text" name="Email" required>
        <label>Enter your email</label>
      </div>
      <div class="input-field">
        <input type="password" name="Password" id="password"  required>
        <label> Enter Password</label>
      </div>
      <input type="checkbox" id="show-password-checkbox" onclick="togglePasswordVisibility()"  style="transform: scale(1.0);">show password</input>

      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Remember me</p>
        </label>
        <br>
        <a href="#">Forgot password?</a>
      </div>
      <button type="submit" value="submit">Log In</button>
      <div class="register">
        <p>Don't have an account? <a href="register.php">Register</a></p>
    
      </div>
    </form>
    
  </div>
        </div>
    </div>
    <div class="card-list">
        <a href="#" class="card-item">
            <img src="images/nearbyplaces.png" alt="Card Image">
            <span class="nearby">Discover Local Gems</span>
            <h3>Uncover hidden gems, popular hotspots, and everything in between.
                ServiceMap allows you to explore nearby places with real-time information at your fingertips.</h3>
            
        </a>
        <a href="#" class="card-item">
            <img src="images/easynav.png" alt="Card Image">
            <span class="easynav">Navigate with Ease</span>
            <h3>Effortlessly find your way through cities, neighborhoods,
                and beyond. Our intuitive navigation system ensures you reach your destination hassle-free.</h3>
            
        </a>
        <a href="#" class="card-item">
            <img src="images/my_favorite_place.jpg" alt="Card Image">
            <span class="favorite">Save Your Favorite Spots</span>
            <h3>Found a place you love? Mark it, save it, and revisit it anytime. 
                Your favorite spots are just a tap away, making it easy to plan your next adventure.
                
               </h3>
            
        </a>
    </div>
 </div>

 <section class="footer">
    <div class="footer-row">
      <div class="footer-col">
        <h4>Info</h4>
        <ul class="links">
          <li><a href="#">About Us</a></li>
          <li><a href="#">Customers</a></li>
          <li><a href="#">Service</a></li>
          <li><a href="#">FAQ</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Explore</h4>
        <ul class="links">
          <li><a href="#">Hotels</a></li>
          <li><a href="#">Hospitals</a></li>
          <li><a href="#">Restaurants</a></li>
          <li><a href="#">Mechanics</a></li>
    
        </ul>
      </div>

      <div class="footer-col">
        <h4>Legal</h4>
        <ul class="links">
          <li><a href="#">Customer Agreement</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Security</a></li>
          <li><a href="#">Testimonials</a></li>
       
        </ul>
      </div>

      <div class="footer-col">
        <h4>Newsletter</h4>
        <p>
          Subscribe to our newsletter for a weekly dose
          of news, updates, helpful tips, and
          exclusive offers.
        </p>
        <form action="#">
          <input type="text" placeholder="Your email" required>
          <button type="submit">SUBSCRIBE</button>
        </form>
        <div class="icons">
          <i class="fa-brands fa-facebook-f"></i>
          <i class="fa-brands fa-twitter"></i>
          <i class="fa-brands fa-linkedin"></i>
          <i class="fa-brands fa-github"></i>
        </div>
      </div>
    </div>
  </section>

    <script src="indexscript.js"></script>
    <script src="script.js"></script>
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

function scrollToFooter() {
    var footer = document.querySelector('footer');
    footer.scrollIntoView({ behavior: 'smooth' });
}
</script>
</body>
</html>