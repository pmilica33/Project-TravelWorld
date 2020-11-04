<?php
require_once "../../connect.php";

$response = array();
if (isset($_POST['location'])) {
    $location = $_POST['location'];
}

if (isset($_POST['stars'])) {
    $stars = $_POST['stars'];
}
if (isset($_POST['adults'])) {
    $adults = $_POST['adults'];
}

$query = "SELECT DISTINCT h.*
    FROM hotels h
    INNER JOIN country c
    ON h.idCity = c.id ";

$hasLocation = false;
$hasOneCheckedStar = true;

if (!empty($location)) {
    $query .= "WHERE (c.name LIKE '$location%' or c.country like '$location%' or h.street like '$location%')";
    $hasLocation = true;
}


if (in_array("0", $stars) === false) {
    for ($i = 0; $i < sizeof($stars); $i++) {
        if ($hasLocation) {
            if ($hasOneCheckedStar) {
                $query .= " AND (h.stars LIKE '$stars[$i]'"; // (
                $hasOneCheckedStar = false;
            } else {
                $query .= " OR h.stars LIKE '$stars[$i]'";
            }
        } else {
            if ($hasOneCheckedStar) {
                $query .= "WHERE (h.stars LIKE '$stars[$i]'";
                $hasOneCheckedStar = false;
            } else {
                $query .= " OR h.stars LIKE '$stars[$i]'";
            }
        }
    }
    $query .= ')';
}



if ($adults != 0) {
    $query .= " AND ADULTS >= '$adults'";
}
$response['query'] = $query;

$result = $connect->query($query);

$response["hotels"] = array();
while ($row = $result->fetch_assoc()) {

    $hotels = array();
    $hotels["id"] = $row["id"];
    $hotels["name"] = $row["name"];

    $hotels["images"] = array();

    array_push($hotels["images"], $row["image"]);
    array_push($hotels["images"], $row["image2"]);
    array_push($hotels["images"], $row["image3"]);
    array_push($hotels["images"], $row["image4"]);


    $hotels["idCity"] = $row["idCity"];
    $hotels["description"] = $row["description"];
    $hotels["price"] = $row["price"];
    $hotels["stars"] = $row["stars"];
    $hotels["pending"] = $row["pending"];
    $hotels["street"] = $row["street"];
    $hotels["country"] = $row["country"];



    array_push($response["hotels"], $hotels);
}
echo json_encode($response);
