<?php
$response = array();

$search = $_POST['search'];
$response['hshs'] = $search;
require_once "../../connect.php";
if (!empty($search)) {
    $query = "SELECT * FROM country c
     WHERE (name like '$search%' or country like '$search%')";
} else {
    $query = 'SELECT * FROM country';
}
$result = $connect->query($query);

//if($result->num_rows>0){
$response["countries"] = array();

while ($row = $result->fetch_assoc()) {

    $country = array();
    $country["id"] = $row["id"];
    $country["name"] = $row["name"];
    $country["photo"] = $row["photo"];
    $country["police"] = $row["police"];
    $country["fire"] = $row["fire"];
    $country["description"] = $row["description"];
    $country["country"] = $row["country"];
    $country["finished"] = $row["finished"];

    // push single product into final response array
    array_push($response["countries"], $country);
}
echo json_encode($response);

//}else{
//    $response["message"] = "No found";
//    echo json_encode($response);
//}
