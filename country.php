<?php
include "connect.php";
session_start();
$idUser = $_SESSION['id'];
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/btn.css" rel="stylesheet">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        .index-top-nav {
            background-color: rgba(0, 0, 0, 0);
            transform: translateY(15px);
        }

        .index-top-nav {
            background-color: rgba(0, 0, 0, 0);
            transform: translateY(15px);
        }

        .navbar {
            transition: all .3s;
        }

        @media only screen and (min-width: 991px) {
            .index-top-nav .nav-link {
                color: white !important;
            }
        }

        .fas {
            margin: 0 !important
        }
    </style>


</head>

<body class="country">
    <nav id="nav-animate" class="navbar navbar-expand-lg fixed-top index-top-nav" style="height: 87px;">
        <a class="navbar-brand" href="index.php"><img id="logo-image" class="your-img" src="images/logo1-white.png" style="max-width: 200px;" alt="logo" /></a>
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





    <!-- All -->

    <div id="card" style="margin-top:-90px"></div>
    </div>



    <!-- Commments -->

    <div class="container mt-5">
        <div class="commentSection">
            <div class="leaveComment">Leave your comment</div>
            <textarea id="comment" class="form-control mb-3" rows="5"></textarea>
            <button onclick="ajaxComment()" style="font-size:12px" class="btn btn-success">Post comment</button>
        </div>
    </div>

    <div id="oneComment" class="container"></div>



    <div id="map" class=" w-100" style="min-height: 420px; position: relative;">
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

    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/country.js"></script>

    <script>
        var idCountry = <?php echo $_GET['id'] ?>;
        var idUser = <?php echo  $_SESSION['id'] ?>;
    </script>

    <script src="https://kit.fontawesome.com/5bd43f344d.js" crossorigin="anonymous"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.nice-select.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAo02Rm1NHpilr14FznugYtEapEcwMyg-I&callback=initMap">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        const nav = $('#nav-animate');

        $(window).scroll(function() {
            if ($(document).scrollTop() == 0 && window.innerWidth > 992) {
                nav.addClass('index-top-nav')
                nav.removeClass('white-nav');
                $('#logo-image').attr('src', 'images/logo1-white.png');
            } else {
                $('#logo-image').attr('src', 'images/logo1.png');
                nav.removeClass('index-top-nav');
                nav.addClass('white-nav');
            }
        });
    </script>


</body>

</html>