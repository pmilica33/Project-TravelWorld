<?php
session_start();
require_once '../../connect.php';
$email = $_POST['email'];
$dugme =  $_POST['dugme'];
$response = array();
//prvo da salje na mail random cifru
//provjerava je li postovana ta random cifra
//ako jeste salje mu za novu password
//update password dje je taj email

try {
    $rand = random_int(1000, 9999);
} catch (Exception $e) {
}
$_SESSION['sentCode'] = $rand;
$new = (string)$rand;
$msg = "Hello your code is " . $new;

$msg = wordwrap($msg, 70);

//  email

mail($email, "My subject", $msg);
$response['successSend'] = 1;


$response['sentCode'] = $rand;
echo json_encode($response);
