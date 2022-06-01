<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function createCourt($dbConn, $name, $lat, $lng) {

    $queryInsert = "INSERT INTO FavoriteCourt(
                            court_name";
    $queryValues= "Values (
                    \"".$name."\"";
    if($lat != null) {
        $queryInsert .= ", lat";
        $queryValues .= ", \"".$lat."\"";
    }
    if($lng != null) {
        $queryInsert .= ", lng";
        $queryValues .= ", \"".$lng."\"";
    }
    $queryInsert .= ") ";
    $queryValues .= ") ";
    $result = @mysqli_query($dbConn, $queryInsert.$queryValues);

    return $result? $result : @mysqli_error($dbConn);
}

if (isset($_POST['courtName'])) {
    $name = sanitizeInput($_POST['courtName']);
    $lat = isset($_POST['lat']) && $_POST['lat'] ? sanitizeInput($_POST['lat']) : null;
    $lng = isset($_POST['lng']) && $_POST['lng'] ? sanitizeInput($_POST['lng']) : null;

    $result = createCourt($dbConn, $name, $lat, $lng);
    connClose($dbConn);
} else {
    echo json_encode(json_decode('{"error": "Invalid info"}'));
}

?>