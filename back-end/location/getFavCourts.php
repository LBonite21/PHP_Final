<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function getFavCourts($dbConn) {

    $query = "SELECT JSON_OBJECT(
        'id', c.id,
        'name', c.court_name,
        'latitude',  c.lat,
        'longitude', c.lng) as FavoriteCourts
        FROM  FavoriteCourt c;";

    return @mysqli_query($dbConn, $query);
}
$json = formatRecords(getFavCourts($dbConn));
if(!str_starts_with($json, "[")) {
    $json = json_encode(json_decode("[".formatRecords(getFavCourts($dbConn))."]"));
}connClose($dbConn);

echo $json;
?>
