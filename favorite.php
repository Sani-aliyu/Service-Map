<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

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

// Get user_id from the session (you should have started the session)
$user_id = $_SESSION['user_id'];

// Query the favorites table for the specific user
$sql = "SELECT * FROM favorites WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Close the database connections
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>ServiceMap</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="indexstyle.css"/>
    <style>
    table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        ServiceMap
      </div>

      <div class="search_bar">
       <p id="searchpara"><i>Your Favorites.....</i></p>
      </div>


      <div class="navbar_content">
        <i class="bi bi-grid"></i>
        <i class='bx bx-sun' id="darkLight"></i>
        <div id="notification-icon">
    <img src="not.jpg" alt="Notification Icon" width="30" height="30" onclick="NottoggleDropdown()">
    <div id="notification-dropdown">
        <div id="notification-dropdown-content">
            No new notifications
        </div>
    </div>
</div>
        <img src="user.jpg" alt="" class="profile" onclick="toggleDropdown()">

        <div class="profile-dropdown" id="profileDropdown">
        <a href="profile.php">Profile Update</a>
        <a href="logout.php">Logout</a>
        </div>

      </div>
    </nav>

     <!-- sidebar -->
     <nav class="sidebar">
      <div class="menu_content">
        <ul class="menu_items">
          <div class="menu_title menu_dahsboard"></div>
          <!-- duplicate or remove this li tag if you want to add or remove navlink with submenu -->
          <!-- start -->
          <li class="item">
            <a href="home.php" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-home-alt"></i>
              </span>
              <span class="navlink">Home</span>
          </li>
        </a>
          <!-- end -->

          <!-- start -->
          <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-grid-alt"></i>
              </span>
              <span class="navlink">Available Services</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <ul class="menu_items submenu">
              <a href="#" class="nav_link sublink" style="font-size: 90%;">Hospitals</a>
              <a href="#" class="nav_link sublink" style="font-size: 90%;">Gas stations</a>
              <a href="#" class="nav_link sublink" style="font-size: 90%;">transportation</a>
              <a href="#" class="nav_link sublink" style="font-size: 90%;">Hotel</a>
              <a href="#" class="nav_link sublink" style="font-size: 90%;">restaurant</a>
              <a href="#" class="nav_link sublink" style="font-size: 90%;">local attractions</a>
            </ul>
          </li>
      
            <a href="favorite.php" class="nav_link">
              <span class="navlink_icon">
                <i class='bx bxs-bookmarks'></i>
              </span>
              <span class="navlink">favorites</span>
            </a>
          </li>

          <li class="item">
            <a href="upload.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-cloud-upload"></i>
              </span>
              <span class="navlink">Upload new</span>
            </a>
          </li>
          <li class="item">
            <a href="contact.php" class="nav_link">
              <span class="navlink_icon">
                <i class='bx bx-message-square'></i>
              </span>
              <span class="navlink">message us</span>
            </a>
          </li>
        </ul>
        

        <!-- Sidebar Open / Close -->
        <div class="bottom_content">
          <div class="bottom expand_sidebar">
            <span> Expand</span>
            <i class='bx bx-log-in' ></i>
          </div>
          <div class="bottom collapse_sidebar">
            <span> Collapse</span>
            <i class='bx bx-log-out'></i>
          </div>
        </div>
      </div>
    </nav>

    <div class="message">
      <div class="container">
    <table>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Category</th>
        <th>Opening Hours</th>
        <th>Actions</th>
    </tr>

    <?php
    // Loop through each row in the result set
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['category'] . "</td>";
        echo "<td>" . $row['opening_hours'] . "</td>";
        echo "<td>
                <button onclick='getDirections(" . $row['latitude'] . "," . $row['longitude'] . ")'>Get Directions</button>
                <button onclick='deleteFavorite({$row['fav_id']})'>Delete</button>
              </td>";
        echo "</tr>";
    }
    ?>

</table>

        </div>
    </div>

    
    <!-- JavaScript -->

    <script src="script.js"></script>
    <script>

function NottoggleDropdown() {
        var dropdown = document.getElementById("notification-dropdown");
        dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('#notification-icon img')) {
            var dropdown = document.getElementById("notification-dropdown");
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            }
        }
    };
    
    function toggleDropdown() {
  var profileDropdown = document.getElementById("profileDropdown");
  profileDropdown.style.display = (profileDropdown.style.display === "block") ? "none" : "block";
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.profile')) {
      var dropdowns = document.getElementsByClassName("profile-dropdown");
      for (var i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.style.display === "block") {
              openDropdown.style.display = "none";
          }
      }
  }
}


        // JavaScript function to handle Get Directions
        function getDirections(latitude, longitude) {
            // Redirect to home.php with latitude and longitude as parameters
            window.location.href = 'favorite_directions.php?lat=' + latitude + '&lng=' + longitude;
            

        }

        // JavaScript function to handle Delete
         function deleteFavorite(favId) {
        // Send an AJAX request to delete.php with the fav_id parameter
        // Adjust the URL accordingly based on your file structure
        fetch(`delete.php?fav_id=${favId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload the page or update the table after successful deletion
                    location.reload();
                } else {
                    alert('Error deleting favorite');
                }
            })
            .catch(error => console.error('Error:', error));
    }
   

</script>
</body>
</html>
