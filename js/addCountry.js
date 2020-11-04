const myform = document.getElementById("addCountry-form");



function numberTaxi(numberTaxi) {
    const numberInput = $(numberTaxi);
    const phone = numberInput.val();
    let isValidPhone = phone.length > 3 && !isNaN(phone);
    inputColor(isValidPhone, numberInput);
    console.log("Broje validacije " + isValidPhone);
    return isValidPhone;
}

function isValidName() {
    var isValid = isValidText($("#name"));
    return isValid;
}

function isValidCountry() {
    var isValid = isValidText($("#country"));
    return isValid;
}

function isValidDesc() {
    return isValidText($("#description"));
}

function isValidNameTaxi(name) {
    return isValidText($(name));
}

function isValidText(inputOfValue) {
    const patternName = /[a-z ,.'-]+[0-9]*[,.!?-]*$/i;
    let isValid =
        inputOfValue.val().length > 2 && inputOfValue.val().match(patternName);
    inputColor(isValid, $(inputOfValue));
    return isValid;
}

$("#upload").on("change", () => change());

function change() {
    if ($("#upload")[0].files.length != 0) {
        const file = document.getElementById("upload").files[0];

        if (file) {
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

function inputColor(isValid, element) {
    if (isValid) {
        element.css("border-color", "#009900");
        element.css("border-width", "2px");
    } else {
        element.css("border-color", "#b70019");
        element.css("border-width", "2px");
    }
}

document.getElementById('addCity').addEventListener('click', function (event) {
    event.preventDefault();
    const taxies = document.getElementById("taxies");
    const numbers = taxies.getElementsByClassName("numberTaxiname");
    const namesOfTaxies = taxies.getElementsByClassName("nameTaxii");

    if (isValidDesc()) {
        for (let item of numbers) {
            console.log(item);
            if (!numberTaxi(item)) {
                swal(
                    "Enter the taxi number!",
                    "Number taxi not well entered",
                    "error"
                );
                return;
            }
        }
        for (let item of namesOfTaxies) {
            console.log(item);

            if (!isValidNameTaxi(item)) {
                swal("Enter the taxi name!", "Name taxi not well entered", "error");
                return;
            }
        }
        if (change()) {
            if ($('#addCountry input').hasClass('newCountry')) {
                (city != "") ? addCountry(): swal("Enter location!", "Location of city not well entered", "error");

            } else addCountry();

        } else change();

    } else {
        swal("Enter the description!", "Description of city not well entered", "error");
        return;
    }

});



function sendTaxiNumbers(formdata) {
    const taxies = document.getElementById("taxies");
    const numbers = taxies.getElementsByClassName("numberTaxiname");
    var arrayNumbers = [];
    for (let item of numbers) {
        arrayNumbers.push($(item).val());
    }
    formdata.append("taxiNumbers", JSON.stringify(arrayNumbers));
}

function sendNameTaxies(formdata) {
    const taxies = document.getElementById("taxies");
    const namesOfTaxies = taxies.getElementsByClassName("nameTaxii");
    var arrayNumbers = [];
    for (let item of namesOfTaxies) {
        arrayNumbers.push($(item).val());
    }
    formdata.append("taxiNames", JSON.stringify(arrayNumbers));
}







function addCountry() {

    const formdata = new FormData(myform);
    sendTaxiNumbers(formdata);
    sendNameTaxies(formdata);

    var files = $("#upload")[0].files[0];
    formdata.append("file", files);




    if ($('#addCountry input').hasClass('newCountry')) {
        formdata.append("lat", lat);
        formdata.append("lng", lng);
        formdata.append("nameD", city);
        formdata.append("country", country);

    }
    for (var pair of formdata.entries()) console.log(pair[0] + ', ' + pair[1]);
    console.log('');

    $.ajax({
        processData: false,
        contentType: false,
        type: "post",
        url: "api/addCountry/ajaxAddCountry.php",
        data: formdata,
        success: function (response) {
            var data = JSON.parse(response);
            console.log(data)
            if (data.continue == 1) {

                var idHotel = document.getElementById('mojID').value;
                console.log(idHotel)
                $.ajax({
                    type: "post",
                    url: "api/admin/updatePending.php",
                    data: {
                        id: idHotel
                    },
                    success: function (response) {
                        var data = JSON.parse(response);
                        console.log(data);

                        swal({
                                title: 'Success',
                                text: 'The city will be added to the base',
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
                        title: 'Success',
                        text: 'The city will be added to the base',
                        icon: 'success',
                        timer: 2000,
                        buttons: false,
                    })
                    .then(() => {
                        location.reload();
                    })

            }


        },
    });
}


$(document).ready(function () {

    var photo = $(".upload-picture-new").css("background-image");
    console.log(photo + "slika");


});