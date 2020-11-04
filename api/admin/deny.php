<?php
include "../../connect.php";

$id = $_POST['id'];
$response = array();
$response["id"] = $id;


$sql0 = "Select image,image2,image3,image4 FROM hotels  WHERE id ='$id'";
$result0 = $connect->query($sql0)->fetch_assoc();
$image = $result0['image'];
$image2 = $result0['image2'];
$image3 = $result0['image3'];
$image4 = $result0['image4'];
$path = 'C:\/xampp\/htdocs\/Milica\/images\/objectsImages\/';
$response["img1"] = $result0['image'];
$response["img2"] = $result0['image2'];
$response["empty"] = empty($image);




if (!empty($image)) {
    unlink($path . $image);
}
if (!empty($image2)) {
    unlink($path . $image2);
}
if (!empty($image3)) {
    unlink($path . $image3);
}
if (!empty($image4)) {
    unlink($path . $image4);
}





$sql = "DELETE FROM hotels  WHERE id ='$id'";
$result = $connect->query($sql);

if ($result) {
    $response["success"] = 1;
    $response["message"] = "Successfuly deleted";

    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "Unsuccessfuly deleted";

    echo json_encode($response);
}
