<?php
require_once '../../connect.php';
session_start();
$response=array();

$code=$_POST['code'];
$sentCode=$_SESSION['sentCode'];
$response['code']=$code;
$response['sentCode']=$sentCode;

if($code ==$sentCode){
    $response['successSame']=1;
    echo json_encode($response);

}else{
    $response['successSame']=0;
    echo json_encode($response);

}