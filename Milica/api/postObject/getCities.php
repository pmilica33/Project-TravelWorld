<?php
require_once "../../connect.php";
$response["cities"] = array();
$response['countries'] = array();
$query = 'SELECT name , country FROM country';

$result = $connect->query($query);
while ($row = $result->fetch_assoc()) {
    array_push($response["cities"], $row["name"]);
    array_push($response["countries"],  $row['country']);
}


echo json_encode($response);
