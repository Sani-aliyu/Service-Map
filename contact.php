<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// ... (rest of your page code)

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
       <p id="searchpara"><i>Get in touch with us.....</i></p>
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
          <div class="content">
            <div class="left-side">
              <div class="address details">
                <i class="fas fa-map-marker-alt"></i>
                <div class="topic">Address</div>
                <div class="text-one">Lapaz, N12</div>
                <div class="text-two">Osu RE</div>
              </div>
              <div class="phone details">
                <i class="fas fa-phone-alt"></i>
                <div class="topic">Phone</div>
                <div class="text-one">+233 552 014 256</div>
                <div class="text-two">+233 571 236 526</div>
              </div>
              <div class="email details">
                <i class="fas fa-envelope"></i>
                <div class="topic">Email</div>
                <div class="text-one">contact.servicemap@gmail.com</div>
                <div class="text-two">info.ServiceMAp@gmail.com</div>
              </div>
            </div>
            <div class="right-side">
              <p>For any enquires or suggestions send us message from here. Thank you!</p>
              <form action="send.php" method="post">
    <div class="input-box">
        <input type="text" name="name" placeholder="Enter your name" />
    </div>
    <div class="input-box">
        <input type="email" name="email" placeholder="Enter your email" />
    </div>
    <div class="input-box message-box">
        <textarea name="message" placeholder="Enter your message"></textarea>
    </div>
    <button type="submit" name="send">Send message</button>
</form>

            </div>
          </div>
        </div>
    </div>

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
</script>
  </body>
</html>

















































































