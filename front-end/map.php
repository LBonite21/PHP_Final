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
                var content = `<p class="info-font-title">${name}</p>
             <p class="info-font-body">Vicinity: ${vin}</p>
             <p class="info-font-body">Rating: ${rating}</p>
             <a href="/front-end/">Home</a>
             `;
                infowindow.setContent(content);
                infowindow.open(map, marker);
            }
        })(marker));

    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMjeysXDI0PhnFpUtplTd75RLojAFEI9k&callback=init_Map"></script>
<?php include "footer.php" ?>