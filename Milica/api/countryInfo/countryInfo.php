<?php
$response = array();

require_once "../../connect.php";
$id = $_GET['id'];

$result = $connect->query("SELECT * FROM country WHERE id = '$id'");
$result1 = $connect->query("SELECT * FROM taxi WHERE idCountry = '$id'");

if ($result->num_rows > 0) {

    $taxies=array();

    while ($row1=$result1->fetch_assoc()){
        $taxi=array();
        $taxi['name']=$row1['name'];
        $taxi['number']=$row1['number'];
        array_push($taxies,$taxi);
    }

    $row = $result->fetch_assoc();


    $country = new stdClass();
    $country->id = $row["id"];
    $country->name = $row["name"];
    $country->photo = $row["photo"];
    $country->police = $row["police"];
    $country->roadside = $row["fire"];
    $country->description = $row["description"];
    $country->emergencies = $row["emergencies"];
    $country->country = $row["country"];


    $country->taxies=$taxies;

    $response["country"] = $country;


    echo json_encode($response);

} else {
    $response["message"] = "No found";
    echo json_encode($response);
}
