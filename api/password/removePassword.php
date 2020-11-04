<?php

require_once '../../connect.php';
$password = $_POST['password'];
$passwordAgain = $_POST['repeatPassword'];

$response = array();
$email = $_POST['email'];

if (!empty($password) && $passwordAgain == $password) {
    $password = sha1($password);
    $upit = $connect->prepare("UPDATE user SET password=? WHERE email=?");
    $upit->bind_param("ss", $password,   $email);
    $upit->execute();
    $upit->close();
    $response['successChange'] = 1;
    $response['password'] = $password;
    echo json_encode($response);
} else {
    $response['successChange'] = 0;

    echo json_encode($response);
}
