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
  
  
  </head>
  <body>
  
    <!-- navbar -->
    <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        ServiceMap
      </div>

      <div class="search_bar">
       <p id="searchpara"><i>navigate with ease.....</i></p>
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

      <div class="mapcon">
        <div id="map">
          <div id="search-container">
          <input type="text" id="searchInput" placeholder="Search services...." onkeypress="handleKeyPress(event)">
          <button id="addNoteButton" onclick="toggleAddNoteMode()">Add a Note</button>
        </div>
        <!-- Add the following button next to your search box -->
      <!-- Add the following button next to your search box -->
        
        </div>
    </div>

     
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="script.js"></script>
    <script>
function handleKeyPress(event) {
    // Check if the pressed key is 'Enter'
    if (event.key === 'Enter') {
        // Call the searchLocation function when 'Enter' key is pressed
        searchLocation();
    }
}
      
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

// Function to set addNoteMode to true
function switchToAddNoteMode() {
    addNoteMode = true;
    // You can provide user instructions or change UI to indicate note adding mode
    alert('You are now in Add Note mode. Click on the map to add a note.');
}



















// Javascripot for the map
var map = L.map('map').setView([0, 0], 14);
var userMarker;
var routingControl; // Variable to store routing control
var proximityCircle1;
var proximityCircle2;
var addNoteMode = false; // Flag for adding notes

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);


// Attach the click event handler to the map only when addNoteMode is active
function toggleAddNoteMode() {
    // Toggle the addNoteMode variable
    addNoteMode = !addNoteMode;

    // Update the button text based on the mode
    var button = document.getElementById('addNoteButton');
    button.textContent = addNoteMode ? 'Cancel' : 'Add a Note';

    // Check if addNoteMode is active and attach/detach the click event handler accordingly
    if (addNoteMode) {
        map.on('click', handleMapClick);
    } else {
        map.off('click', handleMapClick);
    }
}



// Function to handle map click
var marker
function handleMapClick(e) {
    // Check if Add Note mode is active and if the click is from the map
    if (addNoteMode && e.originalEvent.target === map.getContainer()) {
        // Your code to add a note
        var note = prompt('Enter your note:');
        if (note !== null) {
            // Create a red marker at the clicked location with the note
            var marker = L.marker(e.latlng, { icon: redIcon })
                .bindPopup('<b>Issue: </b>'+ note + '<br><button class="resolve-button">Resolved</button>')
                .addTo(map);
               
            // Send the note, latitude, and longitude to the server
            $.ajax({
                url: 'add_note.php',
                method: 'POST',
                data: {
                    note: note,
                    latitude: e.latlng.lat,
                    longitude: e.latlng.lng
                },
                success: function (response) {
                    if (response.success) {
                        alert('Note added successfully!');
                    } else {
                        alert('Failed to add note. Please try again.');
                    }
                },
                error: function () {
                    alert('Error sending AJAX request.');
                }
            });

            // Add click event for the Resolve button
            marker.on('popupopen', function () {
                document.querySelector('.resolve-button').addEventListener('click', function () {
                    // Handle the Resolve button click
                    alert('Will be updated in a while!');
                    // You can add further logic here, such as updating the note status on the server
                });
            });
        }
    }
}

function resolveNote(note, marker) {
    // Get the latitude and longitude from the marker
    var noteLat = marker.getLatLng().lat;
    var noteLng = marker.getLatLng().lng;

    $.ajax({
        url: 'resolve_note.php', // Update with your PHP script path
        method: 'POST',
        data: {
            latitude: noteLat,
            longitude: noteLng
        },
        success: function (response) {
            if (response.success) {
                alert('Note resolved successfully!');
                // Update the status locally
                note.Status = 1;
                // Close the popup and remove the marker if needed
                map.closePopup();
                map.removeLayer(marker);
            } else {
                alert('Failed to resolve note. Please try again.');
            }
        },
        error: function () {
            alert('Error sending AJAX request.');
        }
    });
}


