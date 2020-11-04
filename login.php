<?php
session_start();
include "connect.php";
if (isset($_SESSION['username'])) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/loginCss.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">


</head>

<body>
    <div class=" d-flex justify-content-center mt-5 animated fadeInDown" id="bla">
        <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10 col-11 text-center formContent" id="formContent">
            <img src="images/LogoSample_ByTailorBrands.jpg" />
            <form method="post" class="px-4 px-lg-5 mb-4">
                <input type="text" id="username" class="fadeIn second my-2" name="username" placeholder="username">
                <input type="password" id="password" class="fadeIn third my-2" name="password" placeholder="password" autocomplete="new-password">
                <input type="button" onclick="ajaxLogin()" class="fadeIn fourth my-2 w-50" name="submit" value="Log In">
            </form>
            <div id="formFooter">
                <a class="animated underlineHover" href="forgotPassword.php">Forgot password?</a><br><br>
                <a class="animated underlineHover" href="createAccount.php">Create account</a>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script>
        function ajaxLogin() {
            $.ajax({
                type: 'post',
                url: 'api/login/login.php',
                data: {
                    username: document.getElementById('username').value,
                    password: document.getElementById('password').value,
                },
                success: function(response) {

                    var data = JSON.parse(response);
                    console.log(data);
                    if (data.success === 1) {

                        sessionStorage.setItem('username', data.login[0].user);
                        sessionStorage.setItem('email', data.login[0].email);
                        console.log(sessionStorage.getItem('email'));


                        location.href = "index.php";
                    } else {
                        $('#bla').removeClass('fadeInDown').addClass('shake');
                        window.location.reload();
                    }

                }
            });
        }
    </script>
</body>

</html>