$("#close").click(function () {
  $("#booking-form").trigger("reset");
});

$("#exampleModal").on("hidden.bs.modal", function () {
  $("#booking-form").trigger("reset");
});



// /////////////////////Data Validation///////////////////////////

const checkIn = document.getElementById("checkIn");
const checkOut = document.getElementById("checkOut");


function checkInFunction() {
  const checkInconst = $("#checkIn");
  console.log(checkInconst.val())
  return dataF(checkInconst);
}

function checkOutFunction() {
  const checkOut = $("#checkOut");
  return dataF(checkOut);
}

function dataF(checkInOut) {
  let isValidData = $(checkInOut).val() != "" ? true : false;
  inputColor(isValidData, $(checkInOut));

  return isValidData && isCheckInBefore();
}

function isCheckInBefore() {
  if ($("#checkIn").val() != "" && $("#checkOut").val() != "") {
    if ($("#checkIn").val() > $("#checkOut").val()) {
      swal(
        "Ne moze checkin biti poslije checkout-a!",
        "Probajte ponovo da ga unesete.",
        "error"
      );
      return false;
    } else {
      return true;
    }
  }

}

// ////////////////////////Filtliranje////////////////////////

function hotels() {
  var locations = document.getElementById("loc").value;
  console.log(locations);
  console.log("hej" + getStars());

  $.ajax({
    type: "post",
    url: "api/booking/ajaxBooking.php",
    data: {
      location: locations,
      stars: getStars(),
      adults: getSelectedAdults(),
    },
    success: function (response) {
      var data = JSON.parse(response);
      console.log(data)

      var hotels = data.hotels;
      console.log(hotels);
      console.log("adults" + data.adults);
      console.log(" zvijezda" + data.stars);
      console.log("broj zvijezda" + getStars());
      console.log("query" + data.query);
      var html = "";




      for (var i = 0; i < hotels.length; i++) {


        if (hotels[i].pending == 0) {
          const hotel = hotels[i];

          let stars = "";


          for (let index = 0; index < hotel.stars; index++) {
            stars += `<div class="d-flex stars"><img class="star" alt="" src="images/star.svg"></div>`
          }

          let image = "";

          for (let i = 0; i < hotel.images.length; i++) {
            if (hotel.images[i] != "") {
              image = hotel.images[i];
              break;
            }
          }
          console.log(hotel.id)
          console.log('hotel')



          html += `<div class="mb-4">
                      <div class="card-body">
                          <div class="myCard row p-0 d-flex">
                              <div class="col-lg-4 col-md-5 p-0 d-flex" style="align-self:stretch;">
                                  <img class="img-fluid mb-3 mb-md-0 sizeI h-100" alt="" src="images/objectsImages/${image}">
                              </div>
                              <div class="col-lg-8 col-md-7 position-relative py-3 px-4">
                                  <div class="card-between">
                                      <div class="cardTop">
                                          <div class="d-flex justify-content-between align-items-center">
                                              <div class="d-flex align-items-center"><h2 class="titleHotel mr-4 mb-0">${hotel.name}</h2>${stars}</div>
                                              <div id="calculatedPrice">${hotel.price}€</div>
                                          </div> 
                                          <div class="cityName">${hotel.street}</div>
                                          <div class="mt-3">
                                              ${hotel.description.replace(/^(.{200}[^\s]*).*/, "$1")}...
                                          </div>
                                      </div>
                                      <div class="cardBottom">
                                            <button onclick="location.href='apartmanInfo.php?id=${hotel.id}'" class="btn btn-primary">View Hotel<span class="glyphicon glyphicon-chevron-right"></span></button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <input id="getID" type="hidden" value="' + hotels[i].id + '">
                  </div>
                  `;
          html += " <hr>";
        }
      }
      if (hotels.length === 0) {
        $('#bg-not-found').addClass("bg-not-found");
      } else {
        $('#bg-not-found').removeClass("bg-not-found");

      }
      document.getElementById("cardHotel").innerHTML = html;
    },
  });
}

//////////////////Reservation//////////////////////


function reservation() {
  $('.loader-disable').hide();
  $('#loader-gif').show();
  console.log(price())
  $("#checkIn").datepicker("option", "dateFormat", "yy-mm-dd");
  $("#checkOut").datepicker("option", "dateFormat", "yy-mm-dd");
  $.ajax({
    type: "post",
    url: "api/booking/reservation.php",
    data: {
      checkIn: $('#checkIn').val(),
      checkOut: $('#checkOut').val(),
      name: document.getElementById("name").value,
      surname: document.getElementById("surname").value,
      phone: document.getElementById("phone").value,
      email: sessionStorage.getItem('email'),
      idHotel: idHotel,
      price: price()
    },
    success: function (response) {
      var data = JSON.parse(response);
      console.log("data");
      console.log(data);
      if (data.success == 1) {
        swal({
            title: 'Success',
            text: 'Successfuly reservation...',
            icon: 'success',
            timer: 1000,
            buttons: false,
          })
          .then(() => {
            location.reload();
          })
        $("#booking-form").trigger("reset");
        $('#exampleModal').modal('toggle');

      }
    },
  });
}

//////////////Buttton for User/////////

function ajaxUserReservation() {
  $.ajax({
    type: "get",
    url: "api/login/login.php",

    success: function (response) {
      var data = JSON.parse(response);
      console.log(data);
      document.getElementById("name").value = data.login[0].name;
      document.getElementById("surname").value = data.login[0].surname;

    },
  });
}

////////////////////Validations/////////////

function tel() {
  const phoneInput = $("#phone");
  const phone = phoneInput.val();
  let isValidPhone = phone.length > 4 && !isNaN(phone);
  inputColor(isValidPhone, phoneInput);
  return isValidPhone;
}

function isValidName() {
  const name = $("#name");
  return isValidNameSurname(name);
}

function isValidSurname() {
  const surname = $("#surname");
  return isValidNameSurname(surname);
}

//Name and surname
function isValidNameSurname(nameSurnm) {
  const patternName = /^[a-z ,.'-]+$/i;
  let isValidName =
    nameSurnm.val().length > 2 && nameSurnm.val().match(patternName);
  inputColor(isValidName, $(nameSurnm));
  return isValidName;
}

// function emailF() {
//   const emailInput = $("#email");
//   const emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//   let isValidEmail = emailRegex.test(emailInput.val());
//   inputColor(isValidEmail, emailInput);

//   return isValidEmail;
// }

////////////Function for color inputs////////////////

function inputColor(isValid, element) {
  if (isValid) {
    element.css("border-color", "#009900");
  } else {
    element.css("border-color", "#b70019");
  }
}

///////////////////Validation end/////////////////////

function validation() {
  if (isValidName()) {
    if (isValidSurname()) {
      if (tel()) {
        if (checkInFunction()) {
          if (checkOutFunction()) {

            reservation();


          } else {
            swal(
              "Nije polje check out dobro!",
              "Probajte ponovo da ga unesete.",
              "error"
            );
          }
        } else {
          swal(
            "Nije polje check in dobro!",
            "Probajte ponovo da ga unesete.",
            "error"
          );
        }

      } else {
        swal(
          "Nije polje telefon dobro!",
          "Probajte ponovo da ga unesete.",
          "error"
        );
      }
    } else {
      swal(
        "Nije polje prezime dobro!",
        "Probajte ponovo da ga unesete.",
        "error"
      );
    }
  } else {
    swal("Nije polje ime dobro!", "Probajte ponovo da ga unesete.", "error");
  }
}



////