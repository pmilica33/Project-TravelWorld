<?php
require_once "../../connect.php";

$response = array();

if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
if (isset($_POST['idHotel'])) {
    $idHotel = $_POST['idHotel'];
}
if (isset($_POST['surname'])) {
    $surname = $_POST['surname'];
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
}
if (isset($_POST['checkIn'])) {
    $checkIn = $_POST['checkIn'];
}
if (isset($_POST['checkOut'])) {
    $checkOut = $_POST['checkOut'];
}

if (isset($_POST['price'])) {
    $price = $_POST['price'];
}
$isOk = true;

if (empty($name)) {
    $isOk = false;
}

if (empty($idHotel)) {
    $isOk = false;
}

if (empty($surname)) {
    $isOk = false;
}

if (empty($email)) {
    $isOk = false;
}

if (empty($phone)) {
    $isOk = false;
}

if (empty($checkIn)) {
    $isOk = false;
}

if (empty($checkOut)) {
    $isOk = false;
}

if ($isOk) {


    $upit = $connect->prepare("INSERT INTO reservation (idHotel, name, surname, email, phone, checkIn,checkOut,finallyPrice) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
    $upit->bind_param("sssssssi", $idHotel, $name, $surname, $email, $phone, $checkIn, $checkOut, $price);
    $upit->execute();
    $msg = "Hello, " . $name . " " . $surname . " your reservation  " . $checkIn . " is success. We are waiting you!";

    $msg = wordwrap($msg, 70);

    mail($email, "TravelWorld.com", $msg);
    $upit->close();
    $response['success'] = 1;
} else {
    $response['success'] = 0;
}

echo json_encode($response);
