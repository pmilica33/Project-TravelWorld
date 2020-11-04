<?php
require_once "../../connect.php";

$response = array();
$query = "SELECT * FROM hotels where pending = 1";

$result = $connect->query($query);

$response["hotel"] = array();



while ($row = $result->fetch_assoc()) {

    $hotel = array();
    $hotel["id"] = $row["id"];
    $hotel["name"] = $row["name"];
    $hotel["country"] = $row["country"];
    $hotel["street"] = $row["street"];



    $hotel["idCity"] = $row["idCity"];

    $hotel["description"] = $row["description"];
    $hotel["image"] = $row["image"];
    $hotel["stars"] = $row["stars"];
    $hotel["adults"] = $row["adults"];
    $hotel["price"] = $row["price"];
    $hotel["city"] = $row["city"];
    $hotel["web"] = $row["web"];
    $hotel["phone"] = $row["phone"];
    $hotel["image2"] = $row["image2"];
    $hotel["image3"] = $row["image3"];
    $hotel["image4"] = $row["image4"];



    $hotel["wifi"] = $row["wifi"];
    $hotel["parking"] = $row["parking"];
    $hotel["bazen"] = $row["bazen"];
    $hotel["cafe"] = $row["cafe"];
    $hotel["spa"] = $row["spa"];
    $hotel["dorucak"] = $row["dorucak"];
    $hotel["balkon"] = $row["balkon"];
    $hotel["teretana"] = $row["teretana"];
    $hotel["owner"] = $row["owner"];
    $hotel["lat"] = $row["lat"];
    $hotel["lon"] = $row["lon"];


    array_push($response["hotel"], $hotel);
}

$response['success'] = 1;

echo json_encode($response);
