<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: index.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link href="css/loginCss.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style1.css" rel="stylesheet">


</head>

<body>
    <div class="mt-5 animated fadeInDown d-flex  justify-content-center" id="bla">
        <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10 col-11 d-flex  justify-content-center">
            <div id="formContent" class="mt-5 formContent">
                <img class="your-img" src="images/LogoSample_ByTailorBrands.jpg" />
                <form method="post" class="px-4 px-lg-5 mb-4">
                    <input type="text" id="email" class="fadeIn second my-2" name="email" placeholder="email">
                    <input type="hidden" id="code" class="fadeIn second my-2" name="code" placeholder="Code from your mail">
                    <div id="codeErr"></div>
                    <input type="hidden" id="password" class="fadeIn second my-2" name="password" placeholder="password">

                    <input type="hidden" id="passwordAgain" class="fadeIn second my-2" name="repeatPassword" placeholder="repeat password">
                    <div id="passErr"></div>

                    <input type="button" onclick="sendEmail()" id="dugme" class="fadeIn fourth my-2 w-50" name="submit" value="Send">

                    <input type="hidden" onclick="codeS()" id="check" class="fadeIn fourth my-2 w-50" name="submit" value="Check">
                    <input type="hidden" onclick="newPass()" id="change" class="fadeIn fourth my-2" name="submit" value="Confirm">
                </form>
                <div id="formFooter">
                    <a class="animated underlineHover" href="login.php">Back to login</a>
                </div>

            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
        function sendEmail() {
            var btn = document.getElementById('dugme');
            btn.disabled = true;
            btn.value = 'Sending...'
            $.ajax({
                type: 'post',
                url: 'api/password/sendMail.php',
                data: {
                    email: document.getElementById('email').value,
                    dugme: document.getElementById('dugme').id,
                },

                success: function(response) {
                    $('#dugme').click(function(e) {
                        e.preventDefault();
                        $(this).attr('disabled', true);
                    });
                    var data = JSON.parse(response);
                    console.log(data);
                    document.getElementById('code').type = 'text';
                    document.getElementById('dugme').type = 'hidden';
                    document.getElementById('check').type = 'button';

                }
            });
        }

        function codeS() {
            $.ajax({
                type: 'post',
                url: 'api/password/sameCode.php',
                data: {
                    code: document.getElementById('code').value,
                },

                success: function(response) {
                    var data = JSON.parse(response);
                    console.log(data);

                    if (data.successSame == 1) {
                        document.getElementById('codeErr').style.display = 'none';
                        document.getElementById('password').type = 'password';
                        document.getElementById('passwordAgain').type = 'password';
                        document.getElementById('check').type = 'hidden';
                        document.getElementById('change').type = 'button';

                    } else {
                        document.getElementById('codeErr').innerHTML = '&times;'.bold().fontcolor('red');

                    }
                }
            });
        }

        function newPass() {
            $.ajax({
                type: 'post',
                url: 'api/password/removePassword.php',
                data: {
                    password: document.getElementById('password').value,
                    repeatPassword: document.getElementById('passwordAgain').value,
                    email: document.getElementById('email').value,


                },

                success: function(response) {
                    var data = JSON.parse(response);
                    console.log(data);

                    if (data.successChange === 1) {
                        window.location.href = "login.php";
                    } else {
                        document.getElementById('passErr').innerHTML = '&times;'.bold().fontcolor('red');

                    }
                }
            });
        }
    </script>
</body>

</html>