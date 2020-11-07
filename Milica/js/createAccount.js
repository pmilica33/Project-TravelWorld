const nameErr = document.getElementById('warningName');
const surnameErr = document.getElementById('warningSurname');
const usernameErr = document.getElementById('warningUsername');
const emailErr = document.getElementById('warningEmail');
const passwordErr = document.getElementById('warningPassword');
const repeatPasswordErr = document.getElementById('warningRepeatPassword');


function showError(element) {
    element.style.display = "block";
    element.src = "./images/196760.png";
    $(element).attr('data-original-title', element.dataset.error)
    $(element).tooltip('show');
}

function showErrorMessage(element, message) {
    element.style.display = "block";
    element.src = "./images/196760.png";
    $(element).attr('data-original-title', message)
    $(element).tooltip('show');
}

function removeInvaild(element) {
    element.style.display = "block";
    element.src = "./images/correction.png";
    $(element).attr('data-original-title', '');
    $(element).tooltip('hide');
}

function nejm() {

    var name = document.getElementById('name').value;
    var pattern = /[a-zA-Z]+$/;

    if (name.length > 2 && name.length < 20 && name.match(pattern)) {
        removeInvaild(nameErr);
        return true;
    }
    showError(nameErr)
    return false;
}

function userN() {

    var user = document.getElementById('username').value;
    var pattern = /[a-zA-Z0-9]+$/;

    if (user.length > 2 && user.length < 20 && user.match(pattern)) {
        removeInvaild(usernameErr)
        return true;
    }
    showError(usernameErr)
    return false;
}

function surnames() {

    var surnames = document.getElementById('surname').value;
    var pattern = /[a-zA-Z]+$/;

    if (surnames.length > 2 && surnames.length < 20 && surnames.match(pattern)) {
        removeInvaild(surnameErr)
        return true;
    }
    showError(surnameErr)
    return false;
}

function emails() {
    var email = document.getElementById('email').value;
    var pattern = /^([A-Za-z0-9_\-.])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,4})$/;

    if (email.match(pattern)) {
        removeInvaild(emailErr)
        return true;
    }
    showError(emailErr)
    return false;
}


function passwords() {
    var password = document.getElementById('password').value;

    if (password.length > 4) {
        removeInvaild(passwordErr)
        return true;
    }
    showError(passwordErr)
    return false;
}

function passwordsAgain() {
    var password = document.getElementById('password').value;
    var passwordAgain = document.getElementById('passwordAgain').value;

    if (passwordAgain == password) {
        removeInvaild(repeatPasswordErr)
        return true;
    }
    showError(repeatPasswordErr)
    return false;
}


function validacija() {

    if (!nejm()) return false;
    if (!surnames()) return false;
    if (!emails()) return false;
    if (!userN()) return false;
    if (!passwords()) return false;
    if (!passwordsAgain()) return false;
    return true;
}



function user() {

    if (!validacija()) return;

    const myform = document.getElementById("form_add");
    const formdata = new FormData(myform);
    var files = $("#upload")[0].files[0];
    formdata.append("file", files);

    for (var pair of formdata.entries()) console.log(pair[0] + ', ' + pair[1]);
    console.log('');

    $.ajax({
        processData: false,
        contentType: false,
        type: 'post',
        url: 'api/register/user.php',
        data: formdata,

        success: function (response) {

            var data = JSON.parse(response);
            console.log(data);

            if (data.success === 1) {
                location.href = "login.php";
            } else {
                if (data.warningName == "false") showError(nameErr)
                if (data.warningSurname == "false") showError(surnameErr)
                if (data.warningUsername == "false") showError(usernameErr)
                if (data.warningEmail == "false") showError(emailErr)
                if (data.warningPassword == "false") showError(passwordErr)
                if (data.warningRepeatPassword == "false") showError(repeatPasswordErr)
                if (data.usernameReserved == '1') showErrorMessage(usernameErr, "Username is reserved!");
                if (data.emailReserved == '1') showErrorMessage(emailErr, "Email is reserved!");
            }

        }
    });
}

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

                    reader.addEventListener("load", function () {
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