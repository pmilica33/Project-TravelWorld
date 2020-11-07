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
    <title>Document</title>
    <link href="css/stars.css" rel="stylesheet">
    </link>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style1.css" rel="stylesheet">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/select-2-custom.css">
    <link rel="stylesheet" href="css/nav.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        @media screen and (max-width: 1200px) {
            .bg-white {
                width: 60% !important;
            }
        }

        @media screen and (max-width: 992px) {
            .bg-white {
                width: 80% !important;
            }
        }

        @media screen and (max-width: 768px) {
            .bg-white {
                width: 90% !important;
            }
        }

        @media screen and (max-width: 576px) {
            .bg-white {
                width: 100% !important;
            }
        }

        .form-label {
            color: #2b5d8f !important;
            font-weight: 600 !important;
        }

        .nice-select {
            width: 100% !important
        }

        .nice-select ul {
            width: 100% !important
        }

        .nice-select,
        .select2-selection--single {
            background-color: #f7f9fa !important;
            font-size: 16px !important;
            font-weight: 500 !important;
            color: rgba(24, 45, 91, 0.4) !important;
            box-shadow: inset 0 1px 4px rgba(181, 193, 204, 0.3);
        }

        .nice-select li {
            text-align: center !important;
        }

        .nice-select ul {
            color: gray !important;
        }

        .nice-select span {
            text-align: left !important;
            color: rgba(24, 45, 91, 0.4) !important;
            font-size: 16px !important;
            font-weight: 700 !important;

        }

        .stars {
            transform: translateX(1%);
        }

        .span-star {
            margin-left: 19px;
        }

        .stars label {
            width: 28px !important;
        }

        .pogodnosti {
            background-color: #f7f9fa;
            height: 20%;
            width: 100%;
            display: grid;
            grid-column-gap: 20px;
            /* grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); */
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            padding: 20px;
            margin-bottom: 10%;

        }

        .pogodnosti>div {
            display: flex;
            height: 100%;
            width: max-content;
            align-items: center;
            padding-right: 20px;

        }

        .pogodnosti>div>input {
            margin-right: 15px;
        }
    </style>

</head>

