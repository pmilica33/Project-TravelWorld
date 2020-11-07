<?php
include "connect.php";
session_start();
$idUser = $_SESSION['id'];
if ($idUser == 1) {
    header('Location: index.php');
}
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/nav.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style1.css">

    <title>Owner</title>
    <style>
        .table thead th {
            border-bottom: 1px !important;
            border-top: none !important;

        }

        thead tr {
            font-size: 0.9rem;
        }

        tbody tr {
            font-size: 0.85rem;

        }
    </style>
</head>

<body class="body-owner">
    <nav id="nav-animate" class="navbar navbar-expand-lg fixed-top index-top-nav bg-white" style="height: 87px;">

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
                        echo '<a id="ponuda" class="nav-link" href="postHotel.php">Post apartment</a>';
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
        <div style="margin-top:90px" class="ispis"></div>
    </div>
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
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://kit.fontawesome.com/5bd43f344d.js" crossorigin="anonymous"></script>
<script>
    $(function() {
        $.ajax({
            type: "get",
            url: "api/owner/owner.php",
            success: function(response) {
                var data = JSON.parse(response);
                let html = "";
                if (data.hotel.length === 0) {
                    $(".ispis").html('<div class="d-flex flex-column no-pending postHotel" style="cursor:pointer"><div class="no-pending-text">Want to post apartman?</div><div style="width:100px;"><img style="width: 100%;" src="images/apartment-pngrepo-com.png" alt="" srcset=""></div></div>')

                }
                console.log(data.hasHotel)
                if (data.hasHotel == "1") {
                    $(".ispis").html('<div class="d-flex flex-column no-pending postHotel" style="cursor:pointer"><div class="no-pending-text">No reservation</div><div style="width:100px;"><img style="width: 100%;" src="images/reception.svg" alt="" srcset=""></div></div>')

                }
                $(".postHotel").click(function() {
                    window.location.href = "http://localhost/Milica/postHotel.php";
                });
                data.hotel.forEach(element => {
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
                                            <div>Check in</div>
                                            <div class="table-devider"></div>
                                            <div>${element.checkIn}</div>
                                        </div>
                                        <div class="flex-table-item">
                                            <div>Check out</div>
                                            <div class="table-devider"></div>
                                            <div>${element.checkOut}</div>
                                        </div>
                                        <div class="flex-table-item">
                                            <div>Apartment</div>
                                            <div class="table-devider"></div>
                                            <div>${element.hotelName}</div>
                                        </div>
                                    </div>
                                    </div>
                                    </div>`
                    if (element.approved == "Pending") {

                        html += `<div class="mt-2 justify-content-end d-flex">
                                        <button type="button" onclick="deny(${element.resrvationId},this.parentNode.parentNode)" class="btn btn-danger mr-1 rem85">Deny</button>
                                        <button onclick="approw(${element.resrvationId},this.parentNode.parentNode)" type="button" class="btn btn-success rem85">Aprrow</button>
                                    </div>`
                    } else if (element.approved == "Approved") {
                        html += `<div class="mt-2 justify-content-end d-flex">
                                       <span style="color:#024702;font-weight:700">Approved</span>
                                    </div>`
                    } else {
                        html += `<div class="mt-2 justify-content-end d-flex">
                                       <span style="color:red;font-weight:700">Denied</span>
                                    </div>`
                    }

                    html += `</div>`;
                });
                $(".ispis").append(html);
            },
        });



    })



    function deny(id, element) {
        $.ajax({
            type: "post",
            url: "api/owner/deny.php",
            data: {
                id: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data)
                swal({
                        title: 'Success',
                        text: 'Successfuly denied...',
                        icon: 'success',
                        timer: 2000,
                        buttons: false,
                    })
                    .then(() => {
                        location.reload();
                    })
            },
        });
    }

    function approw(id, element) {
        $.ajax({
            type: "post",
            url: "api/owner/approw.php",
            data: {
                id: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data)
                swal({
                        title: 'Success',
                        text: 'Successfuly approved...',
                        icon: 'success',
                        timer: 2000,
                        buttons: false,
                    })
                    .then(() => {
                        location.reload();
                    })

            },
        });

    }
</script>

</html>