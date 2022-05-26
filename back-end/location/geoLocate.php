<?php
include_once "../dbUtils.php";

function getLocation($address) {
    // $address = "3428 S 700 E, Salt Lake City, UT";
    $API_KEY = "AIzaSyDMjeysXDI0PhnFpUtplTd75RLojAFEI9k";

    $location = "https://maps.google.com/maps/api/geocode/json?key=".$API_KEY."&address=".str_replace(" ", "+", $address);
    
    //echo $location;
    
    //$api_url = 'http://dummy.restapiexample.com/api/v1/employees';
    
    //// Read JSON file
    $json_data = file_get_contents($location);
    // return $json_data;
    
    //// Decode JSON data into PHP array
    $response_data = json_decode($json_data);
    // echo $json_data;
    
    
    //// All user data exists in 'data' object
    $data = $response_data->results[0];
    // echo $data->geometry->location->lat;
    
    $lat = $data->geometry->location->lat;
    $lng = $data->geometry->location->lng;
    
    if ($lat && $lng) {
        $arr = array(
            'lat' => $lat,
            'lng' => $lng,
            'address' => $address
        );
    } else {
        $arr = array(
            'error' => "Could not find location! Try again. Ex. 123 Main St., City, State"
        );
    }
    // //print_r($user_data);
    echo json_encode($arr);
}

if (isset($_POST['address']) && $_POST['address']) {
    $address = isset($_POST['address']) ? sanitizeInput($_POST['address']) : null;
    $result = getLocation($address);
}

?>
