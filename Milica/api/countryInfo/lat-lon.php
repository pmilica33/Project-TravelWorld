<?php
$response = array();

require_once "../../connect.php";
$id = $_POST['idCountry'];
$lat = $_POST['lat'];
$lon = $_POST['lon'];

$result = $connect->query("select case when lat IS NULL OR lat = ''
then 'true' 
else 'false' 
end as lat
from country
where id='$id'");

$row = $result->fetch_assoc();
$isEmpty = $row['lat'];
$response["isEmpty"] = $isEmpty;
if ($isEmpty === "true") {
    $query = "UPDATE `country` SET `lat`='$lat',`lon`='$lon' WHERE id = '$id'";
    $result = $connect->query($query);
    $response["Lat"] = "Update";
} else {
    $response["Lat"] = "AlreadyExist";
}

echo json_encode($response);