<body style="background-color: whitesmoke;">
    <nav id="nav-animate" class="navbar navbar-expand-lg fixed-top index-top-nav bg-white" style="height: 87px;">

        <a class="navbar-brand" href="index.php"><img id="logo-image" class="your-img" src="images/logo1.png" style="max-width: 200px;" alt="logo" /></a>

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
                        echo '<a id="ponuda" class="nav-link" href="postHotel.php">Post Apartment</a>';
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
    <div class="header-img"></div>
    <div class="justify-content-center d-flex">
        <div class="bg-white p-4" style="margin-top:-12% ;width:50%">
            <form id="postObject-form" class="" enctype="multipart/form-data">
                <div class="form-header mb-3 mt-3 text-center mb-4">
                    <h2 style="text-transform:inherit;font-weight: 600;">Post your apartment on our website</h2>
                </div>
                <hr class="mb-5">
                <div class="col-lg-12">
                    <div class="row flex-row-reverse nameStars">
                        <div class="col-lg-6 d-flex stars_small flex-column">
                            <div class="form-label span-star">Stars</div>
                            <div class="d-flex ">
                                <div class="stars flex-row-reverse d-flex justify-content-end col-lg-12" style="width: 100% !important;">
                                    <input type="radio" name="star" id="star5" value="5" class="star"><label for="star5"></label>
                                    <input type="radio" name="star" id="star4" value="4" class="star"><label for="star4"></label>
                                    <input type="radio" name="star" id="star3" value="3" class="star"><label for="star3"></label>
                                    <input type="radio" name="star" id="star2" value="2" class="star"><label for="star2"></label>
                                    <input type="radio" name="star" id="star1" value="1" class="star"><label for="star1"></label>
                                </div>
                                <img data-toggle="tooltip" data-placement="right" data-placement="bottom" title="Hooray!" src="./images/196760.png" width="20px" height="20px" id="warningStars" style="display: none" class="warning war-stars ml-2">
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-md-12">
                            <span class="form-label">Name of apartment</span>
                            <div class="d-flex align-items-center">
                                <input class="form-control col-lg-11" onkeyup="nameH()" id="name" name="name" type="text">
                                <img data-toggle="tooltip" data-placement="right" data-placement="bottom" title="Hooray!" src="./images/196760.png" width="20px" height="20px" id="warningName" style="display: none" class="warning war-name ml-2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="form-label">Description of your apartment</span>
                        <div class="d-flex">
                            <textarea onkeyup="descritpionF()" name="descriptionD" class="form-control col-lg-12" rows="6" id="description"></textarea>
                            <img data-toggle="tooltip" data-placement="right" data-placement="bottom" title="Hooray!" src="./images/196760.png" width="20px" height="20px" id="warningDesc" style="display: none" class="warning war-desc ml-2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group ">
                                <div class="form-label ">Choose country</div>
                                <div class="d-flex">
                                    <select name="country" onchange="getLatLon(this);citySelect()" id="country" class="col-lg-11  js-example-basic-single"></select>
                                    <img data-toggle="tooltip" data-placement="right" data-placement="bottom" title="Hooray!" src="./images/196760.png" width="20px" height="20px" id="warningCity" style="display: none" class="warning war-city ml-2">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group ">

                                <span class="form-label ">Adress of your apartment </span>
                                <div class="d-flex">
                                    <input class="form-control col-lg-12 gcse-search" id="adress" name="adress" enableAutoComplete="true" disabled>
                                    <img data-toggle="tooltip" data-placement="right" data-placement="bottom" title="Hooray!" src="./images/196760.png" width="20px" height="20px" id="warningAdress" style="display: none" class="warning war-adress ml-2">

                                </div>
                            </div>
                        </div>

                    </div>

                    <div id="map" class="mt-5 mb-4 w-100" style="min-height: 420px; position: relative;display:none"></div>

                    <div class="form-group ">
                        <span class="form-label">Price </span>
                        <div class="d-flex">
                            <input onkeypress="return /[0-9+ -/]/i.test(event.key)" onkeyup="priceP()" class="form-control col-lg-12" id="price" name="price">
                            <img data-toggle="tooltip" data-placement="right" data-placement="bottom" title="Hooray!" src="./images/196760.png" width="20px" height="20px" id="warningPrice" style="display: none" class="warning war-price ml-2">
                        </div>
                    </div>



                    <div class="form-group">
                        <span class="form-label">Max alults in room</span>
                        <div class="d-flex">
                            <select id="adults" onchange="maxAdults()" class="col-lg-12" name="adults">
                                <option value="0"></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>

                            </select>

                            <img data-toggle="tooltip" data-placement="right" data-placement="bottom" title="Hooray!" src="./images/196760.png" width="20px" height="20px" id="warningAdults" style="display: none" class="warning war-adults ml-2">

                        </div>

                    </div>

                    <div class="row mb-5">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <span class="form-label">Phone </span>
                                <div class="d-flex">
                                    <input onkeypress="return /[0-9+ -/]/i.test(event.key)" onkeyup="phoneF()" class="form-control col-lg-11" id="phone" name="phone">
                                    <img data-toggle="tooltip" data-placement="right" data-placement="bottom" title="Hooray!" src="./images/196760.png" width="20px" height="20px" id="warningPhone" style="display: none" class="warning war-phone ml-2">

                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">

                            <div class="form-group">
                                <span class="form-label">Web site </span>
                                <div class="d-flex">

                                    <input class="form-control col-lg-12" id="web" onkeyup="webSite()" name="web">
                                    <img data-toggle="tooltip" data-placement="right" data-placement="bottom" title="Hooray!" src="./images/196760.png" width="20px" height="20px" id="warningWeb" style="display: none" class="warning war-web ml-2">

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="pogodnosti">
                        <div class="form-check">
                            <input type="checkbox" id="parking" name="parking" value="parking">
                            <label class="form-label" for="parking"> Parking</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="bazen" name="bazen" value="bazen">
                            <label class="form-label" for="bazen"> Pool</label>
                        </div>
                        <div class="form-check">
                            <input class="form-label" type="checkbox" id="cafe" name="cafe" value="cafe">
                            <label class="form-label" for="cafe"> Cafe-bar</label>
                        </div>
                        <div class="form-check">
                            <input class="form-label" type="checkbox" id="dorucak" name="dorucak" value="dorucak">
                            <label class="form-label" for="dorucak"> Breakfast</label>
                        </div>
                        <div class="form-check">
                            <input class="form-label" type="checkbox" id="balkon" name="balkon" value="balkon">
                            <label class="form-label" for="balkon"> Balcony</label>
                        </div>
                        <div class="form-check">
                            <input class="form-label" type="checkbox" id="spa" name="spa" value="spa">
                            <label class="form-label" for="spa"> Spa</label>
                        </div>
                        <div class="form-check">
                            <input class="form-label" type="checkbox" id="teretana" name="teretana" value="teretana">
                            <label class="form-label" for="teretana"> Gym</label>
                        </div>
                        <div class="form-check">
                            <input class="form-label" type="checkbox" id="wifi" name="wifi" value="wifi">
                            <label class="form-label" for="wifi"> Wifi</label>
                        </div>
                    </div>

                    <div class="form-label " style="text-align:center; width:100%" for="">Upload photos</div>

                    <div class="grid-gallery mt-3">
                        <label class="uploadPhoto ph1" for="upload1">
                            <input type="file" onchange="change('upload1',this)" id="upload1" style="display:none" name="slika1" class="slike">
                        </label>
                        <label class="uploadPhoto ph2" for="upload2">
                            <input type="file" onchange="change('upload2',this)" id="upload2" style="display:none" name="slika2" class="slike">
                        </label>
                        <label class="uploadPhoto ph3" for="upload3">
                            <input type="file" onchange="change('upload3',this)" id="upload3" style="display:none" name="slika3" class="slike">
                        </label>
                        <label class="uploadPhoto ph4" for="upload4">
                            <input type="file" onchange="change('upload4',this)" id="upload4" style="display:none" name="slika4" class="slike">
                        </label>
                    </div>
                    <button onclick="addHotel(event)" class="btn btn-success col-lg-12 mt-5">Add apartment</button>


                </div>

            </form>

        </div>
    </div>


    <footer class="py-2 bg-dark mt-5">
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
    <!-- JQuery before popper -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/jquery.nice-select.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAo02Rm1NHpilr14FznugYtEapEcwMyg-I&sensor=false&amp;libraries=places"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.10.1/umd/popper.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/postObject.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>