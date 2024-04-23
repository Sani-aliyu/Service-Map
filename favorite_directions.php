<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch/dist/style.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-geosearch/dist/geosearch.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <title>ServiceMap</title>
   <style>
      
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
       <p id="searchpara"><i>to your favorite.....</i></p>
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
              <a href="#" class="nav_link sublink">Hospitals</a>
              <a href="#" class="nav_link sublink">Restaurants</a>
              <a href="#" class="nav_link sublink">Gas stations</a>
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

      <div class="mapcon">
        <div id="map">
          
        </div>
    </div>
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

    function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

// Get latitude and longitude from URL parameters
var favoriteLat = parseFloat(getParameterByName('lat'));
var favoriteLng = parseFloat(getParameterByName('lng'));

// Initialize a new map with a default center (will be updated with user's location)
var map = L.map('map').setView([0, 0], 14);

// Add a tile layer (you can choose your preferred provider)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Try to get the user's current location using the Geolocation API
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
        // Update the map center with the user's current location
        map.setView([position.coords.latitude, position.coords.longitude], 14);

        // Add a marker at the user's current location with a popup
        var userMarker = L.marker([position.coords.latitude, position.coords.longitude])
            .bindPopup('Your Location')
            .addTo(map)
            .openPopup();

        // Add a marker at the favorite location with a popup
        var favoriteMarker = L.marker([favoriteLat, favoriteLng])
            .bindPopup('Favorite Location')
            .addTo(map)
            .openPopup();

        // Create a routing control with waypoints
        L.Routing.control({
            waypoints: [
                L.latLng(position.coords.latitude, position.coords.longitude),
                L.latLng(favoriteLat, favoriteLng)
            ],
            routeWhileDragging: true
        }).addTo(map);
    }, function (error) {
        console.error('Error getting user location:', error.message);
    });
} else {
    console.error('Geolocation is not supported by this browser.');
}


    </script>
</body>
</html>