<?php
include "../../connect.php";
session_start();
$response = array();

$idCountry = $_POST['idCountry'];
$comment = $_POST['comment'];
$idUser = $_SESSION['id'];

date_default_timezone_set('Europe/Podgorica');
$time = date('Y-m-d h:i:s a', time());


if (!empty($_POST['comment'])) {

    $upit = "INSERT INTO comment (description, idUser, idCountry, date) VALUES ('$comment','$idUser','$idCountry','$time')";
    $execute = $connect->query($upit);

    $response['success'] = 1;


} else {
    $response['success'] = 0;
}
echo json_encode($response);

?>