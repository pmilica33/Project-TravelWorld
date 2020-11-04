<?php
$response = array();
require_once "../../connect.php";

$idHotel = $_POST['id'];



$query = "SELECT * FROM hotels where id like '$idHotel'";

$result = $connect->query($query);

$response["hotel"] = array();




while ($row = $result->fetch_assoc()) {

    $hotel = array();
    $idHotel = $row["id"];
    $hotel["id"] = $row["id"];
    $hotel["name"] = $row["name"];
    $idCity = $row["idCity"];
    $hotel["idCity"] = $row["idCity"];
    $hotel["description"] = $row["description"];
    $hotel["image"] = $row["image"];
    $hotel["stars"] = $row["stars"];
    $hotel["adults"] = $row["adults"];
    $hotel["price"] = $row["price"];
    $hotel["currency"] = $row["currency"];
    $hotel["street"] = $row["street"];
    $hotel["web"] = $row["web"];
    $hotel["phone"] = $row["phone"];
    $hotel["image2"] = $row["image2"];
    $hotel["image3"] = $row["image3"];
    $hotel["image4"] = $row["image4"];
    $hotel["city"] = $row["city"];
    $hotel["country"] = $row["country"];



    $hotel["wifi"] = $row["wifi"];
    $hotel["parking"] = $row["parking"];
    $hotel["bazen"] = $row["bazen"];
    $hotel["cafe"] = $row["cafe"];
    $hotel["spa"] = $row["spa"];
    $hotel["dorucak"] = $row["dorucak"];
    $hotel["balkon"] = $row["balkon"];
    $hotel["teretana"] = $row["teretana"];
    $hotel["owner"] = $row["owner"];
    $hotel["lat"] = $row["lat"];
    $hotel["lon"] = $row["lon"];



    $review = array();
    $response['review'] = array();

    $query1 = "SELECT user.photo as photo, review.id as reviewId, review.idReservation as idReservation,review.idUser as idUser,review.description as reviewDescription,review.title as reviewTitle,review.clean as clean, review.service as service,review.location as location,review.time as time, user.name as nameUser, user.surname as surname
FROM (review INNER JOIN user ON user.id = review.idUser and review.idHotel='$idHotel')";

    $result1 = $connect->query($query1);
    while ($row1 = $result1->fetch_assoc()) {
        $review["reviewId"] = $row1["reviewId"];
        $review["idReservation"] = $row1["idReservation"];
        $review["idUser"] = $row1["idUser"];
        $review["reviewDescription"] = $row1["reviewDescription"];
        $review["reviewTitle"] = $row1["reviewTitle"];
        $review["clean"] = $row1["clean"];
        $review["service"] = $row1["service"];
        $review["location"] = $row1["location"];
        $review["time"] = $row1["time"];
        $review["nameUser"] = $row1["nameUser"];
        $review["surname"] = $row1["surname"];
        $review["photo"] = $row1["photo"];
        array_push($response["review"], $review);
    }
}


// push single product into final response array
array_push($response["hotel"], $hotel);

echo json_encode($response);
