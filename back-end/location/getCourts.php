<?php
include_once "../dbUtils.php";

function getCourts($lat, $lng) {
    $API_KEY = "AIzaSyD3S5LbcgQu-7Y7zVBbSgTHU_crRbvQ2BQ";
    
    $courts = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$lat.','.$lng.'&keyword=basketballcourt&radius=50000&rankby=prominence&key='.$API_KEY;

    $json_data = file_get_contents($courts);

    $response_data = json_decode($json_data);

    echo json_encode($response_data->results);
}

if (isset($_GET['lat']) && $_GET['lat'] && isset($_GET['lng']) && $_GET['lng']) {
    $lat = sanitizeInput($_GET["lat"]);
    $lng = sanitizeInput($_GET["lng"]);
    $result = getCourts($lat, $lng);
} else {
    echo json_encode(json_decode('{"error": "No latitude or longitude"}'));
}

?>