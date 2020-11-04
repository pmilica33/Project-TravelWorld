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



<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style1.css">
    <link href="css/stars.css" rel="stylesheet">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        .modalImg {
            width: 190px;
        }

        .stars {
            flex-direction: row-reverse;
            transform: translateX(-5%);
            height: auto !important;
        }

        .stars label {
            margin: 0 !important;
        }

        @media only screen and (max-width: 500px) {
            .stars label {
                width: 29px;
            }

            .arrow-pointer {
                font-size: .8rem;
            }

            .stars label:before {
                font-size: 18px;
            }

            .stars label:after {
                font-size: 18px;
            }
        }

        @media only screen and (max-width: 420px) {
            .stars label {
                width: 22px;
            }

            .stars label:before {
                font-size: 18px;
            }

            .stars label:after {
                font-size: 18px;
            }

            .modalImg {
                width: 140px;
            }

            .arrow-pointer {
                width: 122px;
            }

            .arrow-span {
                left: 10% !important;
            }
        }

        h6 {
            margin: 0;
            width: 100px;
            min-width: fit-content;
        }

        .arrow-pointer {
            width: 140px;
            height: 24px;
            background: #32557f;
            position: relative;
            font-size: .9rem;
        }

        .arrow-pointer:after {
            content: '';
            position: absolute;
            right: 0;
            bottom: 0;
            width: 0;
            height: 0;
            border-right: 12px solid white;
            border-top: 12px solid transparent;
            border-bottom: 12px solid transparent;
        }

        .arrow-pointer:before {
            content: '';
            position: absolute;
            left: -12px;
            bottom: 0;
            width: 0;
            height: 0;
            border-right: 12px solid #32557f;
            border-top: 12px solid transparent;
            border-bottom: 12px solid transparent;
        }
    </style>

</head>

<body onload="load()">
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
    <div class="container mt-5">
        <div class="ispis" style="min-height:71vh"></div>
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
    <div class="modal fade px-2" id="review-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog mt-4" role="document">
            <div class="modal-content" style="padding:0 4%">
                <div class="modal-header">
                    <h5 class="modal-title">Review us and help others for decision</h5>
                    <button type="button" class="close-modal" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <form action="" id="review-form">

                            <div class="d-flex align-items-center">
                                <h6>Service</h6>
                                <div class="stars justify-content-center d-flex" style="width: 80% !important;">
                                    <input checked type="radio" name="service" id="service1" value="5" onclick="arrowSpan(this)" class="star service"><label for="service1"></label>
                                    <input type="radio" name="service" id="service2" value="4" onclick="arrowSpan(this)" class="star service"><label for="service2"></label>
                                    <input type="radio" name="service" id="service3" value="3" onclick="arrowSpan(this)" class="star service"><label for="service3"></label>
                                    <input type="radio" name="service" id="service4" value="2" onclick="arrowSpan(this)" class="star service"><label for="service4"></label>
                                    <input type="radio" name="service" id="service5" value="1" onclick="arrowSpan(this)" class="star service"><label for="service5"></label>
                                </div>
                                <div class="arrow-pointer"><span class="arrow-span" style="color:white;position: absolute;top:0;left:15%;bottom:0"></span></div>
                            </div>

                            <div class="d-flex align-items-center">
                                <h6>Clean</h6>
                                <div class="stars justify-content-center d-flex" style="width: 80% !important;">
                                    <input type="radio" checked name="clean" id="clean1" value="5" onclick="arrowSpan(this)" class="star clean"><label for="clean1"></label>
                                    <input type="radio" name="clean" id="clean2" value="4" onclick="arrowSpan(this)" class="star clean"><label for="clean2"></label>
                                    <input type="radio" name="clean" id="clean3" value="3" onclick="arrowSpan(this)" class="star clean"><label for="clean3"></label>
                                    <input type="radio" name="clean" id="clean4" value="2" onclick="arrowSpan(this)" class="star clean"><label for="clean4"></label>
                                    <input type="radio" name="clean" id="clean5" value="1" onclick="arrowSpan(this)" class="star clean"><label for="clean5"></label>
                                </div>
                                <div class="arrow-pointer"><span class="arrow-span" style="color:white;position: absolute;top:0;left:15%;bottom:0"></span></div>
                            </div>

                            <div class="d-flex align-items-center">
                                <h6>Location</h6>
                                <div class="stars justify-content-center d-flex" style="width: 80% !important;">
                                    <input type="radio" checked name="location" id="location1" value="5" onclick="arrowSpan(this)" class="star location"><label for="location1"></label>
                                    <input type="radio" name="location" id="location2" value="4" onclick="arrowSpan(this)" class="star location"><label for="location2"></label>
                                    <input type="radio" name="location" id="location3" value="3" onclick="arrowSpan(this)" class="star location"><label for="location3"></label>
                                    <input type="radio" name="location" id="location4" value="2" onclick="arrowSpan(this)" class="star location"><label for="location4"></label>
                                    <input type="radio" name="location" id="location5" value="1" onclick="arrowSpan(this)" class="star location"><label for="location5"></label>
                                </div>
                                <div class="arrow-pointer"><span class="arrow-span" style="color:white;position: absolute;top:0;left:15%;bottom:0"></span></div>
                            </div>

                            <div class="form-group mx-0 mt-4 px-0">
                                <h6 class="mt-4">Title of your review</h6>
                                <div class="d-flex align-items-center">
                                    <input class="form-control col-lg-12" id="title" onkeyup="nameH()" name="title" type="text">
                                    <img data-toggle="tooltip" data-placement="right" data-placement="bottom" title="Hooray!" src="./images/196760.png" width="20px" height="20px" id="warningName" style="display: none" class="warning war-name ml-2">
                                </div>
                            </div>

                            <div class="form-group mx-0 px-0">
                                <h6 class="mt-4">Your review</h6>
                                <div class="d-flex">
                                    <textarea onkeyup="descritpionF()" name="descriptionD" class="form-control col-lg-12" rows="5" id="description"></textarea>
                                    <img data-toggle="tooltip" data-placement="right" data-placement="bottom" title="Hooray!" src="./images/196760.png" width="20px" height="20px" id="warningDesc" style="display: none" class="warning war-desc ml-2">
                                </div>
                            </div>

                            <div class="mt-4 d-flex mb-4 px-0">
                                <div class="modalImg"><img style="width: 100%; transform:translateX(-14px)" src="./images/lr-salespage-1-header-graphic-1-845x454-1.png"></div>
                                <button type="button" style="height:40px;" onclick="review(event)" class="btn ml-auto mt-auto btn-success">Leave Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>
