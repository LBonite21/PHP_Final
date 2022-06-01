<?php
include "header.php";
?>
<title>Hoops</title>
</head>
<?php include 'nav.php' ?>

<body>
    <div class="container">
        <div class="row justify-content-center my-4">
            <h2>Favorite Courts</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <!-- <p>As an Admin, you have the ability to add or remove any one of these categories from the users' eyes through the buttons on the home and category pages.</p> -->
                <ul id="favCourts">

                </ul>
            </div>
        </div>
    </div>
    
</body>

<script>

    const getFavCourts = () => {
        fetch("../back-end/location/getFavCourts.php")
        .then(res => res.json())
        .then(data => {
            const catList = document.getElementById("favCourts");
            data.forEach(court => {
                catList.innerHTML += `<li>${court.name}</li>`
            });
        });
    }
 getFavCourts();
</script>

<?php include "footer.php" ?>