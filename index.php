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
    <title>Home</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<style>
    .bg-no-location {
        background-image: url(images/no-location.svg) !important;
        background-position: 50% 650px !important;
        height: 240vh !important;
        background-repeat: no-repeat;
        background-size: 120px;
    }

    .img-parent {
        overflow: hidden;
    }

    .card-img-top {
        transition: .5s all ease-in-out;
    }

    .card-hover:hover .card-img-top {
        transform: scale(1.07);
    }

    .card-hover {
        transition: all .5s ease;
    }

    .card-hover:hover {
        box-shadow: rgba(0, 0, 0, 0.11) 0 5px 20px 0px, rgba(0, 0, 0, 0.08) 0 5px 15px 0 !important;
    }
</style>

<body id="bg-no-location" onload="f()">

    <style>
        .pac-container {
            z-index: 1051 !important;
        }

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
    </style>

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


    <header>

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="position:relative">

            <div class="converter">
                <div class="converter-header">Currency Converter</div>
                <div class="form-group mt-3 mb-2">
                    <label class="converter-label mb-1" for="amount">Value:</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div id="sybmol" class="input-group-text" style="max-height: 34px;">CAD</div>
                        </div>
                        <input value="1" oninput="ajaxConventer()" type="number" class="form-control" id="amount" style="max-height: 34px;">
                    </div>
                </div>
                <div class="from_to">
                    <div class="d-flex flex-column mb-1">
                        <label class="converter-label mb-1" for="cur1">From:</label>
                        <select onchange="getSybmol(this);ajaxConventer()" id='cur1'></select>
                    </div>
                    <div class="d-flex flex-column">
                        <label class="converter-label mb-1" for="cur2">To:</label>
                        <select onchange="ajaxConventer()" id='cur2'></select>
                    </div>
                </div>
                <label class="converter-label mt-2 mb-0">Result:</label>
                <div id="converted">1<span>CAD</span></div>
            </div>

            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active  firstSlide">
                    <div class="path"></div>
                    <div class="center text-light">
                    </div>
                </div>

                <div class="carousel-item secondSlide">
                    <div class="path"></div>
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>

                <div class="carousel-item slideThird">
                    <div class="path"></div>
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </header>
    <div class="container">
        <form class="header-search-form mb-4 mt-5">
            <input id="getSearch" type="text" onkeyup="f(this.value)" placeholder="Search city or country...">
        </form>
        <div class="row" id="pushCard"></div>
    </div>
    <div id="pending-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog index-modal">
            <div id="pending" class="modal-content">
            </div>
        </div>
    </div>
    <footer class="py-5 bg-dark">
        <div class="container">

        </div>
    </footer>


    <!-- Modal -->
    <div class="modal fade px-4" id="addCountry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog mw-100" role="document">
            <div class="modal-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 addCountry-bg"></div>
                        <div class="col-lg-8">
                            <form class="addCountry" id="addCountry-form" enctype="multipart/form-data">
                                <input type="hidden" class="newCountry" name="newCountry" id="newCountry">
                                <div class="form-header mb-3 mt-3">
                                    <h2 class="little-font">Add City in TravelWorld</h2>
                                </div>
                                <label class="d-flex " for="upload" style="cursor:pointer">
                                    <div id="upload-picture-new" class="upload-picture-new mx-auto"></div>
                                    <input name="file" type="file" id="upload" style="display:none">
                                </label>

                                <div class="form-group ">

                                    <span class="form-label ">Write your adress </span>
                                    <div class="d-flex">
                                        <input class="form-control col-lg-12 gcse-search" id="adress" name="adress" type="text" autocomplete="on">
                                        <img data-toggle="tooltip" data-placement="right" data-placement="bottom" title="Hooray!" src="./images/196760.png" width="20px" height="20px" id="warningAdress" style="display: none" class="warning war-adress ml-2">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="form-label">Description</span>
                                    <textarea name="descriptionD" onkeyup="isValidDesc(this)" class="form-control" rows="6" id="description" placeholder="Enter description of city"></textarea>
                                </div>
                                <div class="taxies" id="taxies">
                                    <div class="row" id="oldOne">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <span class="form-label">Name taxi</span>
                                                <input onkeyup="isValidNameTaxi(this)" class="form-control nameTaxii" id="nameTaxi" placeholder="Enter name of taxi">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <span class="form-label">Number taxi</span>
                                                <input onkeyup="numberTaxi(this)" onkeypress="return /[0-9+ -/]/i.test(event.key)" class="form-control numberTaxiname" id="phone" placeholder="Enter number of taxi">
                                            </div>
                                        </div>
                                        <i id="addTaxi" class="fas fa-plus d-flex align-self-center " style="color:red"></i>
                                    </div>
                                </div>
                                <div class="form-btn mb-4 d-flex justify-content-center">

                                    <input type="submit" id="addCity" class="btn btn-success mt-3" value="Add city">

                                </div>
                                <button type="button" class="close-modal" data-dismiss="modal">&times;</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAo02Rm1NHpilr14FznugYtEapEcwMyg-I&sensor=false&amp;libraries=places"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/5bd43f344d.js" crossorigin="anonymous"></script>
    <script src="js/jquery.nice-select.js"></script>
    <script src="js/bootstrap-notify.min.js"></script>


    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.10.1/umd/popper.min.js"></script>

    <script>
        let lat = "";
        let lng = "";
        let city = "";
        let country = "";



        var autocomplete;

        autocomplete = new google.maps.places.Autocomplete((document.getElementById('adress')), {
            types: ['geocode']
        })

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            const near_place = autocomplete.getPlace();
            lat = near_place.geometry.location.lat();
            lng = near_place.geometry.location.lng();
            console.log((near_place))
            console.log((lng))
            console.log(near_place.adr_address)

            city = near_place.address_components[0].long_name;
            arrayAdress = near_place.address_components;

            arrayAdress.forEach(address => {
                address.types.forEach(type => {
                    if (type == "country") country = address.long_name;


                });
            });

            console.log(city)
            console.log(country)
        });


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


        function f(search) {
            var searchHint = search || "";

            var http = new XMLHttpRequest();
            var method = "POST";
            var url = "api/index/all.php";
            var asynchronous = true;
            http.open(method, url, asynchronous);
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.send('search=' + searchHint);
            http.onload = function() {
                var data = JSON.parse(http.responseText);
                console.log(data);
                var countries = data.countries;
                var html = '';

                for (var i = 0; i < countries.length; i++) {
                    if (countries[i].finished == 1) {
                        html += '<div class="col-lg-4 mb-4">';
                        html += ' <div class="card h-100 card-hover">';
                        if (sessionStorage.getItem('username') === 'admin') {
                            html += '<img class="deleteCountry" src="images/red-x.svg" onclick="deleteCountry(this.parentNode.parentNode, ' + countries[i].id + ')">';
                        }
                        html += ' <h4 class="card-header">' + countries[i].name + '</h4>';
                        html += '<a class="img-parent" href="country.php?id=' + countries[i].id + '"><img class="card-img-top sizeS" src="images/countryImages/' + countries[i].photo + '"></a>';
                        html += '<div class="card-body">';
                        html += ' <p class="card-text">' + countries[i].description.replace(/^(.{150}[^\s]*).*/, "$1") + '...</p>';
                        html += ' </div>';
                        html += '<div class="card-footer">';
                        html += '<a href="country.php?id=' + countries[i].id + '" class="btn btn-primary">Learn More</a>';
                        html += ' </div>';
                        html += '</div>';

                        html += ' </div>';
                    }
                }
                if (sessionStorage.getItem('username') === 'admin') {

                    html += `<div data-toggle="modal" data-target="#addCountry" class="add-country d-flex align-items-center col-lg-4 justify-content-center"><img src="images/folder-add-icon.png" style="width:50%" alt=""></div>`
                }
                document.getElementById('pushCard').innerHTML = html;
                if (countries.length === 0) {
                    console.log('emp')
                    $('#bg-no-location').addClass("bg-no-location");
                } else {
                    $('#bg-no-location').removeClass("bg-no-location");

                }
            }
        }



        $('#addTaxi').click(() => {


            const html = ` <div class="row" id="oldOne">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <span class="form-label">Name taxi</span>
                                                <input onkeyup="isValidNameTaxi(this)"   class="form-control nameTaxii" id="nameTaxi" placeholder="Enter name of taxi">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <span class="form-label">Number taxi</span>
                                                <input onkeyup="numberTaxi(this)"  onkeypress="return /[0-9+ -/]/i.test(event.key)" class="form-control numberTaxiname" id="number" placeholder="Enter number of taxi">
                                        </div>
                                    </div>
                                    <i style="color:red" class="fas fa-minus d-flex align-self-center" onclick="removeTaxi(this.parentNode)"></i>


                                </div>`;

            $('.taxies').append(html);

        });

        function removeTaxi(taxi) {
            taxi.parentNode.removeChild(taxi);
        }


        const sybmol = document.getElementById('sybmol');

        function getSybmol(element) {
            sybmol.innerHTML = element.value;
        }

        function ajaxConventer() {
            const from = document.getElementById('cur1').value;
            $.ajax({
                type: 'get',
                url: 'https://api.exchangeratesapi.io/latest?base=' + from,


                success: function(response) {
                    const val2 = document.getElementById('cur2').value;
                    const amount = document.getElementById('amount').value;
                    const rate = response.rates[val2];
                    const finished = Math.round(amount * rate * 10000) / 10000 + `<span>${val2}</span>`;
                    $("#converted").html(finished);
                    console.log();


                }
            });
        }

        $(document).ready(function() {

            $.ajax({
                type: 'get',
                url: 'https://api.exchangeratesapi.io/latest?base=USD',
                success: function(response) {
                    var data = response.rates;
                    var num = 0;
                    for (let option of Object.keys(data)) {
                        var item = new Option(option, option);
                        $('#cur1').append($(item));
                    }
                    for (let option of Object.keys(data)) {
                        var item = new Option(option, option);
                        $('#cur2').append($(item));
                    }

                    $('select').niceSelect();

                }
            });
        })

        function deleteCountry(element, id) {

            $.ajax({
                type: "post",
                url: "api/addCountry/deleteCountry.php",
                data: {
                    id: id
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    console.log(response);
                    if (data.success === 1) {
                        element.parentNode.removeChild(element);

                    }
                },
            });
        }





        $(function() {
            $.ajax({
                type: "get",
                url: "api/owner/owner.php",
                success: function(response) {
                    var data = JSON.parse(response);
                    let html = "";
                    let num = 0;
                    data.hotel.forEach(element => {
                        console.log(element)
                        if (element.approved == "Pending") {
                            html += `<div id="reservation-section-${element.resrvationId}" class="mySlides">
                                        <img class="closeBtn "  src="images/close.png" onclick="closeModal()">
                                        <div>
                                             <img class="img-round-table d-flex mx-auto mb-4" src='images/users/${element.photo}'>
                                             <table class=" table table-pending" >
                                                <thead>
                                                <tr>
                                                    <th>Name Surname</th>
                                                    <th>Email</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>${element.name} ${element.surname}</td>
                                                    <td>${element.email}</td>
                                                    
                                                </tr>
                                                </tbody>

                                                <thead>
                                                <tr>
                                                    <th>Apratman</th>
                                                    <th>Phone</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>${element.hotelName}</td>
                                                    <td>${element.phone}</td>
                                                </tr>
                                                </tbody>
                                                 <thead>
                                                <tr>
                                                    <th>Check in</th>
                                                    <th>Check out</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>${element.checkIn}</td>
                                                    <td>${element.checkOut}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-center">
                                                <button type="button" onclick="deny(${element.resrvationId})" class="btn btn-danger mr-3 rem85">Deny</button>
                                                <button onclick="approw(${element.resrvationId})" type="button" class="btn btn-success rem85">Aprrow</button>
                                                </div>
                                        </div>
                                    </div>`;

                            num++;
                        }
                        if (element.approved == "Canceled" && element.notification == 0) {
                            $.notify({
                                icon: 'glyphicon glyphicon-warning-sign',
                                message: '<strong>Canceled</strong> Your  resrvation is cancel in ' + element.hotelName + " at " + element.checkIn,
                            }, {
                                type: 'danger',
                                timer: 15000,
                                allow_dismiss: true,

                            });


                            $.ajax({
                                type: 'get',
                                url: 'api/owner/forOwnerNotication.php',
                                success: function(response) {
                                    console.log(response)
                                    var data = JSON.parse(response);


                                }
                            })

                        }


                    });
                    html += `<div class="caption-container">
                                <div class="d-flex" style="position: absolute; top:50%; transform:translateY(-50%); left:-10%; height: 40px;">
                                    <img onclick="plusSlides(-1)" src="images/previous.png" class="h-100" style="cursor: pointer;">
                                </div>
                                <div class="d-flex" style="position: absolute; top:50%; transform:translateY(-50%); right:-10%; height: 40px;">
                                    <img onclick="plusSlides(1)" src="images/next.png" class="h-100" style="cursor: pointer;">
                                </div>
                            </div>`;
                    if (num > 0) {
                        document.getElementById('pending').innerHTML = html;
                        $('#pending-modal').modal('show');
                        showSlides(slideIndex)
                    }


                },
            });

            $.ajax({
                type: 'POST',
                url: 'api/booking/readMyReservation.php',
                data: {
                    email: sessionStorage.getItem('email')

                },
                success: function(response) {

                    var data = JSON.parse(response);
                    var reservations = data.reservations;
                    let html = '';
                    let notification = "";
                    reservations.forEach(element => {
                        if (element.notification == 0) {
                            if (element.approved == "Deny") {
                                $.notify({
                                    icon: 'glyphicon glyphicon-warning-sign',
                                    message: '<strong>Denied</strong> Your  resrvation is denied in ' + element.hotel + " at " + element.checkIn + ' by owner',
                                }, {
                                    type: 'danger',
                                    timer: 15000,
                                    allow_dismiss: true,

                                });
                                update()
                            }
                            if (element.approved == "Approved") {
                                $.notify({
                                    icon: 'glyphicon glyphicon-warning-sign',
                                    message: '<strong>Success</strong> Your  resrvation is confied in ' + element.hotel + " at " + element.checkIn + ' by owner',
                                }, {
                                    type: 'success',
                                    timer: 15000,
                                    allow_dismiss: true,

                                });
                                update()

                            }

                        }

                        function update() {
                            $.ajax({
                                type: 'post',
                                data: {
                                    email: sessionStorage.getItem('email')
                                },
                                url: 'api/owner/updateNotification.php',
                                success: function(response) {
                                    var data = JSON.parse(response);

                                    console.log(data)

                                }
                            })
                        }
                    })




                }
            })



        })

        function deny(id) {
            $.ajax({
                type: "post",
                url: "api/owner/deny.php",
                data: {
                    id: id
                },
                success: function(response) {

                    const pendingSection = document.getElementById("reservation-section-" + id);
                    var data = JSON.parse(response);
                    console.log(data)

                    const slides = document.getElementsByClassName("mySlides");
                    pendingSection.lastElementChild.classList.add('thanks');
                    pendingSection.lastElementChild.innerHTML = "";
                    setTimeout(function() {
                        plusSlides(1);

                        if (slides.length == 1) {
                            $('#pending-modal').modal('hide');
                        } else {
                            pendingSection.remove();
                        }
                    }, 2000);

                },
            });
        }

        function approw(id) {
            $.ajax({
                type: "post",
                url: "api/owner/approw.php",
                data: {
                    id: id
                },
                success: function(response) {
                    const pendingSection = document.getElementById("reservation-section-" + id);
                    var data = JSON.parse(response);
                    console.log(data)

                    const slides = document.getElementsByClassName("mySlides");
                    pendingSection.lastElementChild.classList.add('thanks');
                    pendingSection.lastElementChild.innerHTML = "";
                    setTimeout(function() {
                        plusSlides(1);

                        if (slides.length == 1) {
                            $('#pending-modal').modal('hide');
                        } else {
                            pendingSection.remove();
                        }
                    }, 2000);
                },
            });

        }


        $(function() {
            console.log("to" + $('#addCountry input').hasClass('newCountry'));

        })
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/addCountry.js"></script>
</body>

</html>