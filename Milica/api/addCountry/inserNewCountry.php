<?php
require_once "../../connect.php";


$response = array();

$photo = htmlspecialchars(basename($_FILES["file"]["name"]));
$target_dir = 'C:\/xampp\/htdocs\/Milica\/images\/countryImages\/';
$target_file = $target_dir . basename($_FILES["file"]["name"]);
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);


if (isset($_POST['nameD'])) {
    $name = $_POST['nameD'];
}
if (isset($_POST['descriptionD'])) {
    $description = $_POST['descriptionD'];
}
if (isset($_POST['country'])) {
    $country = $_POST['country'];
}




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


if ($isOk) {

    $upit1 = $connect->query("UPDATE country SET photo='$photo', description='$description', finished=1  WHERE id =$id");


    if ($upit1) {
        $response['success'] = 1;
    } else {
        $response['success'] = 0;
    }

    // $upitMax = "select max(id) as id,name as city from country";
    // $res = $connect->query($upitMax)->fetch_assoc();
    // $id = $res['id'];
    // $response['id'] = $id;
    // $response['name'] = $res['city'];


    for ($i = 0; $i < count($taxiNames); $i++) {

        $upitTaxi = $connect->query("INSERT INTO taxi (name, number, idCountry) VALUES ('$taxiNames[$i]', $taxiNumbers[$i], $id)");
    }
} else {
    $response['success'] = 0;
}

echo json_encode($response);
