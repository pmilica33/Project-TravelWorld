<?php
$response = array();
require_once "../../connect.php";
$idHotel = $_POST['id'];


$query = "update hotels set  pending = 0 where id = '$idHotel'";

$result = $connect->query($query);
if ($result) {
    $response['success'] = 1;
} else {
    $response['success'] = 0;
}

echo json_encode($response);
