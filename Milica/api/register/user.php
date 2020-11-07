<?php
include "../../connect.php";
session_start();
//if (isset($_SESSION['username'])) {
//    header('Location: index.php');
//}
$response = array();
$user = new stdClass();
$name = $surname = $email = $password = $username = $repeatPassword = $slikaErr = "";

if (!empty($_POST['name'])) {
    $name = $_POST['name'];
    $response['warningName'] = "true";
    $provjera1 = true;
    $user->name = $name;
} else {
    $response['warningName'] = "false";
    $response['nameEmpty'] = "Polje ime je  prazno!";

    $provjera1 = false;
}


if (!empty($_POST['surname'])) {
    $response['warningSurname'] = "true";
    $surname = $_POST['surname'];
    $provjera2 = true;
    $user->surname = $surname;
} else {
    $response['warningSurname'] = "false";
    $response['surnameEmpty'] = "Polje prezime je prazno!";

    $provjera2 = false;
}


if (!empty($_POST['username'])) {

    $username = $_POST['username'];

    $query = "SELECT * FROM user WHERE username='$username' ";
    $execute = $connect->query($query);
    if ($execute->num_rows > 0) {
        $response['warningUsername'] = "false";
        $response['usernameReserved'] = "1";


        $provjera5 = false;
    } else {
        $response['warningUsername'] = "true";
        $response['usernameReserved'] = "0";
        // Zasto ne moze da vrati prazno

        $provjera5 = true;
        $user->username = $username;
    }
} else {
    $response['warningUsername'] = "false";
    $response['usernameEmpty'] = "Polje username je prazano!";
    $response['usernameReserved'] = "0";


    $provjera5 = false;
}



if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $email = $_POST['email'];
    $query1 = "SELECT * FROM user WHERE email like '$email'"; //uvjek like koristi za email!!!
    $execute1 = $connect->query($query1);
    if ($execute1->num_rows > 0) {
        $response['warningEmail'] = "false";
        $provjera6 = false;
        $response['emailReserved'] = "1";
    } else {
        $response['warningEmail'] = "true";
        $response['emailReserved'] = "0";
        $user->email = $email;
        $provjera6 = true;
    }
} else {
    $response['emailEmpty'] = "Polje email je  prazano!";
    $response['warningEmail'] = "false";
    $response['emailReserved'] = "0";
    $provjera6 = false;
}

if (!empty($_POST['password']  && strlen($_POST['password'])) >= 4) {
    $password = $_POST['password'];
    $response['warningPassword'] = "true";
    $provjera7 = true;
} else {
    $response['warningPassword'] = "false";
    $provjera7 = false;
    $response['passwordEmpty'] = "Polje sifra je  prazano!";
}

if (!empty($_POST['repeatPassword']) && $_POST['repeatPassword'] == $password) {
    $repeatPassword = $_POST['repeatPassword'];
    $response['warningRepeatPassword'] = "true";
    $provjera8 = true;
    $user->password = $repeatPassword;
} else {
    $response['warningRepeatPassword'] = "false";
    $provjera8 = false;
    $response['passwordRepeatEmpty'] = "Ponovi sifru!";
}



$photo = htmlspecialchars(basename($_FILES["file"]["name"]));
$target_dir = 'C:\/xampp\/htdocs\/Milica\/images\/users\/';
$target_file = $target_dir . basename($_FILES["file"]["name"]);
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

$user->photo = $photo;

if ($provjera8) {
    if ($provjera7) {
        if ($provjera6) {
            if ($provjera1) {
                if ($provjera2) {
                    if ($provjera5) {
                        $password = sha1($password);

                        $upit = $connect->prepare("INSERT INTO user (name, surname, email, password, username, photo) VALUES (?, ?, ?, ?, ?, ?)");
                        $upit->bind_param("ssssss", $name, $surname, $email, $password, $username, $photo);
                        $upit->execute();
                        $upit->close();
                        $response['success'] = 1;
                        $response['user'] = $user;

                        echo json_encode($response);
                        return;
                    }
                }
            }
        }
    }
}

$response['success'] = 0;

echo json_encode($response);
