<?php
include "connect.php";
session_start();
$idUser = $_SESSION['id'];
if ($idUser != 1)  header('Location: index.php');
if (!isset($_SESSION['username']))  header('Location: login.php');
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/style1.css">
    <style>
        body,
        .flex-table-bg {
            background-color: snow;
        }

        .responsive-table-img {
            background-color: white;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 2px 0px 5px -1px rgba(201, 195, 195, 1);
        }

        .flex-table-row>div {
            background-color: white;
        }
    </style>
</head>

<body onload="load()">
    <nav id="nav-animate" class="navbar navbar-expand-lg fixed-top bg-white" style="height: 87px;">

        <a class="navbar-brand" href="index.php"><img id="logo-image" class="your-img" src="images/logo1.png" alt="logo" /></a>

        <button id="toggle-hamburger" class="navbar-toggler my-2 ml-auto" tycustom data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <div id="nav-icon1">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>

        <div class="conatiner-fluid w-100">
            <div class="collapse navbar-collapse justify-content-between" id="navbarTogglerDemo03" style="height: 65px;">
                <ul class="navbar-nav ml-auto mt-4 mt-lg-0">
                    <li class="nav-item nav-item-bottom">
                        <a id="pocetna" class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item nav-item-bottom">
                        <a id="ponuda" class="nav-link" href="booking.php">Apartments</a>
                    </li>
                    <?php
                    if ($idUser == 1) {
                        echo '<li class="nav-item nav-item-bottom">';
                        echo '<a class="nav-link" href="admin.php">Reservations</a>';
                        echo '</li>';
                    } else {
                        echo '<li class="nav-item nav-item-bottom">';
                        echo '<a class="nav-link" href="myReservation.php">My Resevations</a>';
                        echo '</li>';
                    }
                    if ($idUser == 1) {
                        echo '<li class="nav-item nav-item-bottom">';
                        echo '<a class="nav-link" href="dashboard.php">Dashboard</a>';
                        echo '</li>';
                    } else {
                        echo '<li class="nav-item nav-item-bottom">';
                        echo '<a id="pocetna" class="nav-link" href="owner.php">Owner</a>';
                        echo '</li>';
                        echo '<li class="nav-item nav-item-bottom">';
                        echo '<a id="ponuda" class="nav-link" href="postHotel.php">Post Apartmant</a>';
                        echo '</li>';
                    }
                    ?>


                    <li class="nav-item nav-item-bottom">
                        <a id="ponuda" class="nav-link mr-3" href="logout.php">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="w-85 mx-auto">
        <div style="margin-top:90px" id="here"></div>
    </div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script>
    function load() {
        $.ajax({
            type: 'GET',
            url: 'api/booking/readReservations.php',

            success: function(response) {
                var data = JSON.parse(response);
                var reservations = data.reservations;
                console.log(reservations);

                var html = '';


                reservations.forEach(element => {
                    console.log(element)
                    html += `<div class="flex-table-bg">
                                    <div class="d-flex responsive-table-img">
                                    <img class="img-round-table" src='images/users/${element.photo}'>
                                    <div class="border-gap">
                                    <div class="flex-table-row">
                                        <div class="flex-table-item">
                                            <div>Name</div>
                                            <div class="table-devider"></div>
                                            <div>${element.name} ${element.surname}</div>
                                        </div>
                                        <div class="flex-table-item">
                                            <div>Email</div>
                                            <div class="table-devider"></div>
                                            <div>${element.email}</div>
                                        </div>
                                        <div class="flex-table-item">
                                            <div>Phone</div>
                                            <div class="table-devider"></div>
                                            <div>${element.phone}</div>
                                        </div>
                                        <div class="flex-table-item">
                                            <div>Location</div>
                                            <div class="table-devider"></div>
                                            <div>${element.cityName}, ${element.country}</div>
                                        </div>
                                        <div class="flex-table-item">
                                            <div>Check in / Check out</div>
                                            <div class="table-devider"></div>
                                            <div>${element.checkIn} / ${element.checkOut}</div>
                                        </div>
                                        
                                        <div class="flex-table-item">
                                            <div>Apartment</div>
                                            <div class="table-devider"></div>
                                            <div>${element.hotel}</div>
                                        </div>
                                    </div>
                                    </div>
                                    </div>`
                    html += `</div>`;
                });
                $("#here").append(html);
            }
        });
    }
</script>
<script src="https://kit.fontawesome.com/5bd43f344d.js" crossorigin="anonymous"></script>
<footer class="py-2 bg-dark">
    <div class="container">
        <div class="footer">
            <div class="copyright">© Copyright 2020. Milica Pejović</div>
            <div class="icon-tab">
                <p class="mr-2 mt-3">Follow us on</p>
                <a class="icon-button" href="https://www.facebook.com"><i class="fa fa-facebook"></i></a>
                <a class="icon-button" href="https://www.instagram.com"><i class="fa fa-instagram"></i></a>
                <a class="icon-button" href="https://www.twitter.com"><i class="fa fa-twitter"></i></a>
            </div>
        </div>
    </div>
</footer>

</html>