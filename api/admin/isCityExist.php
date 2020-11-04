<?php
require_once "../../connect.php";

$city = $_POST['city'];

$query = "SELECT * FROM country where name like '$city' AND finished = 1";

$result = $connect->query($query);

if ($result->num_rows > 0) {
    $response["success"] = 1;
} else {
    $response["success"] = 0;
}
echo json_encode($response);
