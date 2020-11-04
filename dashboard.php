<?php
include "connect.php";
session_start();
$idUser = $_SESSION['id'];
if ($idUser != 1) {
    header('Location: index.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/nav.css">
</head>

<body>
    <nav id="nav-animate" class="navbar navbar-expand-lg fixed-top bg-white" style="height: 87px;">
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
                        <a id="ponuda" class="nav-link" href="booking.php">Hotels</a>
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
                        echo '<a id="ponuda" class="nav-link" href="postHotel.php">Post Hotel</a>';
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


    <header style="margin-top: 20px;">

        <!--form-->
        <div class="container">
            <div class="my-5 hotels"></div>
        </div>

        <div class="modal fade px-4" id="addCountry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog mw-100" role="document">
                <div class="modal-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4 addCountry-bg"></div>
                            <div class="col-lg-8">
                                <form class="addCountry" id="addCountry-form" enctype="multipart/form-data">
                                    <input type="hidden" name="mojID" id="mojID">
                                    <div class="form-header mb-3 mt-3">
                                        <h2 class="little-font">Add City in TravelWorld</h2>
                                    </div>
                                    <label class="d-flex " for="upload" style="cursor:pointer">
                                        <div id="upload-picture-new" class="upload-picture-new mx-auto"></div>
                                        <input name="file" type="file" id="upload" style="display:none">
                                    </label>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class="form-label">City</span>
                                                <input onkeyup="isValidName()" class="form-control" id="name" placeholder="Enter name of city" name="nameD">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class="form-label">Country</span>
                                                <input onkeyup="isValidCountry()" class="form-control" id="country" placeholder="Enter name of country" name="country">
                                            </div>
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

    </header>

</body>
<script src="js/jquery.min.js"></script>
<script src="js/addCountry.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://kit.fontawesome.com/5bd43f344d.js" crossorigin="anonymous"></script>

<script>
    $(function() {
        $.ajax({
            type: "get",
            url: "api/admin/getPending.php",
            success: function(response) {

                var data = JSON.parse(response);

                var hotels = data.hotel;
                let html = '';


                for (let i = 0; i < hotels.length; i++) {
                    const hotel = hotels[i];
                    const image = hotels[i].image2;
                    const name = hotels[i].name;

                    let stars = "";

                    for (let index = 0; index < hotel.stars; index++) {
                        stars += `<img class="star" alt="" src="images/star.svg">`
                    }

                    html += `<div class="myCard d-flex p-0 my-3" id="d-cardHotel" data-idHotel="${hotels[i].id}" style="min-height:230px">
                                <div class="myCard-left" style="flex:50">
                                    <img style="object-fit:cover;max-height:220px" class="w-100 h-100" src="images/objectsImages/${image}">
                                </div>
                                <div class="d-flex flex-column justify-content-between" style="flex:50">
                                    
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-end">
                                                <div style="font-size:1.3rem" class="pr-2"> ${name} </div> 
                                                <div class="d-flex stars" style="width:28px;height:28px">${stars}</div>
                                            </div>
                                            <div class="cardPrice">
                                                 ${hotels[i].price}€       
                                            </div>
                                        </div>
                                        <div>
                                            
                                            <div class="cityName pt-0">
                                               ${hotel.street}
                                            </div>
                                            <div class="mt-3">
                                                ${hotel.description.replace(/^(.{200}[^\s]*).*/, "$1")}...
                                            </div>
                                        </div>
                                    </div>

                                    <div class="px-2 pb-2 d-flex ml-auto">
                                        <button style="width:85px; max-height:36px;border-radius:4px" class="btn btn-danger mx-2" onclick="deny(${hotel.id},this)">Deny</button>
                                        <button onclick="approve('${hotel.id}', '${hotel.city}', '${hotel.country}')" style="width:80px; max-height:36px;border-radius:4px" class="btn btn-success">Approve</button>
                                    </div>
                                </div>
                            </div>
                        </div>`

                }

                $('.hotels').append(html)
                empty()

            }
        });

    });

    const cityEl = document.getElementById('name');
    const countryEl = document.getElementById('country');

    function approve(id, city, country) {
        console.log(city)


        $.ajax({
            type: "post",
            url: "api/admin/isCityExist.php",
            data: {
                city: city
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success == 1) {

                    $.ajax({
                        type: "post",
                        url: "api/admin/updatePending.php",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            var data = JSON.parse(response);
                            console.log(data);
                            swal({
                                    title: 'Success',
                                    text: 'The apartment will be added to the base',
                                    icon: 'success',
                                    timer: 2000,
                                    buttons: false,
                                })
                                .then(() => {
                                    location.reload();
                                })

                        },
                    });
                } else {

                    swal({
                            title: "Are you sure?",
                            text: "First you need to add a city for that apartment!",
                            icon: "warning",
                            buttons: true,
                        })
                        .then((isUpdate) => {
                            if (isUpdate) {

                                cityEl.value = city;
                                cityEl.readOnly = true;

                                countryEl.value = country;
                                countryEl.readOnly = true;
                                document.getElementById('mojID').value = id;
                                $('#addCountry').modal('show');


                            }
                        });

                }

            }
        })

    }


    function deny(id, element) {

        $.ajax({
            type: "post",
            url: "api/admin/deny.php",
            data: {
                id: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);
                if (data.success == 1) {

                    swal({
                            title: 'Success denied!',
                            text: 'The apartment will not be added to the base.',
                            icon: 'success',
                            timer: 3000,
                            buttons: false,
                        })
                        .then(() => {
                            location.reload();
                        })
                    empty()

                }


            },
        });


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

    function empty() {
        console.log($(".hotels")[0])

        if ($(".hotels").is(':empty') || $.trim($(".hotels").html()) == '') {
            $(".hotels").html('<div class="d-flex flex-column no-pending"><div class="no-pending-text">No pending insert.</div><div style="width:100px;"><img style="width: 100%;" src="images/reception.svg" alt="" srcset=""></div></div>')
        }
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