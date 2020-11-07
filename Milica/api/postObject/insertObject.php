<?php
require_once "../../connect.php";
session_start();


$response = array();
$object = new stdClass();

$lat = $_POST['lat'];
$lon = $_POST['lon'];



$name = $_POST['name'];
$stars = $_POST['star'];
$description = $_POST['descriptionD'];
$country = $_POST['country'];
$adress = $_POST['adress'];
$adults = $_POST['adults'];
if (isset($_POST['web'])) {
    $web = $_POST['web'];
    $object->web = $web;
}
$phone = $_POST['phone'];
$price = $_POST['price'];
$city = $_POST['city'];


$object->name = $name;
$object->stars = $stars;
$object->description = $description;
$object->city = $city;
$object->adress = $adress;
$object->adults = $adults;
$object->phone = $phone;
$object->lat = $lat;
$object->lon = $lon;
$object->country = $country;



if (isset($_POST['bazen'])) {
    $bazen = $_POST['bazen'];
    $object->bazen = $bazen;
} else {
    $bazen = "";
}
if (isset($_POST['parking'])) {
    $parking = $_POST['parking'];
    $object->parking = $parking;
} else {
    $parking = "";
}
if (isset($_POST['cafe'])) {
    $cafe = $_POST['cafe'];
    $object->cafe = $cafe;
} else {
    $cafe = "";
}
if (isset($_POST['dorucak'])) {
    $dorucak = $_POST['dorucak'];
    $object->dorucak = $dorucak;
} else {
    $dorucak = "";
}
if (isset($_POST['balkon'])) {
    $balkon = $_POST['balkon'];
    $object->balkon = $balkon;
} else {
    $balkon = "";
}
if (isset($_POST['spa'])) {
    $spa = $_POST['spa'];
    $object->spa = $spa;
} else {
    $spa = "";
}
if (isset($_POST['teretana'])) {
    $teretana = $_POST['teretana'];
    $object->teretana = $teretana;
} else {
    $teretana = "";
}
if (isset($_POST['wifi'])) {
    $wifi = $_POST['wifi'];
    $object->wifi = $wifi;
} else {
    $wifi = "";
}

foreach ($_FILES as $key => $value) {

    $target_dir = 'C:\/xampp\/htdocs\/Milica\/images\/objectsImages\/';
    $target_file = $target_dir . basename($_FILES["$key"]["name"]);
    // move_uploaded_file($_FILES["$key"]["tmp_name"], $target_file);
    $object->slikajeli = move_uploaded_file($_FILES["$key"]["tmp_name"], $target_file);
}


$isOk = true;

$isOk = empty($name) ? false : true;
$isOk = empty($description) ? false : true;
$isOk = empty($city) ? false : true;
$isOk = empty($stars) ? false : true;
$isOk = empty($adress) ? false : true;
$isOk = empty($adults) ? false : true;
$isOk = empty($phone) ? false : true;
$isOk = empty($price) ? false : true;

$object->de = empty($description);
$object->ci = empty($city);
$object->st = empty($stars);
$object->ad = empty($adress);
$object->adlt = empty($adults);
$object->ph = empty($phone);
$object->pr = empty($price);
$object->nm = empty($name);






//nadji ID city
//id owner
$query = "SELECT id FROM `country` WHERE name like '$city'";
$result = $connect->query($query);

if ($result->num_rows == 0) {
    $query1 = "INSERT INTO country (name, finished, lat, lon,country) VALUES ('$city', 0, '$lat', '$lon','$country')";
    $connect->query($query1);
}



$query = "SELECT id FROM `country` WHERE name like '$city'";
$result = $connect->query($query);



$row = $result->fetch_assoc();
$idCity = $row['id'];
$object->idCity = $idCity;






$owner = $_SESSION['id'];
$object->owner = $owner;




if (isset($_FILES['slika1']["name"])) {
    $image = htmlspecialchars(basename($_FILES["slika1"]["name"]));
}
if (isset($_FILES['slika2']["name"])) {
    $image2 = htmlspecialchars(basename($_FILES["slika2"]["name"]));
}
if (isset($_FILES['slika3']["name"])) {
    $image3 = htmlspecialchars(basename($_FILES["slika3"]["name"]));
}
if (isset($_FILES['slika4']["name"])) {
    $image4 = htmlspecialchars(basename($_FILES["slika4"]["name"]));
}


$object->image = $image;
$object->image2 = $image2;
$object->image3 = $image3;
$object->image4 = $image4;




if ($isOk) {


    $upit = "INSERT INTO hotels (name, idCity, image, phone, image2,image3,image4,balkon,wifi,parking,bazen,dorucak,spa,teretana, cafe, description,stars,adults,price ,city,web,owner,lat,lon, street, pending,country) 
    VALUES ('$name', '$idCity', '$image','$phone', '$image2', '$image3', '$image4', '$balkon', '$wifi', '$parking', '$bazen', '$dorucak', '$spa', '$teretana', '$cafe', '$description', '$stars', '$adults', '$price', '$city', '$web','$owner','$lat','$lon','$adress', 1,'$country')";

    $execute = $connect->query($upit);



    if ($execute) {
        $response['objekat'] = $object;

        $response['success'] = 1;
    } else {

        $response['objekat'] = 'nije ok';

        $response['success'] = 0;
    }
} else {
    $response['success'] = 0;
}
$response['object'] = $object;
echo json_encode($response);
return;
