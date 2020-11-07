<?php
$response = array();
require_once "../../connect.php";
$email = $_POST['email'];


$query = "SELECT * FROM reservation where email like '$email' ORDER BY checkOut DESC";

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
    $reservation["notification"] = $row["Notification"];
    $reservation["approved"] = $row["approved"];
    $reservation["price"] = $row["finallyPrice"];


    $idhotel = $row["idHotel"];

    $query1 = "SELECT hotels.id as hotelId, hotels.stars as stars, hotels.name as hotelName,country.lat as lat,country.lon as lon, country.id as cityId,country.country as country, country.name as cityName, hotels.image, hotels.image2, hotels.image3, hotels.image4  FROM hotels INNER JOIN country ON hotels.idCity = country.id AND hotels.id = $idhotel";

    $result1 = $connect->query($query1);

    $row1 = $result1->fetch_assoc();
    $reservation["hotel"] = $row1["hotelName"];
    $reservation["cityName"] = $row1["cityName"];
    $reservation["cityId"] = $row1["cityId"];
    $reservation["stars"] = $row1["stars"];
    $reservation["country"] = $row1["country"];
    $reservation["lat"] = $row1["lat"];
    $reservation["lon"] = $row1["lon"];
    $reservation["hotelId"] = $row1["hotelId"];
    $reservation['images'] = array();
    array_push($reservation["images"], $row1["image"]);
    array_push($reservation["images"], $row1["image2"]);
    array_push($reservation["images"], $row1["image3"]);
    array_push($reservation["images"], $row1["image4"]);
    array_push($response["reservations"], $reservation);
}
echo json_encode($response);
