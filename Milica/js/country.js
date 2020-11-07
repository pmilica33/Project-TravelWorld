$(document).ready(function () {
    $.ajax({
        type: 'get',
        url: 'api/countryInfo/countryInfo.php?id=' + idCountry,
        data: {
            comment: document.getElementById('comment').value,
            idCountry: idCountry,
        },

        success: function (response) {

            var data = JSON.parse(response);
            console.log(data);
            ajaxCommentLoad();
            var html = '';
            var country = data.country;
            html += `<div style="position:relative;height:500px">
                        <img style="object-fit:cover;height:100%;" id="img" src="images/countryImages/${country.photo}">
                        <div class="path1"></div>
                        <div class="cardweather" id="cardweather" style="position:absolute; right:10vw; bottom:5vw; ">
                            <div class="d-flex justify-content-between">
                                <div class="mr-4">
                                    <div class="weather-icons ml-lg-1">
                                        <img id="my_image" src="" alt="" />
                                        <span class="text-light" id="descriptionWeather" name="descriptionWeather">
                                    </div>
                                    <h1 class="h1Weather" id="weatherCel"></h1>
                                </div>
                                <div>
                                    <div class="date text-light">
                                        <h3 class="h3Weather" id="timeCur"></h3>
                                        <p id="dateY"></p>
                                    </div>
                                    <p class="cityWeather" id="cityName"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center mx-auto mt-5">
                        <div class="grid-text">
                            <div class="grid-text-inner">
                                <h2 class="card-title opacity-7" id="name">${country.name}</h2>
                                <p class="card-text opacity-7" id="description">${country.description}</p>
                            </div>
                        </div>
                        <div class="mt-5 text-center">`

            var countryName = country.country;

            fetch('api/json/data.json')
                .then((response) => {
                    return response.json();
                })
                .then((myJson) => {
                    console.log(myJson);
                    console.log(countryName);

                    for (var i = 0; i < myJson.data.length; i++) {

                        if (myJson.data[i].Country.Name === countryName) {

                            console.log(myJson.data[i].Fire.All);

                            if (myJson.data[i].Fire.All[0] != '' && myJson.data[i].Fire.All[0] != null ||
                                myJson.data[i].Police.All[0] != '' && myJson.data[i].Police.All[0] != null ||
                                myJson.data[i].Ambulance.All[0] != '' && myJson.data[i].Ambulance.All[0] != null) {
                                html += `<h2 class="opacity-7  pt-3 mb-5">Emergencies Numbers</h2>
                                            <div class="emergency-cards">`;
                            }

                            if (myJson.data[i].Fire.All[0] != '' && myJson.data[i].Fire.All[0] != null) {

                                for (var j = 0; j < myJson.data[i].Fire.All.length; j++) {


                                    html += `   <div class="card emer">
                                                    <img src="images/vatrogasac.png" id="vatrogasac" style="margin-top:10px">
                                                    <h4 class="opacity-7">FIRE</h4>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <i class = "fas fa-phone"></i>
                                                        <a class="ml-2" href="${myJson.data[i].Fire.All[j]}" id="roadside">${myJson.data[i].Fire.All[j]}</a>
                                                    </div>
                                                </div>`;
                                }

                            }

                            if (myJson.data[i].Police.All[0] != '' && myJson.data[i].Police.All[0] != null) {


                                for (var v = 0; v < myJson.data[i].Police.All.length; v++) {
                                    html += `<div class="card emer">
                                                    <img src="images/policajac.png" id="polcajac">
                                                    <h4 class="opacity-7">POLICE</h4>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-phone"></i>
                                                        <span id="police" class="ml-2">${myJson.data[i].Police.All[v]}</span>
                                                    </div>
                                                </div>
                                            `


                                }
                            }


                            if (myJson.data[i].Ambulance.All[0] != '' && myJson.data[i].Ambulance.All[0] != null) {

                                for (var m = 0; m < myJson.data[i].Ambulance.All.length; m++) {
                                    html += '<div class="card emer">'

                                    html += '<img src="images/doktorka.png" id="doktorka" style="margin-top:26px">'
                                    html += '<h4 class="opacity-7" style="margin-top:-5px  ">EMERGECIES</h4>';
                                    html += '<div class="d-flex align-items-center justify-content-center">';


                                    html += '<i class="fas fa-phone"></i>';


                                    html += '<span id="emergencies" class="ml-2"> ' + myJson.data[i].Ambulance.All[m] + '</span>';
                                    html += '</div>';
                                    html += '</div>';


                                }
                            }
                        }
                    }
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                    html += '<h2 class="opacity-7  pt-4 text-center mb-4">Find Hotel</h2>';


                    html += '<div class="findHotels mt-3 d-flex align-items-center ">';
                    html += `     <div class="button-transparent mx-auto">
                                    <a href="http://localhost/Milica/booking.php?name=${country.name}"
                                    class = "d-flex justify-content-around align-items-center" > Find hotel <svg
                                      xmlns="http://www.w3.org/2000/svg" width="17.07" height="12" viewBox="0 0 17.07 12">
                                        <defs>
                                        <style>
                                            .cls-1 {
                                            fill: #fff
                                            }
                                        </style>
                                        </defs>
                                        <path id="left-arrow_2_"
                                        d="M5.567 4.856a.605.605 0 1 1 .86.851l-4.361 4.362h14.392a.606.606 0 0 1 .611.6.613.613 0 0 1-.611.611H2.066l4.361 4.353a.617.617 0 0 1 0 .86.6.6 0 0 1-.86 0L.174 11.1a.607.607 0 0 1 0-.851z"
                                        class="cls-1" data-name="left-arrow (2)" transform="rotate(180 8.534 8.338)" />
                                    </svg>
                                    </a>
                                </div>`;

                    html += '</div>';
                    if (country.taxies.length != 0) {
                        html += ' <h2 class="opacity-7 mt-2 pt-5 text-center mb-5">Taxies numbers</h2>';

                    }

                    for (var i = 0; i < country.taxies.length; i++) {

                        html += '<div class="grid-text" style="font-size:14px"><div class="card grid-text-inner" cursor:pointer">'
                        html += '<div class=" d-flex justify-content-center align-items-center">';
                        html += `<span class="card-text mr-3" ><i class="fas fa-phone mr-2"></i> ${country.taxies[i].name}: ${country.taxies[i].number}</span>`;
                        html += '</div></div>';


                        html += '</div>';

                    }

                    document.getElementById('card').innerHTML = html;
                });

        }
    });
})

