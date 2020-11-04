<?php
$response = array();
require_once "../../connect.php";

$query = "SELECT user.photo,reservation.id,reservation.name,reservation.checkIn,reservation.checkOut,reservation.email,reservation.name,reservation.surname,reservation.phone,reservation.idHotel
FROM user INNER JOIN reservation ON user.email=reservation.email";

$result = $connect->query($query);

$response["reservations"] = array();

while ($row = $result->fetch_assoc()) {

    $reservation = array();
    $reservation["id"] = $row["id"];
    $reservation["name"] = $row["name"];
    $reservation["surname"] = $row["surname"];
    $reservation["email"] = $row["email"];
    $reservation["phone"] = $row["phone"];
    $reservation["checkIn"] = $row["checkIn"];
    $reservation["checkOut"] = $row["checkOut"];
    $idhotel = $row["idHotel"];
    $reservation["photo"] = $row["photo"];


    $query1 = "SELECT hotels.price as price, hotels.name as hotelName, country.name  as cityName , country.country FROM hotels INNER JOIN country ON hotels.idCity = country.id AND hotels.id = $idhotel";

    $result1 = $connect->query($query1);

    $row1 = $result1->fetch_assoc();
    $reservation["hotel"] = $row1["hotelName"];
    $reservation["price"] = $row1["price"];
    $reservation["cityName"] = $row1["cityName"];
    $reservation["country"] = $row1["country"];



    // push single product into final response array
    array_push($response["reservations"], $reservation);
}
echo json_encode($response);
