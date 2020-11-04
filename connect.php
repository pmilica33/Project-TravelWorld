<?php
$servername = 'localhost';
$user = 'root';
$password = '';
$base = 'api';



$connect=new mysqli($servername,$user,$password,$base);
if($connect->connect_error){
    echo "Unsuccessful!".$connect->connect_error;
}

?>