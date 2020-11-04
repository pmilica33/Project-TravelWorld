<?php
$response = array();

require_once "../../connect.php";
$id = $_POST['idCountry'];

$result = $connect->query("SELECT name FROM country WHERE id = '$id'");
$row=$result->fetch_assoc();
$name=$row['name'];
$response["name"] = $name;

echo json_encode($response);