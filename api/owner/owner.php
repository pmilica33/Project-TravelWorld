<?php
$response = array();
require_once "../../connect.php";
session_start();
$idUser = $_SESSION['id'];


$query = "SELECT reservation.Notification,reservation.approved, user.photo,reservation.id as resrvationId, reservation.idHotel,reservation.name, reservation.surname,reservation.email,reservation.phone,reservation.checkIn,reservation.checkOut, hotels.name as hotelName
FROM reservation INNER JOIN hotels ON hotels.id = reservation.idHotel and hotels.owner='$idUser'
 INNER JOIN user ON user.email = reservation.email order by approved desc";

$result = $connect->query($query);

$response["hotel"] = array();


while ($row = $result->fetch_assoc()) {
    $hotel = array();
    $hotel["idOwner"] = $idUser;
    $hotel["hotelName"] = $row["hotelName"];
    $hotel["approved"] = $row["approved"];
    $hotel["checkOut"] = $row["checkOut"];
    $hotel["checkIn"] = $row["checkIn"];
    $hotel["phone"] = $row["phone"];
    $hotel["email"] = $row["email"];
    $hotel["name"] = $row["name"];
    $hotel["surname"] = $row["surname"];
    $hotel["idHotel"] = $row["idHotel"];
    $hotel["resrvationId"] = $row["resrvationId"];
    $hotel["notification"] = $row["Notification"];
    $hotel["photo"] = $row["photo"];
    array_push($response["hotel"], $hotel);
}
$query1 = "SELECT * from hotels where owner='$idUser'";

if ($connect->query($query)->num_rows == 0) {
    if ($connect->query($query1)->num_rows > 0) {
        $response["hasHotel"] = 1;
    }
}



echo json_encode($response);
