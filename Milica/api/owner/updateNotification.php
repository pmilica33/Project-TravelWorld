
<?php
$response = array();
require_once "../../connect.php";
$email = $_POST['email'];


$query = "update reservation set  Notification = 1 where email like '$email'";

$result = $connect->query($query);
if ($result) {
    $response['success'] = 1;
} else {
    $response['success'] = 0;
}

echo json_encode($response);
