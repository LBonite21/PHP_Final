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
            <h1 class="text-center">Welcome to Hoops! Find a Court Near You!</h1>
        </div>
        <form id="getCurrentLocation" method="POST" action="/" onsubmit="getLocation(); return false;">
            <div class="form-group">
                <label class="label-font" for="address" class="form-control-label">Enter an Address: </label>
                <input class="form-control" type="text" name="address" placeholder="Enter Address" id="address" />
                <span class="error-txt mb-1" id="errorTxt"></span>
            </div>
        </form>
        <img class="row logo-size" src="/front-end/images/logo.png" alt="Logo">
    </div>

</body>

<script>
    const getLocation = async () => {
        await fetch("../back-end/location/geoLocate.php", {
                body: new URLSearchParams(new FormData(document.getElementById("getCurrentLocation"))).toString(),
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                method: "post"
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                if (data.error) {
                    document.getElementById('errorTxt').innerHTML = data.error;
                } else {
                    window.location.replace(`front-end/map.php?lat=${data.lat}&lng=${data.lng}`);
                }
            });
    }

</script>
<?php include "footer.php" ?>