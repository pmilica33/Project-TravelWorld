<?php
$response = array();
require_once "../../connect.php";
$idhotel = $_POST['id'];

$query = "SELECT * FROM reservation WHERE idHotel = '$idhotel' and approved like 'Approved'";

$result = $connect->query($query);

$response["reservations"] = array();

while ($row = $result->fetch_assoc()) {

    $reservation = array();
    $reservation["from"] = $row["checkIn"];
    $reservation["to"] = $row["checkOut"];

    // push single product into final response array
    array_push($response["reservations"], $reservation);
}
echo json_encode($response);
