<?php
include "../../connect.php";

$id = $_POST['id'];
$response = array();
$response["id"] = $id;

$sql0 = "Select photo FROM country  WHERE id ='$id'";
$result0 = $connect->query($sql0)->fetch_assoc();
$photo = $result0['photo'];

$path = 'C:\/xampp\/htdocs\/Milica\/images\/countryImages\/';
unlink($path . $photo);





$sql = "DELETE FROM country  WHERE id ='$id'";
$result = $connect->query($sql);

$sql1 = "DELETE FROM hotels  WHERE idCity ='$id'";
$result1 = $connect->query($sql);



if ($result) {
    $response["success"] = 1;
    $response["message"] = "Successfuly deleted";

    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "Unsuccessfuly deleted";

    echo json_encode($response);
}
