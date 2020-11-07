<?php
require_once '../../connect.php';
$idCountry = $_POST['idCountry'];
$response = array();
$upit = "SELECT * from comment where idCountry = '$idCountry'";
$result = $connect->query($upit);


$response['comment'] = array();

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $comment = array();
        $comment['id'] = $row["id"];
        $comment['description'] = $row["description"];
        $comment['idUser'] = $row["idUser"];
        $id = $row["idUser"];
        $upit1 = "SELECT name,surname,photo from user where id = '$id'";
        $result1 = $connect->query($upit1);
        $row1 = $result1->fetch_assoc();
        $comment['name'] = $row1['name'];
        $comment['surname'] = $row1['surname'];
        $comment['photo'] = $row1['photo'];
        $comment['idCountry'] = $row["idCountry"];
        $comment['date'] = $row["date"];
        array_push($response['comment'], $comment);
    }
    $response['success'] = 1;
    echo json_encode($response);
} else {
    $response['success'] = 0;
    echo json_encode($response);
}
