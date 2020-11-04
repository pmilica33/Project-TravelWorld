<?php
require_once '../../connect.php';
$response = array();
session_start();

if (isset($_POST['username'])) {
    $username = $_POST['username'];
}

if (isset($_POST['password'])) {
    $password = $_POST['password'];
    $password = sha1($password);
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

if (isset($_SESSION['password'])) {
    $password = $_SESSION['password'];
}

$query = "SELECT * FROM user WHERE username like '$username'";
$execute = $connect->query($query);

if ($execute->num_rows > 0) {
    date_default_timezone_set('Europe/Podgorica');
    $time = date('m/d/Y h:i:s a', time());
    $response['login'] = array();
    while ($row = $execute->fetch_assoc()) {
        if ($row['password'] == $password) {
            $user = array();
            $user['user'] = $username;
            $user['password'] = $password;
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;

            $_SESSION['id'] = $row['id'];
            $user['time'] = $time;
            $user['name'] = $row['name'];
            $user['surname'] = $row['surname'];
            $user['email'] = $row['email'];

            array_push($response['login'], $user);
            $response['success'] = 1;
        } else {
            $response['success'] = 0;
        }
    }
    echo json_encode($response);
} else {
    $response['success'] = "drugi";
    echo json_encode($response);
}