function ajaxComment() {
    $.ajax({
        type: 'post',
        url: 'api/comment/ajaxComment.php',
        data: {
            comment: document.getElementById('comment').value,
            idCountry: idCountry,
        },

        success: function (response) {

            var data = JSON.parse(response);
            console.log(data);
            ajaxCommentLoad();

        }
    });
}

function ajaxCommentLoad() {
    $.ajax({
        type: 'post',
        url: 'api/comment/ajaxCommentLoad.php',
        data: {
            idCountry: idCountry,
        },

        success: function (response) {

            var data = JSON.parse(response);
            console.log(data);
            var comments = data.comment;
            var string = '';
            for (let i = 0; i < comments.length; i++) {

                const dateTime = comments[i].date.split(" ");
                const date = dateTime[0];
                const time = dateTime[1];

                string += `<div class="commentSection">
                                <img src="images/users/${comments[i].photo}" alt="">`;
                if (idUser == comments[i].idUser || idUser === 1) {
                    string += ` <span  onclick="ajaxDeleteComment(${comments[i].id})" class="close">&times;</span>`;
                }
                string += ` <div class="commentContent">${comments[i].description}</div>

                                <div class="commentator mt-2 d-flex flex-column">
                                    <div class="comName">${comments[i].name} ${comments[i].surname}</div>
                                    <div class="comTime">${date} at ${time}</div>
                                </div>
                            </div>`;

            }
            document.getElementById('oneComment').innerHTML = string;
            document.getElementById('comment').value = '';



        }
    });
}

function ajaxDeleteComment(id) {
    swal({
            title: "Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'post',
                    url: 'api/comment/deleteComment.php',
                    data: {
                        idCountry: idCountry,
                        id: id,
                    },

                    success: function (response) {

                        var data = JSON.parse(response);
                        console.log(data);
                        ajaxCommentLoad();


                    }
                });
            } else {
                swal("your comment has not been deleted!");
            }
        });
}




$(document).ready(function () {
    $.ajax({
        type: 'post',
        url: 'api/countryInfo/weather.php',
        data: {
            idCountry: idCountry,
        },
        success: function (response) {

            var bla = JSON.parse(response);
            var name = bla.name;
            console.log(name);

            $.ajax({
                type: 'get',
                dataType: 'jsonp',
                url: 'http://api.openweathermap.org/data/2.5/weather?q=' + name + '&APPID=95ac4f7c986a4d920cff3e619b4c39fb&units=metric',

                success: function (data) {
                    var cel = data.main.temp;
                    document.getElementById('weatherCel').innerHTML = Math.round(data.main.temp) + '°';
                    document.getElementById('cityName').innerHTML = name;
                    document.getElementById('descriptionWeather').innerHTML = data.weather[0].main;
                    var date = new Date($.now());
                    document.getElementById('timeCur').innerHTML = date.getHours() + ":" +
                        date.getMinutes() + ":" +
                        date.getSeconds();
                    var days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
                    document.getElementById('dateY').innerHTML = days[date.getDay()] + " " + date.getDate() + '.' + date.getMonth() + '.' + date.getFullYear();
                    if (data.weather[0].main === 'Clouds') {
                        $("#my_image").attr("src", "images/sunny.png");
                    } else if (data.weather[0].main === 'Clear') {
                        $("#my_image").attr("src", "images/sunny-day (1).png");

                    } else if (data.weather[0].main === 'Rain') {
                        $("#my_image").attr("src", "images/rain.png");
                    } else {
                        $("#my_image").attr("src", "images/cloud.png");
                    }
                    console.log(data);
                    const lat = data.coord.lat;
                    const lon = data.coord.lon;
                    initMap(lat, lon);

                }
            });


        }
    });

})

function initMap(lat, lon) {

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