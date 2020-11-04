<?php
include "../../connect.php";
session_start();
$response = array();


$idUser = $_SESSION['id'];

$idReservation = $_POST['idReservation'];
$idHotel = $_POST['idHotel'];

$clean = $_POST['clean'];
$service = $_POST['service'];
$location = $_POST['location'];



$title = $_POST['title'];
$description = $_POST['descriptionD'];





$response['service'] = $service;
$response['location'] = $location;
$response['clean'] = $clean;




date_default_timezone_set('Europe/Podgorica');
$time = date('Y-m-d h:i:s a', time());



$upit = "INSERT INTO review (description, idUser, time, title,clean,service,location,idReservation,idHotel) VALUES ('$description','$idUser','$time','$title','$clean','$service','$location','$idReservation','$idHotel')";
$execute = $connect->query($upit);
if ($execute) {
    $response['success'] = 1;
} else {
    $response['success'] = 0;
}

$response['idHotel'] = $idHotel;


echo json_encode($response);
