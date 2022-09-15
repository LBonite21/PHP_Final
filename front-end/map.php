<?php
include "header.php";
$lat = $_GET['lat'];
$lng = $_GET['lng'];
?>
<title>Hoops</title>
</head>
<?php include 'nav.php' ?>

<body class="bg-color">
    <div class="container">
        <div class="row justify-content-center mt-4">
            <h1 class="p-3">Basketball Courts Near You!</h1>
            <div id="map"></div>

            <h2>Set Your Favorite Court!</h2>
            <div class="container">
                <form id="favCourtForm" method="POST" action="/" onsubmit="favoriteCourt(); return false;">
                    <div class="form-group">
                        <label for="courtName" class="form-control-label">Court Name: </label>
                        <input class="form-control" type="text" name="courtName" placeholder="Court Name" id="courtName" />
                    </div>
                    <div class="form-group">
                        <label for="location" class="form-control-label">Location: </label>
                        <input class="form-control" type="text" name="location" placeholder="Location" id="location" />
                    </div>
                    <div class="form-group">
                        <button type="submit" id="favBtn" class="btn btn-primary">Favorite</button>
                        <p id="success" class="text-success"></p>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>

<script>
    let map;
    let myMarker;
    let myInfoWindow;

    const init_Map = () => {

        if (<?php echo $lat ?>) {
            // Map Options and New Map
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: <?php echo $lat ?>,
                    lng: <?php echo $lng ?>
                },
                zoom: 12,
            });

            // Add marker
            myMarker = new google.maps.Marker({
                position: {
                    lat: <?php echo $lat ?>,
                    lng: <?php echo $lng ?>
                },
                map: map,
                icon: './images/myPin.png'
            });

            myInfoWindow = new google.maps.InfoWindow({
                content: '<h4>You Are Here</h4>'
            });

            myMarker.addListener('click', function() {
                myInfoWindow.open(map, myMarker);
            });

            // Get courts
            getCourts(<?php echo $lat ?>, <?php echo $lng ?>);

        } else {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 42.3601,
                    lng: -71.0589
                },
                zoom: 8,
            });
        }
    }

    window.init_Map = init_Map;

    const getCourts = async (lat, lng) => {
        await fetch("../back-end/location/getCourts.php?lat=<?php echo $_GET["lat"] ?>&lng=<?php echo $_GET["lng"] ?>")
            .then(res => res.json())
            .then(data => {
                console.log(data);
                data.forEach(court => {
                    addMarker(court.geometry.location.lat, court.geometry.location.lng, court.name, court.vicinity, court.rating);
                    // console.log(court.geometry.location.lat, court.geometry.location.lng, court.name, court.vicinity, court.rating);
                });
            });
    }

    let marker;
    let infoWindow;

    const addMarker = (lat, lng, name, vin, rating) => {
        marker = new google.maps.Marker({
            position: {
                lat: lat,
                lng: lng
            },
            map: map,
            icon: './images/pin.png'
        });

        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(marker, 'click', (function(marker) {
            return function() {
                var content = `
                <p class="info-font-title">${name}</p>
                <p class="info-font-body">Location: ${vin}</p>
                <p class="info-font-body">Rating: ${rating}</p>
             `;


                infowindow.setContent(content);
                infowindow.open(map, marker);
            }
        })(marker));

    }

    const favoriteCourt = () => {
        fetch('../back-end/location/createFavoriteCourt.php', {
                body: new URLSearchParams(new FormData(document.getElementById("favCourtForm"))).toString(),
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                method: "post"
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('success').innerHTML = "Saved Court";
                console.log(data);
            });

    }

    const favBtn = document.getElementById('favBtn');

    favBtn.addEventListener('click', function handleClick(evt) {

        favoriteCourt();
        evt.preventDefault();

        const courtNameInput = document.getElementById('courtName');
        const locationInput = document.getElementById('location');

        courtNameInput.value = '';
        locationInput.value = '';


    });

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3S5LbcgQu-7Y7zVBbSgTHU_crRbvQ2BQ&callback=init_Map"></script>
<?php include "footer.php" ?>