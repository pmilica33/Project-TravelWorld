///////Get Cities and lan and lon //////
let lat = "";
let ltn = "";
let city = "";
var country_list = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Anguilla", "Antigua &amp; Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia &amp; Herzegovina", "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Cape Verde", "Cayman Islands", "Chad", "Chile", "China", "Colombia", "Congo", "Cook Islands", "Costa Rica", "Cote D Ivoire", "Croatia", "Cruise Ship", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Estonia", "Ethiopia", "Falkland Islands", "Faroe Islands", "Fiji", "Finland", "France", "French Polynesia", "French West Indies", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kuwait", "Kyrgyz Republic", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Mauritania", "Mauritius", "Mexico", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Namibia", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Norway", "Oman", "Pakistan", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russia", "Rwanda", "Saint Pierre &amp; Miquelon", "Samoa", "San Marino", "Satellite", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "South Africa", "South Korea", "Spain", "Sri Lanka", "St Kitts &amp; Nevis", "St Lucia", "St Vincent", "St. Lucia", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor L'Este", "Togo", "Tonga", "Trinidad &amp; Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks &amp; Caicos", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "Uruguay", "Uzbekistan", "Venezuela", "Vietnam", "Virgin Islands (US)", "Yemen", "Zambia", "Zimbabwe"];



$(function () {

    $('#adults').niceSelect();
    let zero = `<option disabled selected value="0">Select country...</option>`
    let list = $("#country");
    list.append(zero);
    for (const country of country_list) {
        list.append(new Option(country, country));
    }
    $('#country').select2();


});

/////////////Maps/////////////////////

function getLatLon(element) {
    const country = element.value;


    document.getElementById("adress").disabled = false;
    document.getElementById("adress").blur();
    setTimeout(function () {
        $("#adress").val('')
        document.getElementById("adress").focus();
    }, 10);

    $.ajax({
        type: 'get',
        url: 'api/json/short_country.json',

        success: function (response) {
            let short = ""

            for (let item of Object.entries(response)) {
                if (item[1] == country) {
                    short = item[0];

                }
            }
            console.log(short)

            var autocomplete;
            autocomplete = new google.maps.places.Autocomplete((document.getElementById('adress')), {
                types: ['geocode'],
                componentRestrictions: {
                    country: short
                }
            })

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                const near_place = autocomplete.getPlace();
                lat = near_place.geometry.location.lat();
                lng = near_place.geometry.location.lng();
                console.log((near_place))
                console.log((lng))
                console.log(near_place.adr_address)

                city = near_place.address_components[0].long_name;
                console.log(city)


                map(lat, lng);
                document.getElementById("map").style.display = "block";
            });
        }
    });
}

