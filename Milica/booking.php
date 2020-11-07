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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/nav.css">
    <style>
        .bg-not-found {
            background-image: url(images/notfound.webp);
            background-size: 50%;
            background-repeat: no-repeat;
            background-origin: center;
            background-position: 400px 250px;
        }
    </style>
</head>

<body onload="hotels()">
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


    <header id="bg-not-found">

        <img class="bookingHeader" src="images/gray-living-rooms-tuxedo-park-1489600988.jpg" alt="">

        <!--form-->
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-lg-3">
                    <form>
                        <div class="box-filter">
                            <!--                location-->
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input value="<?php if (isset($_GET['name'])) echo $_GET['name'] ?>" onkeyup="hotels()" type="text" class="form-control" id="loc" placeholder="Location search...">
                            </div>

                            <div class="filter-stars">
                                <h5 class="text-center">Filter by stars</h5>
                                <div class="d-flex flex-column align-items-center">
                                    <div class="d-flex p-2">
                                        <input checked name="stars" onchange="hotels()" class="form-check-input" type="checkbox" id="typeCheckbox1" value="1">
                                        <label class="form-check-label ml-1" for="typeCheckbox1">1 &#9733;</label>
                                    </div>

                                    <div class="d-flex p-2">
                                        <input checked name="stars" onchange="hotels()" class="form-check-input" type="checkbox" id="typeCheckbox2" value="2">
                                        <label class="form-check-label ml-1" for="typeCheckbox1">2 &#9733;</label>
                                    </div>

                                    <div class="d-flex p-2">
                                        <input checked name="stars" onchange="hotels()" class="form-check-input" type="checkbox" id="typeCheckbox3" value="3">
                                        <label class="form-check-label ml-1" for="typeCheckbox1">3 &#9733;</label>
                                    </div>

                                    <div class="d-flex p-2">
                                        <input checked name="stars" onchange="hotels()" class="form-check-input" type="checkbox" id="typeCheckbox4" value="4">
                                        <label class="form-check-label ml-1" for="typeCheckbox1">4 &#9733;</label>
                                    </div>

                                    <div class="d-flex p-2">
                                        <input checked name="stars" onchange="hotels()" class="form-check-input" type="checkbox" id="typeCheckbox5" value="5">
                                        <label class="form-check-label ml-1" for="typeCheckbox1">5 &#9733;</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="numberAdult">Adults</label>
                                <select onchange="hotels()" class="form-control" id="numberAdult">
                                    <option value="0">Select number of adults..</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="col-lg-9 mt-3">


                    <div id="cardHotel">
                    </div>

                    <hr>


                </div>

    </header>
    <footer class="py-5 bg-dark">
        <div class="container">
        </div>
    </footer>
</body>

<script>
    function getStars() {

        var selectStars = document.getElementsByName('stars');
        var niz = [];
        var j = 0;
        for (var i = 0; i < selectStars.length; i++) {
            if (selectStars[i].checked) {
                niz[j] = selectStars[i].value;
                j++;
            }
        }
        if (niz.length === 0) {
            niz[0] = 0;
            return niz;
        }
        return niz;

    }

    function getSelectedAdults() {

        var selector = document.getElementById("numberAdult");
        //let collection = itemList.selectedOptions;
        var value = selector[selector.selectedIndex].value;

        console.log(value);
        return value;

    }
</script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/booking.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>