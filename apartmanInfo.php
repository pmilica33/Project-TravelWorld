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
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>Apartment</title>
    <style>
        .carousel-control-prev-icon {
            transform: rotate(180deg);
        }
    </style>
</head>

<body class="body-background">

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
    <div id="section-1" class="container-fluid w-85"></div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog booking-modal mw-100 w-50" role="document">
            <div class="modal-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 booking-bg"></div>
                        <div class="col-lg-8">
                            <form id="booking-form">
                                <div class="form-header mb-3 mt-3">
                                    <h2>Make your reservation</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <span class="form-label">Check In</span>
                                            <input onchange="price()" readonly='true' class="form-control" id="checkIn" type="text" name="checkIn" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <span class="form-label">Check Out</span>
                                            <input onchange="price()" readonly='true' class="form-control" id="checkOut" name="checkOut" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <span class="form-label">Name</span>
                                            <input onkeyup="isValidName()" class="form-control" name="name" id="name" placeholder="Enter your name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <span class="form-label">Surname</span>
                                            <input onkeyup="isValidSurname()" class="form-control" name="surname" id="surname" placeholder="Enter your surname">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                                    <span class="form-label">Email</span>
                                                    <input onkeyup="emailF()" class="form-control" type="email" id="email" placeholder="Enter your email">
                                                </div> -->
                                <div class="form-group">
                                    <span class="form-label">Phone</span>
                                    <input onkeypress="return /[0-9+ -/]/i.test(event.key)" onkeyup="tel()" name="phone" class="form-control" type="tel" id="phone" placeholder="Enter your phone number">
                                </div>
                                <div class="form-btn mb-4">
                                    <img class="closeBtn " src="images/close.png" data-dismiss="modal">

                                    <div class="d-flex  justify-content-between">
                                        <div>
                                            <button type="button" onclick="ajaxUserReservation()" class="btn btn-primary loader-disable">Use user account</button>
                                            <button onclick="validation()" type="button" class="btn btn-success loader-disable">Book now</button>
                                        </div>
                                        <div id="calculatedPrice"></div>
                                    </div>
                                    <img src="images/25.gif" id="loader-gif" style="width: 28px;display:none !important" class="d-flex mx-auto mt-4 mb-4" alt="">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAo02Rm1NHpilr14FznugYtEapEcwMyg-I&sensor=false&amp;libraries=places"></script>