// Function to display all notes on the map
function displayAllNotes() {
    $.ajax({
    url: 'get_all_notes.php',
    method: 'GET',
    dataType: 'json',
    success: function (response) {
        if (response.success && response.notes.length > 0) {
            response.notes.forEach(function (note) {
                var marker = L.marker([note.latitude, note.longitude], { icon: redIcon })
                    .bindPopup('<b>Issue: </b>' + note.note + '<br><button class="resolve-button">Resolved</button>')
                    .addTo(map);

                marker.on('popupopen', function () {
                    // Use a closure to capture the current note in the loop
                    document.querySelector('.resolve-button').addEventListener('click', function () {
                        resolveNote(note, marker);
                    });
                });
            });
        } else {
            alert('No road issue detected.');
        }
    },
    error: function () {
        alert('Error fetching notes. Please try again.');
    }
});
}






   
// Red marker icon
var redIcon = new L.Icon({
    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
    iconSize: [15, 20],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

// Use watchPosition for continuous location updates
var watchId = navigator.geolocation.watchPosition(onLocationFound, onLocationError, { enableHighAccuracy: true });

function onLocationFound(e) {
    var radius = e.accuracy / 2;
    var userLatLng = [e.coords.latitude, e.coords.longitude];

    if (userMarker) {
        map.removeLayer(userMarker);
    }

    userMarker = L.marker(userLatLng, {
        icon: L.icon({ iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png', iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41] })
    }).addTo(map);

    userMarker.bindPopup("Your Location").openPopup();

    // Remove previous proximity circles if they exist
    if (proximityCircle1) {
        map.removeLayer(proximityCircle1);
    }
    if (proximityCircle2) {
        map.removeLayer(proximityCircle2);
    }

    // Center the map at the user's location
    map.setView(userLatLng, 14);
}

function onLocationError(e) {
    alert(e.message);
}

// Remove the default zoom control
map.zoomControl.remove();

// Add zoom control to the bottom right corner
L.control.zoom({ position: 'bottomright' }).addTo(map);

// Add search control
var searchControl = new L.Control.GeoSearch({
    provider: new L.GeoSearch.Provider.OpenStreetMap(),
    position: 'topright',
    showMarker: true, // hide the marker icon
}).addTo(map);


// Function to handle search button click
function searchLocation() {
    var searchTerm = document.getElementById('searchInput').value;

    // Make an AJAX request to the server-side PHP script for search results
    fetch('search.php?searchTerm=' + searchTerm)
        .then(response => response.json())
        .then(data => {
            // Clear markers
            map.eachLayer(layer => {
                if (layer instanceof L.Marker && layer !== userMarker) {
                    map.removeLayer(layer);
                }
            });

            // Clear routing control if it exists
            if (routingControl) {
                map.removeControl(routingControl);
            }

            // Add new markers for the search results
            data.forEach(location => {
                var hospitalMarker = L.marker([location.latitude, location.longitude])
                    .addTo(map)
                    .bindPopup("<b>Name:</b> " + location.name + "<br>" +
                        "<b>Description:</b> " + location.description + "<br>" +
                        "<b>Opening Hours:</b> " + location.opening_hours + "<br>" +
                        "<button onclick='getDirections(" + location.latitude + "," + location.longitude + ")'>Get Directions</button> | " +
                        "<button onclick='saveToFavorites(" + location.latitude + "," + location.longitude + ")'>Save to Favorites</button>");
            });

            // Re-add the user marker to the map
            userMarker.addTo(map);
            displayAllNotes();
            handleMapClick(e);
            // Add proximity circles after the search
            proximityCircle1 = L.circle(userMarker.getLatLng(), {
                color: 'green',   // Closest
                fillColor: 'green',
                fillOpacity: 0.1,
                radius: 2000
            }).addTo(map);

            proximityCircle2 = L.circle(userMarker.getLatLng(), {
                color: 'orange',   // Farthest
                fillColor: 'orange',
                fillOpacity: 0.1,
                radius: 5000  // You can adjust the radius based on your preference
            }).addTo(map);
        })
        .catch(error => console.error('Error:', error));
        handleMapClick();
        
}


// Function to get directions from user's location to a specific marker
function getDirections(destLat, destLng) {

     // Add proximity circles after the search
     proximityCircle1 = L.circle(userMarker.getLatLng(), {
                color: 'green',   // Closest
                fillColor: 'green',
                fillOpacity: 0.1,
                radius: 2000
            }).addTo(map);

            proximityCircle2 = L.circle(userMarker.getLatLng(), {
                color: 'orange',   // Farthest
                fillColor: 'orange',
                fillOpacity: 0.1,
                radius: 5000  // You can adjust the radius based on your preference
            }).addTo(map);

    // Clear previous routing control
    if (routingControl) {
        map.removeControl(routingControl);
    }

    routingControl = L.Routing.control({
        waypoints: [
            L.latLng(userMarker.getLatLng().lat, userMarker.getLatLng().lng),
            L.latLng(destLat, destLng)
        ],
        routeWhileDragging: true
    }).addTo(map);
    handleMapClick();
}

// Function to set addNoteMode to true
function switchToAddNoteMode() {
    addNoteMode = true;
    // You can provide user instructions or change UI to indicate note adding mode
    // ...
}

// Function to save a location to favorites
function saveToFavorites(lat, lng) {
    // Step 1: Get latitude and longitude
    // (You may already have this part in your existing code)

    // Step 2: Check for matching coordinates
    checkCoordinates(lat, lng);
}

// Function to check coordinates with the server
function checkCoordinates(lat, lng) {
    // AJAX to send coordinates to the server-side PHP script
    $.ajax({
        type: 'GET',
        url: 'check_coordinates.php', // Update with your PHP script path
        data: {
            lat: lat,
            lng: lng
        },
        success: function (response) {
            // Step 3: Copy details to Favorites table if a match is found
            if (response.exists) {
                copyToFavorites(lat, lng);
            } else {
                alert('Location not found in services database.');
            }
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}

// Function to copy details to the Favorites table
function copyToFavorites(lat, lng) {
    // AJAX to copy details to the Favorites table
    $.ajax({
        type: 'POST',
        url: 'copy_to_favorites.php', // Update with your PHP script path
        data: {
            lat: lat,
            lng: lng
        },
        success: function (response) {
            if (response.success) {
                alert('Location saved to Favorites!');
            } else {
                alert('Error saving to Favorites.');
            }
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}
    
</script>
</body>
</html>
