

<?php
$response = array();
require_once "../../connect.php";
session_start();
$idUser = $_SESSION['id'];

$query = "SELECT id FROM hotels WHERE owner = $idUser ";

$result = $connect->query($query);

while ($row = $result->fetch_assoc()) {
    $idHotel = $row['id'];
    $result1 =  $connect->query("UPDATE `reservation` SET Notification = 1 WHERE idHotel = $idHotel and approved='Canceled'");
    if ($result1) {
        $response['success'] = 1;
    } else {
        $response['success'] = 0;
    }
}



echo json_encode($response);