<script>
    function price() {
        const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        const firstDate = new Date($('#checkIn').val());
        const secondDate = new Date($('#checkOut').val());
        const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
        const price = $('.price').data('price');
        const finallyPrice = parseFloat(diffDays * price);
        document.getElementById('calculatedPrice').innerHTML = 'Price:' + finallyPrice + '€';
        return finallyPrice;
    }



    const idHotel = <?php echo $_GET['id'] ?>;
    let lat = '';
    let lon = '';
    let html = '';


    $('.carousel').carousel('pause');


    $(document).ready(function() {
        $.ajax({
            type: "post",
            url: "api/apartmanInfo/apartmanInfo.php",
            data: {
                id: idHotel
            },

            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                lat = parseFloat(data.hotel[0].lat);
                lon = parseFloat(data.hotel[0].lon);
                console.log(data.hotel[0].image != '');
                console.log(data.hotel[0].stars)

                let stars = "";

                for (let index = 0; index < data.hotel[0].stars; index++) {
                    stars += `<div  class="d-flex stars"><img class="star" alt="" src="images/star.svg"></div>`
                }



                html += `<div class="d-flex column">
                            <div class="section-1-left bg-white" style="flex:63%">
                                <div id="carouselExampleControls" class="carousel slide carousel-Small" data-interval="false" data-ride="carousel">
                                    <div class="carousel-inner">`;

                if (data.hotel[0].image != "") {

                    html += `<div class="carousel-item "><img src="images/objectsImages/${data.hotel[0].image}" class="d-block w-100" alt="...">
                </div>`;
                }
                if (data.hotel[0].image2 != "") {

                    html += `<div class="carousel-item ">
                <img src="images/objectsImages/${data.hotel[0].image2}" class="d-block w-100" alt="...">
                </div>`;
                }
                if (data.hotel[0].image3 != "") {
                    html += `<div class="carousel-item ">
                <img src="images/objectsImages/${data.hotel[0].image3}" class="d-block w-100" alt="...">
                </div>`;
                }
                if (data.hotel[0].image4 != "") {
                    html += `<div class="carousel-item ">
                <img src="images/objectsImages/${data.hotel[0].image4}" class="d-block w-100" alt="...">
                </div>`;
                }

                html += `</div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <img src="images/arrow-right-solid.svg"  class="carousel-control-prev-icon" aria-hidden="true"></img>
                    <div class="next-bg"></div>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <img src="images/arrow-right-solid.svg" class="carousel-control-next-icon" aria-hidden="true"></img>
                    <div class="next-bg"></div>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="p-3">
                <div class="d-flex mt-4 mb-5 justify-content-between">
                    <div class="apartment-name">
                        ${data.hotel[0].name}
                    </div>
                    <button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-success">Book now</button>

                </div>
                
                <div class="apartment-desc mt-4">
                    ${data.hotel[0].description}
                </div>
                <div class="border-top-purple mt-5">
                    <div class="advantages-name mt-5">Advantages</div>
                    <div class="advantages">
                        <div class="advantages-item d-flex   align-items-center">
                        <i class="fas advantages-border mr-2 fa-swimmer">`;

                console.log(data.hotel[0].bazen == "")
                if (data.hotel[0].bazen == "") {
                    html += `<div class="advantages-border-strike"></div>`;
                }
                html += `</i><span>Pool</span>
                        </div>
                        <div class="advantages-item d-flex   align-items-center">
                            <i class="fas advantages-border mr-2 fa-hot-tub">`;
                if (data.hotel[0].spa == "") {
                    html += `<div class="advantages-border-strike"></div>`;
                }

                html += `</i><span>Spa</span>
                        </div>
                        <div class="advantages-item d-flex   align-items-center">
                            <i class="fas advantages-border mr-2 fa-wifi">`;
                if (data.hotel[0].wifi == "") {
                    html += `<div class="advantages-border-strike"></div>`;
                }
                html += `</i><span>Wifi</span>
                        </div>
                        <div class="advantages-item d-flex   align-items-center">
                            <i class="fas advantages-border mr-2 fa-parking">`
                if (data.hotel[0].parking == "") {
                    html += `<div class="advantages-border-strike"></div>`;
                }
                html += `</i><span>Parking</span>
                        </div>
                        <div class="advantages-item d-flex   align-items-center">
                            <i class="fas advantages-border mr-2 fa-egg">`
                if (data.hotel[0].dorucak == "") {
                    html += `<div class="advantages-border-strike"></div>`;
                }
                html += `</i><span>Breakfast</span>
                        </div>
                        <div class="advantages-item d-flex   align-items-center">
                            <i class="fas advantages-border mr-2 fa-dumbbell">`;
                if (data.hotel[0].teretana == "") {
                    html += `<div class="advantages-border-strike"></div>`;
                }
                html += `</i><span>Gym</span>
                        </div>
                        <div class="advantages-item d-flex   align-items-center">
                            <i class="fas advantages-border mr-2 fa-coffee">`;
                if (data.hotel[0].cafe == "") {
                    html += `<div class="advantages-border-strike"></div>`;
                }
                html += `</i><span>Cafe</span>
                        </div>
                        <div class="advantages-item d-flex   align-items-center">
                           <div class="mr-2 balcony advantages-border"><img class="w-50" src="images/balcony.svg" alt="" srcset=""> `;
                if (data.hotel[0].balkon == "") {
                    html += `<div class="advantages-border-strike"></div>`;
                }
                html += `</div><span>Balcony</span>
                        </div>


                    </div>
                  
                </div>
                
            </div>
        </div>
        <div class="d-flex flex-column section-1-right mx-4 bg-white">
            <div class="position-relative">
                <div style="height:280px">
                    <div id="map" class="px-3" style="height: 100%; position: relative;"></div>
                    <svg class="mapWave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,256L48,218.7C96,181,192,107,288,117.3C384,128,480,224,576,250.7C672,277,768,235,864,229.3C960,224,1056,256,1152,261.3C1248,267,1344,245,1392,234.7L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                    <div data-price=${data.hotel[0].price} class="price"><div class="price-container">${data.hotel[0].price}€</div></div>
                </div>
            </div>
            <div class="d-flex justify-content-between p-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-globe"></i>
                    <span class="mx-2 apartmentInfoColorLef">Web site</span>
                </div>`;
                const shortWeb = (data.hotel[0].web).slice(12)
                html += `<a href="${data.hotel[0].web}" target="_blank">${shortWeb.substring(0,17)}</a>
            </div>
              <div class="d-flex justify-content-between border-top-purple p-3">
                <div class="d-flex align-items-center">
                   <i class="fas fa-map-marker-alt"></i>
                    <span class="mx-2 apartmentInfoColorLeft">Address</span>
                </div>
                <span class="apartmentInfoColor">${data.hotel[0].street}</span>
              </div>
               <div class="d-flex justify-content-between border-top-purple p-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-phone"></i>
                    <span class="mx-2 apartmentInfoColorLeft">Phone</span>
                </div>
                <span class="apartmentInfoColor">${data.hotel[0].phone}</span>
              </div>
              <div class="d-flex justify-content-between border-top-purple p-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-star"></i>
                    <span class="mx-2 apartmentInfoColorLeft">Stars</span>
                </div>
                <div class="d-flex apartmentInfoColor">${stars}</div>
              </div>
               <div class="d-flex justify-content-between border-top-purple p-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-money-bill-wave"></i>
                        <span class="mx-2 apartmentInfoColorLeft">Price</span>
                    </div>
                    <div class="d-flex apartmentInfoColor">${data.hotel[0].price}€</div>
              </div>
              <div class="d-flex justify-content-between border-top-purple p-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users"></i>
                        <span class="mx-2 apartmentInfoColorLeft">Max persons</span>
                    </div>
                    <div class="d-flex apartmentInfoColor">${data.hotel[0].adults}</div>
              </div>`;
                if (data.review.length != 0) {
                    html += `<div class="p-3">
                    <div class="review-header">Recent reviews of this property</div>`
                    data.review.forEach(element => {
                        let clean = "";
                        for (let index = 0; index < element.clean; index++) {
                            clean += `<div  class="d-flex stars-sm"><img class="star" alt="" src="images/star.svg"></div>`
                        }
                        let service = "";
                        for (let index = 0; index < element.service; index++) {
                            service += `<div  class="d-flex stars-sm"><img class="star" alt="" src="images/star.svg"></div>`
                        }

                        let location = "";
                        for (let index = 0; index < element.location; index++) {
                            location += `<div  class="d-flex stars-sm"><img class="star" alt="" src="images/star.svg"></div>`
                        }
                        console.log(data.review.length)
                        html += `<div id="review" class="review-topClass">
                        <div class="review">
                            <img src="images/users/${element.photo}">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-column ml-2">
                                    <div class="reviewer">${element.nameUser} ${element.surname}</div>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="d-flex align-items-center"><span style="min-width:50px">Clean:</span><div class="d-flex ml-2">${clean}</div></div>
                                            <div class="d-flex align-items-center"><span style="min-width:50px">Service:</span><div class="d-flex ml-2">${service}</div></div>
                                            <div class="d-flex align-items-center"><span style="min-width:50px">Location:</span><div class="d-flex ml-2">${location}</div></div>
                                        </div>
                                        <div class="review-title ml-3">
                                            ”${element.reviewTitle}“
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="review-desc mt-2">
                            ${element.reviewDescription}
                        </div>
                    </div>`
                    });
                };
                html += `</div>
        </div>
    </div>`

                $('#section-1').append(html);
                document.getElementsByClassName('carousel-item')[0].classList.add("active");

                map();
            }
        });



        function map() {
            $('.carousel').carousel();
            console.log(lat)
            var locationCenter = {
                lat: lat,
                lng: lon
            };
            var location = {
                lat: lat,
                lng: lon
            };
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13,
                center: locationCenter,

            });
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });

        }



        var arrayAsDateObjects = [];
        var daysOfYear = new Array();
        $.ajax({
            type: 'post',
            url: 'api/apartmanInfo/hotelReservations.php',
            data: {
                id: idHotel
            },
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                for (let index = 0; index < data.reservations.length; index++) {
                    const reservation = data.reservations[index];

                    for (let d = new Date(reservation.from); d <= new Date(reservation.to); d.setDate(d.getDate() + 1)) {
                        daysOfYear.push(new Date(d).toISOString().slice(0, 10));
                    }
                    // console.log(daysOfYear)
                    arrayAsDateObjects = convertStringToDateObject(daysOfYear);
                    console.log(arrayAsDateObjects)
                }
            }
        });

        ///////Sortiramo niz i pretvaramo ga u Date
        function convertStringToDateObject(daysOfYear) {
            var ls = [];
            console.log(daysOfYear.length)
            for (let index = 0; index < daysOfYear.length; index++) {
                console.log("usoa")
                var splitDate = daysOfYear[index].split("-");
                var date = new Date(splitDate[0], Number(splitDate[1]) - 1, splitDate[2]);
                ls.push(date);
            }
            ls.sort(function(a, b) {
                return a - b;
            });
            return ls;
        }

        const today = new Date();

        $("#checkIn").datepicker("option", "dateFormat", "yy-mm-dd");
        $("#checkOut").datepicker("option", "dateFormat", "yy-mm-dd");
        var max = "";

        $('#checkIn').datepicker({
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [daysOfYear.indexOf(string) == -1]
            },
            minDate: today,
            onClose: function() {
                $("#checkOut").datepicker(
                    "change", {
                        minDate: getTomorrow(new Date($('#checkIn').val()))

                    }
                );
            },
            onSelect: function(date) {
                if (findNextDisabledDateWithinMonth(date) != 0) {
                    $("#checkOut").datepicker("option", "maxDate", findNextDisabledDateWithinMonth(date));
                } else {
                    $("#checkOut").datepicker("option", "maxDate", null);
                }




            }
        });

        function getTomorrow(date) {
            return new Date(date.getFullYear(), date.getMonth(), date.getDate() + 1);
        }

        ////////Selectovani provjeravamo ima li veci disabled
        function findNextDisabledDateWithinMonth(date) {
            var splitDate = date.split("/");
            var selectedDate = new Date();
            selectedDate.setDate(splitDate[1]);
            selectedDate.setMonth(Number(splitDate[0]) - 1);
            selectedDate.setFullYear(splitDate[2]);

            var nextDisabledDate = null;
            $.each(arrayAsDateObjects, function(i, ele) {
                console.log(selectedDate)
                console.log("vs")
                console.log(ele)
                console.log(selectedDate < ele)
                console.log("")

                if (selectedDate < ele) {
                    nextDisabledDate = ele;
                    return false;
                } else {
                    nextDisabledDate = 0;
                }
            });
            return nextDisabledDate;
        }


        $('#checkOut').datepicker({
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [daysOfYear.indexOf(string) == -1]
            },
            minDate: today,
            // onClose: function() {
            //     $("#checkIn").datepicker(
            //         "change", {
            //             maxDate: new Date($('#checkOut').val())
            //         }
            //     );

            // }
        });

    });
</script>
<script src="js/booking.js"></script>
<script src="https://kit.fontawesome.com/5bd43f344d.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>