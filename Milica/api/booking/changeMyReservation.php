
<?php

require_once '../../connect.php';
$checkIn = $_POST['checkIn'];
$checkOut = $_POST['checkOut'];
$id = $_POST['id'];

$response = array();


$upit = $connect->prepare("UPDATE reservation set checkIn=?,checkOut=?,approved='Pending', Notification=0 WHERE id=?");
$upit->bind_param("ssi", $checkIn, $checkOut, $id);
$upit->execute();
$upit->close();

if ($upit) {
    $response['successChange'] = 1;
    echo json_encode($response);
} else {
    $response['successChange'] = 0;

    echo json_encode($response);
}
