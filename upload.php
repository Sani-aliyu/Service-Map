<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle the case when the user is not logged in
    header('Location: index.php');
    exit;
}

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
    <link rel="stylesheet" href="indexstyle.css" />

    
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        ServiceMap
      </div>

      <div class="search_bar">
       <p id="searchpara"><i>Add new service.....</i></p>
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

    <div class="regcon">
      <div class="wrapper">
      <form action="services.php" method="POST"id="upload form">
 
 <div class="input-field">
   <input type="text" id="name" name="name"  maxlength="50" required>
   <label>service center name</label>
 </div>
 
   <div class="input-field">
     <input type="text" id="description" name ="description" maxlength="225" required>
   <label>Description</label>
 </div>

 <div class="input-field">
     <input type="text" id="opening_hours" name ="opening_hours" maxlength="100" required>
   <label>Opening hours</label>
 </div>
<!-- Category -->
<div class="input-field">
  
<select id="category" name="category" required>
    <option value="hospital">Hospital</option>
    <option value="gas station">Gas station</option>
</select>
<label for="category">Category:</label>
</div>

<br>



 <br>
 <p>Hit the Generate button to automatically obtain coordinates</p>
 <hr>
 <br>
       <div class="input-field">
        <input type="number" id="latitude" name="latitude" step="0.000001" maxlength="50" required>
        <label>latitude</label>
      </div>
 
      <div class="input-field">
        <input type="number" id="longitude" name="longitude" step="0.000001" maxlength="50" required>
        <label>Longitude</label>
      </div>
      
     
         <button value="Generate" onclick="getCurrentLocation()">Generate</button>
         <br>
         <button type="submit" onclick="locationSuccess()">Submit</button>
        </form>
    </div>
    </div>
    
    <!-- JavaScript -->
    <script src="script.js"></script>
    <script>

      function locationSuccess() {
        alert("Service location added successfully");
      }
      function getCurrentLocation() {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(
                  function(position) {
                      // Update the longitude and latitude fields
                      document.getElementById('longitude').value = position.coords.longitude;
                      document.getElementById('latitude').value = position.coords.latitude;
                  },
                  function(error) {
                      console.error("Error getting geolocation:", error);
                      alert("Error getting geolocation. Please enter manually.");
                  }
              );
          } else {
              alert("Geolocation is not supported by your browser. Please enter manually.");
          }
      }

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
      </script>

  </body>
</html>
