<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function createCourt($dbConn, $name, $location) {

    $queryInsert = "INSERT INTO FavoriteCourt(
                            court_name";
    $queryValues= "Values (
                    \"".$name."\"";
    if($location != null) {
        $queryInsert .= ", location";
        $queryValues .= ", \"".$location."\"";
    }
    $queryInsert .= ") ";
    $queryValues .= ") ";
    $result = @mysqli_query($dbConn, $queryInsert.$queryValues);

    return $result? $result : @mysqli_error($dbConn);
}

if (isset($_POST['courtName'])) {
    $name = sanitizeInput($_POST['courtName']);
    $location = isset($_POST['location']) && $_POST['location'] ? sanitizeInput($_POST['location']) : null;

    $result = createCourt($dbConn, $name, $location);
    connClose($dbConn);
} else {
    echo json_encode(json_decode('{"error": "Invalid info"}'));
}

?>