function map(lat, lon) {
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



//////////////////////Validation////////////////////

function nameH() {

    var name = document.getElementById('name').value;
    var pattern = /[a-zA-Z]+$/;

    if (name.length > 2 && name.length < 20 && name.match(pattern)) {
        document.getElementById('warningName').style.display = "none";
        return true;

    } else {
        document.getElementById('warningName').style.display = "inline-block";
        $(".war-name").attr("data-original-title", "The name field should contain letters.");
        return false;
    }
}

function descritpionF() {

    var name = document.getElementById('description').value;
    if (name.length > 2 && name.length < 1000) {
        document.getElementById('warningDesc').style.display = "none";
        return true;

    } else {
        document.getElementById('warningDesc').style.display = "inline-block";
        $(".war-desc").attr("data-original-title", "Write a short description of the apartment");
        return false;
    }
}


function webSite() {
    var web = document.getElementById('web').value;
    var re = new RegExp("^(http|https)://", "i");
    if (web.length > 2 && re.test(web)) {
        document.getElementById('warningWeb').style.display = "none";
        return true;

    } else {
        document.getElementById('warningWeb').style.display = "inline-block";
        $(".war-web").attr("data-original-title", "It has to start with http/https");
        return false;
    }
}

function citySelect() {

    select = document.getElementById('country');
    console.log(" vrijednost" + select.value);
    if (select.value != 0) {
        document.getElementById('warningCity').style.display = "none";
        return true;
    } else {
        document.getElementById('warningCity').style.display = "inline-block";
        $(".war-city").attr("data-original-title", "A location must be selected");
        return false;
    }

}

function priceP() {

    var price = document.getElementById('price').value;
    console.log(price);


    if (price.length != 0) {
        document.getElementById('warningPrice').style.display = "none";
        return true;

    } else {
        document.getElementById('warningPrice').style.display = "inline-block";
        $(".war-price").attr("data-original-title", "You must enter a price for the property");
        return false;
    }
}



function maxAdults() {

    if ($("#adults option:selected").val() == "0") {
        document.getElementById('warningAdults').style.display = "inline-block";
        $(".war-adults").attr("data-original-title", "You must select a max persons");

        return false;
    } else {
        document.getElementById('warningAdults').style.display = "none";

        return true;
    }

}

function phoneF() {

    var phone = document.getElementById('phone').value;
    console.log(phone.length);


    if (phone.length != 0) {
        document.getElementById('warningPhone').style.display = "none";


        return true;

    } else {
        document.getElementById('warningPhone').style.display = "inline-block";
        $(".war-phone").attr("data-original-title", "You must enter a phone");


        return false;
    }
}

////////////////////////FILE////////////////////////////


function change(upload, input) {
    if ($(input)[0].files.length != 0) {
        const file = document.getElementById(upload).files[0];
        if (file) {
            if (file.size < 2097152) {
                if (
                    file.type === "image/png" ||
                    file.type === "image/jpg" ||
                    file.type === "image/jpeg"
                ) {
                    const reader = new FileReader();

                    reader.addEventListener("load", function () {
                        const parent = input.parentElement;
                        console.log(parent);

                        $(parent).css(
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
                    input.value = "";
                    return false;
                }
            } else {
                swal(
                    "Re-enter a image!",
                    "Max size image is 2MB",
                    "error"
                );
                input.value = "";
                return false;
            }
        }
    } else {
        swal("Post a image!", "Empty image field.", "error");
    }
}

///////////////////////////Final function///////////////////////

function addHotel(e) {
    e.preventDefault();
    if (nameH()) {
        console.log('heeeeeeej')
        if (descritpionF()) {
            if (citySelect()) {
                if (priceP()) {
                    if (maxAdults()) {
                        if (phoneF()) {
                            if (image()) {
                                if (document.getElementById("map").style.display == "block") {
                                    if ($('.star').is(':checked')) {

                                        ajaxAddObject();

                                    } else swal("Number of stars!", "You did not check stard", "error");

                                } else swal("Enter a location!", "You did not enter a location", "error");
                            }
                        } else swal("Enter a phone!", "You did not enter a phone", "error");

                    } else swal("Enter a max adults!", "You did not select max adults", "error");

                } else swal("Enter a price!", "You did not enter a price", "error");

            } else swal("Enter a country!", "You did not select a country", "error");
        } else swal("Enter a description!", "You did not enter a description", "error");
    } else swal("Enter a name!", "You did not enter a name", "error");

}

function image() {
    const slike = document.getElementsByClassName('slike');
    let empty = [];
    for (const slika of slike) {
        if (slika.value == '') {
            empty.push("prazan");
        }
    }
    console.log(empty);
    if (empty.length > 2) {
        swal(
            "You must enter at least two images!",
            "Enter images to complete the post.",
            "error"
        );
        return false;
    } else {
        return true;
    }
}



function ajaxAddObject() {
    const myform = document.getElementById("postObject-form");
    const formdata = new FormData(myform);
    formdata.append("lat", lat);
    formdata.append("lon", lng);
    formdata.append("city", city)
    //Display the key / value pairs
    for (var pair of formdata.entries()) console.log(pair[0] + ', ' + pair[1]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'post',
        url: 'api/postObject/insertObject.php',
        data: formdata,

        success: function (response) {

            var data = JSON.parse(response);
            console.log(data);

            swal({
                    title: 'Success',
                    text: 'Your apartment will be accepted by the admin...',
                    icon: 'success',
                    timer: 3000,
                    buttons: false,
                })
                .then(() => {
                    location.reload();
                })

        }
    });
}



$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
$('.star').on("click", function () {
    console.log($('.star').is(':checked'))

})