<script src="js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="js/changeReservation.js"></script>

<script src="js/bootstrap.bundle.min.js"></script>
<script>
    function load() {


        $.ajax({
            type: 'POST',
            url: 'api/booking/readMyReservation.php',
            data: {
                email: sessionStorage.getItem('email')

            },
            success: function(response) {

                var data = JSON.parse(response);
                console.log(data)
                var reservations = data.reservations;
                let html = '';

                for (var i = 0; i < reservations.length; i++) {
                    const today = new Date().toISOString().split("T")[0];
                    let button = "";
                    let cancel = '';
                    let imgReview = '';
                    let image = "";
                    let late = reservations[i].checkOut < today;

                    for (let j = 0; j < reservations[i].images.length; j++) {
                        if (reservations[i].images[j] != "") {
                            image = reservations[i].images[j];
                            break;
                        }
                    }

                    imgReview = `<div class="ml-auto" id="calculatedPrice">Price: ${reservations[i].price}€</div>`;
                    cancel = `<div class="d-flex flex-column align-items-center"><div class="reservation-finished allow${reservations[i].id}"></div> <button style="max-height:40px " type="button" onclick="cancelReservation(${reservations[i].id})" class="cancel-btn${reservations[i].id} btn btn-danger">Cancel reservation</button></div>`;
                    button = `<button style="max-height:36px;border-radius:4px"  id="save" type="button" onclick="changeReservation(${reservations[i].id})" class="btn btn-success  mr-2 btn-small save${reservations[i].id}">Save changes</button>`;

                    if (late && reservations[i].approved == "Approved") {
                        imgReview = `<div data-toggle="modal" data-target="#review-modal" data-id=${reservations[i].id} data-idHotel=${reservations[i].hotelId} class="ml-auto review-img" style="width:100px;height:20px"><img style="width:100%" src="images/MagnoliaReviewUs.png"></div>`;

                    }
                    let stars = "";

                    for (let index = 0; index < reservations[i].stars; index++) {
                        stars += `<div class="d-flex stars"><img class="star" alt="" src="images/star.svg"></div>`
                    }


                    html += `<div class="mb-5">
                                <div class="card-body">
                                    <div class="myCard row">
                                        <div class="col-lg-4 ">
                                            <img class="img-fluid rounded mb-3 mb-md-0 sizeI" alt="" src="images/objectsImages/${image}">
                                        </div>
                                        <div class="col-lg-8 d-flex flex-column justify-content-between">
                                            <div class="position-relative content_small">
                                                <div class="d-flex align-items-center"><h2 class="titleHotel mr-4 mb-0">${reservations[i].hotel}</h2>${stars}${imgReview}</div> 
                                                <div class="cityName">${reservations[i].cityName}, ${reservations[i].country}</div>
                                                <div class="d-flex my-4 align-items-end">
                                                    <div class="form-group mb-0 mr-4 date_font">
                                                        <span class="form-label">Check In</span>
                                                        <input  value="${reservations[i].checkIn}" readonly='true' id="checkIn${reservations[i].id}" class="sibling${reservations[i].id} form-control inputSize checkin"  type="text" required>
                                                    </div>
                                                    <div class="form-group mb-0 mr-4 date_font">
                                                        <span class="form-label">Check Out</span>
                                                        <input  value="${reservations[i].checkOut}" readonly='true'  id="checkOut${reservations[i].id}" class="sibling${reservations[i].id} form-control inputSize checkout"  type="text" required>
                                                    </div>
                                                    ${button}
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between cardFooter_small">
                                                <div>
                                                    <div class="d-flex align-items-end mb-2">   
                                                        <div class="seeCity mr-2" onclick="location.href='http://localhost/Milica/country.php?id=${reservations[i].cityId}'">
                                                            <img class="img-fluid" src="images/Green-city-512.png">
                                                        </div>
                                                        <span class="text-span">Discover city?</span>
                                                    </div>
                                                    <div class="d-flex align-items-end"><div class="anotherHotels mr-2" onclick="location.href='http://localhost/Milica/booking.php?name=${reservations[i].cityName}'">
                                                        <img class="img-fluid" src="images/see-city.svg"></div>
                                                        <span class="text-span">Wanna see another hotels in city?</span>
                                                    </div>
                                                </div>
                                                ${cancel}
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>`

                    $('.ispis').append(html);
                    html = '';
                    hotelsArray.push(reservations[i].hotelId);
                    getDatePicker(reservations[i].id, reservations[i].hotelId);

                    if (reservations[i].approved == "Approved" && !late) {

                        $('.allow' + reservations[i].id).html("Approved by owner").css('color', 'green');
                    } else if (reservations[i].approved == "Deny") {

                        $('.allow' + reservations[i].id).html("Denied by owner");
                        $('.cancel-btn' + reservations[i].id).prop('disabled', true);
                        $('.save' + reservations[i].id).prop('disabled', true);
                    } else if (reservations[i].approved == "Pending" && !late) {

                        $('.allow' + reservations[i].id).html("Pending reservation").css('color', 'blue');
                    } else if (reservations[i].approved == "Canceled") {

                        $('.allow' + reservations[i].id).html("Canceled reservation").css('color', 'red');
                        $('.cancel-btn' + reservations[i].id).prop('disabled', true);
                        $('.save' + reservations[i].id).prop('disabled', true);
                    } else if (late && reservations[i].approved == "Pending") {

                        $('.allow' + reservations[i].id).html("Owner did not answer").css('color', 'red');
                        $('.cancel-btn' + reservations[i].id).prop('disabled', true);
                        $('.save' + reservations[i].id).prop('disabled', true);
                    } else if (late && reservations[i].approved == "Approved") {
                        $('.allow' + reservations[i].id).html("Completed and finished").css('color', 'green');
                        $('.cancel-btn' + reservations[i].id).prop('disabled', true);
                        $('.save' + reservations[i].id).prop('disabled', true);

                    }



                }
                console.log(hotelsArray)


                $(function() {
                    $(".checkin").datepicker();
                });

                $(function() {
                    $(".checkout").datepicker();
                });


            }


        });


        setTimeout(function() {
            empty();
            setMinToday();
        }, 500);


    }

    function empty() {
        console.log($(".ispis").is(':empty'))
        if ($(".ispis").is(':empty')) {
            $(".ispis").html('<div class="no-pending"><div style="width:150px;"><img style="width: 100%;" src="images/norservation.png" alt="" srcset=""></div></div>')
        }
    }
</script>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.10.1/umd/popper.min.js"></script>
<script src="js/main.js"></script>
<script src="https://kit.fontawesome.com/5bd43f344d.js" crossorigin="anonymous"></script>

</html>