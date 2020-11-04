<?php
include "../../connect.php";

$id = $_POST['id'];
$response = array();
$response["id"] = $id;



$sql = "Update  reservation set  `approved` ='Deny' where id=$id";
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
