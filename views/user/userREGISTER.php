<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' https: 'unsafe-inline' 'unsafe-eval'; worker-src 'self' blob:; script-src 'self' https://api.mapbox.com 'unsafe-inline' 'unsafe-eval'; style-src 'self' https://api.mapbox.com 'unsafe-inline'; img-src 'self' data: https://api.mapbox.com; connect-src 'self' https://api.mapbox.com">
    <title>Register</title>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(45deg, #343a40, #1a1a1a);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .background {
            width: 100vw;
            height: 100vh;
            position: fixed;
            z-index: -1;
            overflow: hidden;
        }

        .laptop-shape {
            position: absolute;
            width: 400px;
            height: auto;
            opacity: 0.3;
            filter: brightness(150%);
        }

        .first-shape {
            left: -100px;
            top: -100px;
            transform: rotate(15deg);
            filter: hue-rotate(190deg) brightness(150%);
        }

        .second-shape {
            right: -75px;
            bottom: -60px;
            width: 350px;
            transform: rotate(-15deg);
            filter: hue-rotate(120deg) brightness(150%);
        }

        .registration-container {
            width: 100%;
            max-width: 600px;
            background-color: rgba(255, 255, 255, 0.13);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 30px 25px;
            z-index: 2;
        }

        .registration-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .registration-form label {
            display: block;
            margin-bottom: 10px;
            color: #ffffff;
            font-size: 16px;
        }

        .registration-form input {
            display: block;
            height: 40px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            color: #ffffff;
            padding: 0 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 3px;
            font-size: 14px;
            font-weight: 300;
        }

        .registration-form button {
            grid-column: 1 / -1;
            width: 100%;
            margin-top: 20px;
            background-color: #007bff;
            color: #ffffff;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .registration-form button:hover {
            background-color: #0056b3;
        }

        h3 {
            grid-column: 1 / -1;
            color: #ffffff;
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .registration-form {
                grid-template-columns: 1fr;
            }
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        #map {
            height: 400px;
            width: 100%;
        }

        .current-location-btn {
            margin-top: 10px;
            background-color: #28a745;
            color: #ffffff;
            padding: 10px 15px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .current-location-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="background">
        <img src="../../assets/images/no-bg-images/laptop1.png" class="laptop-shape first-shape" alt="laptop">
        <img src="../../assets/images/no-bg-images/laptop2.png" class="laptop-shape second-shape" alt="laptop">
    </div>
    
    <div class="registration-container">
        <h3>Create Account</h3>
        <form method="POST" class="registration-form">
            <div class="form-group">
                <label for="username"><i class="fas fa-user"></i> Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="first_name"><i class="fas fa-user"></i> First Name</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name"><i class="fas fa-user"></i> Last Name</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div class="form-group">
                <label for="phone_number"><i class="fas fa-phone"></i> Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" pattern="[0-9]{10}" required>
            </div>
            <div class="form-group">
                <label for="location"><i class="fas fa-map-marker-alt"></i> Location</label>
                <input type="text" id="location" name="location" required readonly>
                <button type="button" onclick="openModal()">Select Location</button>
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
            </div>
            <div class="form-group">
                <label for="confirmpassword"><i class="fas fa-lock"></i> Confirm Password</label>
                <input type="password" id="confirmpassword" name="confirmpassword" required>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>

    <div id="locationModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Select Location</h2>
            <div id="map"></div>
        </div>
    </div>

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=pk.eyJ1IjoiaGFydm5pZ3oiLCJhIjoiY200N2QyMDE5MDQ5NDJ2cHRibGU2eHlwYyJ9.2GSazj6m341Hskil0d35JQ&libraries=places"></script>
    <script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiaGFydm5pZ3oiLCJhIjoiY200N2QyMDE5MDQ5NDJ2cHRibGU2eHlwYyJ9.2GSazj6m341Hskil0d35JQ';

    document.querySelector('form').addEventListener('submit', function(e) {
        if(document.getElementById('password').value != 
           document.getElementById('confirmpassword').value) {
            alert('Passwords do not match');
            e.preventDefault();
        }
    });

    var map;
    var marker;

    function openModal() {
        document.getElementById('locationModal').style.display = 'flex';
        setTimeout(initMap, 100); // Initialize map after modal is displayed
    }

    function closeModal() {
        document.getElementById('locationModal').style.display = 'none';
    }

    function initMap() {
        map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [0, 0],
            zoom: 2
        });

        // Improved GeolocateControl with error handling
        const geolocate = new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true,
                timeout: 6000
            },
            trackUserLocation: true,
            showUserLocation: true,
            showAccuracyCircle: true
        });

        map.addControl(geolocate);

        // Handle geolocation errors
        geolocate.on('error', (e) => {
            console.error('Geolocation error:', e.error);
            if (e.error.code === 1) { // PERMISSION_DENIED
                alert('Please enable location permissions in your browser settings to use this feature.');
            } else if (e.error.code === 2) { // POSITION_UNAVAILABLE
                alert('Location information is unavailable. Please check your device settings.');
            } else if (e.error.code === 3) { // TIMEOUT
                alert('The request to get user location timed out.');
            }
        });

        // Trigger geolocation on map load
        map.on('load', () => {
            if (window.location.protocol !== 'https:') {
                console.warn('Geolocation requires HTTPS to work on mobile devices');
            }
            geolocate.trigger();
        });

        // Rest of your existing map click handling code...
        map.on('click', function(e) {
            var lngLat = e.lngLat;
            
            if (marker) {
                marker.remove();
            }
            
            marker = new mapboxgl.Marker()
                .setLngLat(lngLat)
                .addTo(map);

            // Reverse geocode the coordinates to get place name
            fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${lngLat.lng},${lngLat.lat}.json?access_token=${mapboxgl.accessToken}`)
                .then(response => response.json())
                .then(data => {
                    if (data.features && data.features.length > 0) {
                        // Get the place name and set it as the input value
                        var placeName = data.features[0].place_name;
                        document.getElementById('location').value = placeName;
                    }
                });
        });
    }

    // Update setCurrentLocation function to include reverse geocoding
    function setCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                
                map.setCenter([lng, lat]);
                map.setZoom(13);
                
                if (marker) {
                    marker.remove();
                }
                
                marker = new mapboxgl.Marker()
                    .setLngLat([lng, lat])
                    .addTo(map);

                // Reverse geocode current location
                fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?access_token=${mapboxgl.accessToken}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.features && data.features.length > 0) {
                            var placeName = data.features[0].place_name;
                            document.getElementById('location').value = placeName;
                        }
                    });
            });
        }
    }

    // Request location access on page load
    window.onload = function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                document.getElementById('location').value = lat + ', ' + lng;
            }, function(error) {
                console.error(error);
            }, {
                enableHighAccuracy: true
            });
        }
    };
    </script>
</body>
</html>