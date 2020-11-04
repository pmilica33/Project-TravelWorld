<?php
include "../../connect.php";
session_start();

$id = $_POST['id'];
$response=array();
$idCountry = $_POST['idCountry'];

$sql = "DELETE FROM comment  WHERE id = $id and idCountry ='$idCountry'";
$result = $connect->query($sql);



//$upit1 = "select c.time as time, c.id as idcom, u.id,u.name as user , c.comment as com from comment c,users u where c.id_user=u.id and id_book = '$idBook'";
//$execute1 = $connect->query($upit1);
//echo "Comments:<br>";
//while ($row = $execute1->fetch_assoc()){
//    echo $row['com']." " .$row['time'] ." ". $row['user'] ."&nbsp";
//    if($idUser== $row['id']){
//        $idcom=$row['idcom'];
//        echo "<input type=\"submit\" value='Delete' onclick='deleteComment(".$idcom.")' name='submit'> ";
//    }
//    echo  ' <br>';
//}


if ($result) {

    $response["success"] = 1;
    $response["message"] = "Successfuly deleted";


    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "Unsuccessfuly deleted";

    echo json_encode($response);
}