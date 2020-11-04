 ///Validation date
 var hotelsArray = new Array();


 function getDatePicker(id, hotelsID) {
     //  console.log(hotelsID);
     var arrayAsDateObjects = new Array();
     var daysOfYear = new Array();

     $.ajax({
         type: 'post',
         url: 'api/apartmanInfo/hotelReservations.php',
         data: {
             id: hotelsID
         },
         success: function (response) {
             var data = JSON.parse(response);
             console.log(data)
             for (let index = 0; index < data.reservations.length; index++) {
                 const reservation = data.reservations[index];

                 for (let d = new Date(reservation.from); d <= new Date(reservation.to); d.setDate(d.getDate() + 1)) {
                     daysOfYear.push(new Date(d).toISOString().slice(0, 10));
                 }
                 arrayAsDateObjects = convertStringToDateObject(daysOfYear);
                 console.log(arrayAsDateObjects)
             }
         }
     });

     function convertStringToDateObject(daysOfYear) {
         var ls = [];
         for (let index = 0; index < daysOfYear.length; index++) {
             var splitDate = daysOfYear[index].split("-");
             var date = new Date(splitDate[0], Number(splitDate[1]) - 1, splitDate[2]);
             ls.push(date);
         }
         ls.sort(function (a, b) {
             return a - b;
         });
         console.log(ls)

         return ls;
     }



     console.log($('#checkIn' + id))

     const today = new Date();

     $("#checkIn" + id).datepicker("option", "dateFormat", "yy-mm-dd");
     $("#checkOut" + id).datepicker("option", "dateFormat", "yy-mm-dd");

     $('#checkIn' + id).datepicker({
         forceParse: false,
         beforeShowDay: function (date) {
             var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
             return [daysOfYear.indexOf(string) == -1]
         },
         minDate: today,
         onClose: function () {
             $("#checkOut" + id).datepicker(
                 "change", {
                     minDate: getTomorrow(new Date($('#checkIn' + id).val())),
                 },
                 $("#checkOut" + id).datepicker("setDate", getTomorrow(new Date($('#checkIn' + id).val())))

             );

         },
         onSelect: function (date) {
             if (findNextDisabledDateWithinMonth(date) != 0) {
                 $("#checkOut" + id).datepicker("option", "maxDate", findNextDisabledDateWithinMonth(date));
             } else {
                 $("#checkOut" + id).datepicker("option", "maxDate", null);
             }

         }
     });

     function getTomorrow(date) {
         console.log(date)
         return new Date(date.getFullYear(), date.getMonth(), date.getDate() + 1);
     }

     function findNextDisabledDateWithinMonth(date) {
         var splitDate = date.split("/");
         var selectedDate = new Date();
         selectedDate.setDate(splitDate[1]);
         selectedDate.setMonth(Number(splitDate[0]) - 1);
         selectedDate.setFullYear(splitDate[2]);
         var nextDisabledDate = null;
         $.each(arrayAsDateObjects, function (i, ele) {
             if (selectedDate < ele) {
                 nextDisabledDate = ele;
                 return false;
             } else {
                 nextDisabledDate = 0;
             }
         });
         return nextDisabledDate;
     }


     $('#checkOut' + id).datepicker({
         beforeShowDay: function (date) {
             var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
             return [daysOfYear.indexOf(string) == -1]
         },
         minDate: today,

     });

 }


 function setMinToday() {

     const checkins = document.getElementsByClassName('checkin');
     const checkouts = document.getElementsByClassName('checkout');
     console.log(checkins);

     for (const checkin of checkins) {
         checkin.min = new Date().toISOString().split("T")[0];

     }
     for (const checkout of checkouts) {
         checkout.min = new Date().toISOString().split("T")[0];
     }
 }

 function updateMin(element) {
     const sibling = element.parentElement.nextElementSibling.querySelector("input");
     const button = element.parentElement.nextElementSibling.nextElementSibling;
     console.log(button);
     console.log(sibling)
     sibling.min = element.value.split("T")[0];
     isCheckInBefore(element, sibling, button);

 }


 function isCheckInBefore(element, sibling, button) {
     if ($(element).val() > $(sibling).val()) {
         swal(
             "Ne moze checkin biti poslije checkout-a!",
             "Probajte ponovo da ga unesete.",
             "error"
         );
         button.disabled = "true";
         return false;
     }
     button.disabled = false;
     return true;

 }





 function changeReservation(id) {
     $("#checkIn" + id).datepicker("option", "dateFormat", "yy-mm-dd");
     $("#checkOut" + id).datepicker("option", "dateFormat", "yy-mm-dd");
     $.ajax({
         type: "post",
         url: "api/booking/changeMyReservation.php",
         data: {
             checkIn: document.getElementById('checkIn' + id).value,
             checkOut: document.getElementById('checkOut' + id).value,
             id: id

         },

         success: function (response) {
             var data = JSON.parse(response);
             console.log(data);
             if (data.successChange == 1) {

                 swal({
                         title: 'Success',
                         text: 'The owner of the apartment will answer',
                         icon: 'success',
                         timer: 3000,
                         buttons: false,
                     })
                     .then(() => {
                         location.reload();
                     })

             }



         },
     });
 }





 ////Cancel reservation/////


 function cancelReservation(id) {
     swal({
             title: "Are you sure?",
             icon: "warning",
             buttons: true,
             dangerMode: true,
         })
         .then((willDelete) => {
             if (willDelete) {
                 $.ajax({
                     type: "post",
                     url: "api/booking/cancelReservation.php",
                     data: {
                         id: id
                     },
                     success: function (response) {
                         var data = JSON.parse(response);
                         console.log(data);
                         if (data.success == 1) {
                             swal({
                                     title: 'Success cancel',
                                     text: 'We will notify the owner',
                                     icon: 'success',
                                     timer: 3000,
                                     buttons: false,
                                 })
                                 .then(() => {
                                     location.reload();
                                 })
                         }

                     },
                 });
             } else {
                 swal("Your reservation is ok!");
             }
         });

 }



 //////////////// display map

 function displayMap(mapID) {
     const mapEl = document.getElementById(mapID);
     mapEl.style.opacity = 1;
     mapEl.style.zIndex = 1;

 }

 function displayNoneMap(mapID) {
     const mapEl = document.getElementById(mapID);
     mapEl.style.opacity = 0;
     mapEl.style.zIndex = -1;
 }


 ///////////////////////////REVIEW/////////////////////////////////
 function nameH() {

     var name = document.getElementById('title').value;
     var pattern = /[a-zA-Z]+[!?.,]*$/;

     if (name.length > 2 && name.length < 100 && name.match(pattern)) {
         document.getElementById('warningName').style.display = "none";
         return true;

     } else {
         document.getElementById('warningName').style.display = "inline-block";
         $(".war-name").attr("data-original-title", "Title must to contain letters and be shorter than 20.");
         return false;
     }
 }

 function descritpionF() {

     var name = document.getElementById('description').value;
     if (name.length > 2 && name.length < 900) {
         document.getElementById('warningDesc').style.display = "none";
         return true;

     } else {
         document.getElementById('warningDesc').style.display = "inline-block";
         $(".war-desc").attr("data-original-title", "Write description");
         return false;
     }
 }

 function validation() {

     console.log($('.location').is(':checked'));
     if ($('.service').is(':checked')) {
         if ($('.clean').is(':checked')) {
             if ($('.location').is(':checked')) {
                 if (nameH()) {
                     if (descritpionF()) {
                         return true;
                     } else swal("Incorrect description", "Write a description again.", "error");

                 } else swal("Incorrect title", "Write a title again.", "error");
             } else swal("Incorrect location", "Rate location again.", "error");
         } else swal("Incorrect cleanliness", "Rate cleanliness again.", "error");
     } else swal("Incorrect service", "Rate service again.", "error");
     return false;
 }


 function review(e) {
     e.preventDefault();
     const id = $('.review-img').data('id');
     const idHotel = $('.review-img').data('idhotel');
     console.log("idhotel" + idHotel)

     console.log(id);
     if (validation()) {
         const myform = document.getElementById("review-form");

         const formdata = new FormData(myform);
         formdata.append("idReservation", id);
         formdata.append("idHotel", idHotel);


         $.ajax({
             processData: false,
             contentType: false,
             type: "post",
             url: "api/review/review.php",
             data: formdata,
             success: function (response) {
                 var data = JSON.parse(response);
                 console.log(data);
                 if (data.success == 1) {
                     swal({
                             title: 'Success rating',
                             text: 'Your rating will be written next to the apartment',
                             icon: 'success',
                             timer: 3000,
                             buttons: false,
                         })
                         .then(() => {
                             location.reload();
                         })

                 }


             }
         });
     }
 }




 $(document).ready(function () {
     $('[data-toggle="tooltip"]').tooltip();



     //////AddEvent ako ima ulaznih parametara ne moze odmah da se pozove...
     //  location.nextElementSibling.addEventListener('mouseover',  arrowSpan(location); 
     const locations = document.getElementsByClassName('location');
     for (const location of locations) {
         location.nextElementSibling.addEventListener('mouseover', function () {
             arrowSpan(location);
         });
         location.nextElementSibling.addEventListener('mouseout', function () {
             arrowSpan($('input[name=location]:checked', '#review-form')[0])

         });
         arrowSpan($('input[name=location]:checked', '#review-form')[0])

     }

     const cleans = document.getElementsByClassName('clean');
     for (const clean of cleans) {
         clean.nextElementSibling.addEventListener('mouseover', function () {
             arrowSpan(clean);
         });
         clean.nextElementSibling.addEventListener('mouseout', function () {
             arrowSpan($('input[name=clean]:checked', '#review-form')[0])

         });
         arrowSpan($('input[name=clean]:checked', '#review-form')[0])

     }

     const services = document.getElementsByClassName('service');
     for (const service of services) {

         service.nextElementSibling.addEventListener('mouseout', function () {
             arrowSpan($('input[name=service]:checked', '#review-form')[0])

         });
         service.nextElementSibling.addEventListener('mouseover', function () {
             arrowSpan(service);
         });
         arrowSpan($('input[name=service]:checked', '#review-form')[0])

     }







 });


 function arrowSpan(input) {
     let star = $(input).val();
     const spanHtml = input.parentElement.nextElementSibling.children;
     const span = $(spanHtml)
     span.html("");
     switch (star) {
         case '1':
             span.append('Terrible');
             break;
         case '2':
             span.append('Poor');
             break;
         case '3':
             span.append('Average');
             break;
         case '4':
             span.append('Very good');
             break;
         default:
             span.append('Excellent');
     }

 }