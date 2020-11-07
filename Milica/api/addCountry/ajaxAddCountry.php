<?php
require_once "../../connect.php";


$response = array();

$photo = htmlspecialchars(basename($_FILES["file"]["name"]));
$target_dir = 'C:\/xampp\/htdocs\/Milica\/images\/countryImages\/';
$target_file = $target_dir . basename($_FILES["file"]["name"]);
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);


if (isset($_POST['nameD']))  $name = $_POST['nameD'];

if (isset($_POST['descriptionD'])) $description = $_POST['descriptionD'];


if (isset($_POST['country'])) $country = $_POST['country'];


$taxiNumbers = json_decode(stripslashes($_POST["taxiNumbers"]));
$taxiNames = json_decode(stripslashes($_POST["taxiNames"]));

$isOk = true;
$isOk = empty($name) ? false : true;
$isOk = empty($description) ? false : true;
$isOk = empty($photo) ? false : true;


$query = "SELECT id FROM country where name like '$name'";
$result = $connect->query($query)->fetch_assoc();

$id = $result['id'];
$response['id'] = $id;
$response['photo'] = $photo;
$response['description'] = $description;
$response['name'] = $name;
$response["continue"] = array();

if ($isOk) {

    if (isset($_POST['newCountry'])) {
        $lat = $_POST['lat'];
        $lon = $_POST['lng'];
        $upit = "INSERT INTO country (name, country, description, lat, lon,finished,photo) VALUES ('$name','$country','$description','$lat','$lon',1,'$photo')";
        $execute = $connect->query($upit);
        $response["continue"] = 0;
        $getID = "SELECT max(id) FROM country";
        $result = $connect->query($query)->fetch_assoc();
        $id = $result['id'];


        $response['success'] = $upit ? 1 : 0;
    }
    if (isset($_POST['mojID'])) {
        $upit1 = $connect->query("UPDATE country SET photo='$photo', description='$description', finished=1  WHERE id =$id");
        $execute = $connect->query($upit1);
        $response["continue"] = 1;

        $response['success'] = $upit1 ? 1 : 0;
    }


    for ($i = 0; $i < count($taxiNames); $i++) {

        $upitTaxi = $connect->query("INSERT INTO taxi (name, number, idCountry) VALUES ('$taxiNames[$i]', $taxiNumbers[$i], $id)");
    }
} else {
    $response['success'] = 0;
}

echo json_encode($response);
