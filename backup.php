<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OpenStreetMap Example</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
        }
    </style>
</head>
<body>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map');

        if ('geolocation' in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var userLocation = [position.coords.latitude, position.coords.longitude];

                map.setView(userLocation, 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                L.marker(userLocation).addTo(map)
                    .bindPopup('Your Location')
                    .openPopup();
            }, function (error) {
                console.error('Error getting user location:', error.message);
            });
        } else {
            console.error('Geolocation is not supported by your browser');
        }
    </script>

</body>
</html>
