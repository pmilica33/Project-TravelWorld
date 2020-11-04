<?php

include "connect.php";
session_start();
if (isset($_SESSION['username'])) {
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/loginCss.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .tooltip-inner {
            padding: 10px !important;
        }

        .tooltip {
            width: 150px !important;
            font-size: 14px;
        }

        #form_add {
            padding: 20px 60px;
        }


        @media only screen and (max-width: 922px) {
            #form_add {
                padding: 20px 20px;
            }
        }
    </style>
</head>

<body style="background-image: url('images/2155_venedig.jpg')">
    <div class="w-100 d-flex justify-content-center animated fadeInDown " id="bla">
        <div class="col-lg-6 col-xl-5 col-md-10 col-11 text-center">
            <div class="bg-white">
                <form id="form_add" method="post" enctype="multipart/form-data">
                    <label class="d-flex mb-4" for="upload" style="cursor:pointer">
                        <div id="upload-picture-new" style="width: 75px; height: 75px;" class="upload-picture-new mx-auto"></div>
                        <input name="file" type="file" id="upload" style="display:none" accept="image/x-png,image/gif,image/jpeg">
                    </label>

                    <div id="name-block" class="position-relative m-3">
                        <input type="text" id="name" onkeyup="nejm()" class="fadeIn second" name="name" placeholder="Your Name">
                        <img data-toggle="tooltip" data-placement="right" data-error="Enter your name!" src="./images/196760.png" width="20px" height="20px" id="warningName" style="display: none" class="warning war-name">
                    </div>

                    <div class="position-relative m-3">
                        <input type="text" onkeyup="surnames()" id="surname" class="fadeIn third" name="surname" placeholder="Your Surname">
                        <img data-toggle="tooltip" data-placement="right" data-error="Enter your surname!" src="./images/196760.png" width="20px" height="20px" id="warningSurname" style="display: none" class="warning war-sur">
                    </div>

                    <div class="position-relative m-3">
                        <input type="text" id="email" onkeyup="emails()" class="fadeIn third" name="email" placeholder="Your Email">
                        <img data-toggle="tooltip" data-placement="right" data-error="Invalid email!" src="./images/196760.png" width="20px" height="20px" id="warningEmail" style="display: none" class="warning war-email">
                    </div>

                    <div class="position-relative m-3">
                        <input type="text" id="username" onkeyup="userN()" class="fadeIn third" name="username" placeholder="Your Username">
                        <img data-toggle="tooltip" data-placement="right" data-error="Invalid username!" src="./images/196760.png" width="20px" height="20px" id="warningUsername" style="display: none" class="warning war-user">
                    </div>

                    <div class="position-relative m-3">
                        <input type="password" id="password" onkeyup="passwords()" class="fadeIn third" name="password" placeholder="Your Password" autocomplete="new-password">
                        <img data-toggle="tooltip" data-placement="right" data-error="Enter your password!" src="./images/196760.png" width="20px" height="20px" id="warningPassword" style="display: none" class="warning war-pass">
                    </div>

                    <div class="position-relative m-3">
                        <input type="password" id="passwordAgain" onkeyup="passwordsAgain()" class="fadeIn third" name="repeatPassword" placeholder="Repeat Password" autocomplete="new-password">
                        <img data-toggle="tooltip" data-placement="right" data-error="Passwords don't match!" src="./images/196760.png" width="20px" height="20px" id="warningRepeatPassword" style="display: none" class="warning war-passAgain">
                    </div>

                    <input type="button" onclick="user()" class="fadeIn fourth mb-4 w-50 mt-4" name="submit" value="Create Account">
                </form>
                <div id="formFooter">
                    <a class="underlineHover" href="login.php" style="font-size:1.3rem">Log in</a>
                </div>

            </div>


        </div>

</html>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.10.1/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/createAccount.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    $("#upload").on("change", () => change());

    function change() {
        if ($("#upload")[0].files.length != 0) {
            const file = document.getElementById("upload").files[0];

            if (file) {
                // console.log(file.type);

                if (file.size < 2097152) {
                    if (
                        file.type === "image/png" ||
                        file.type === "image/jpg" ||
                        file.type === "image/jpeg"
                    ) {
                        const reader = new FileReader();

                        reader.addEventListener("load", function() {
                            $(".addCountry-bg").css(
                                "background",
                                "url('" + reader.result + "')"
                            );
                            $(".upload-picture-new").css(
                                "background",
                                "url('" + reader.result + "')"
                            );
                        });
                        reader.readAsDataURL(file);
                        return true;
                    } else {
                        swal(
                            "Re-enter a image!",
                            "Image " + file.name + " is not  jpg, png or jpeg format.",
                            "error"
                        );
                        return false;
                    }
                } else {
                    swal(
                        "Re-enter a image!",
                        "Max size image is 2MB",
                        "error"
                    );
                    return false;
                }
            }
        } else {
            swal("Post a image!", "Empty image field.", "error");
        }
    }
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</script>