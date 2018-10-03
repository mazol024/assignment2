"use strict";

/*Set Correct Date Ranges : checkIn Date  < checkOut Date*/
function changeSDay() {
    var d = $("#sday").val();
    $("#lday").val(d);
}
function changeSMonth() {
    var d = $("#smonth").val();
    $("#lmonth").val(d);
}
function changeSYear() {
    var d = $("#syear").val();
    $("#lyear").val(d);

}
function changeLDate() {
    var d = $("#sday").val();
    var m = $("#smonth").val();
    var y = $("#syear").val();

    var d2 = $("#lday").val();
    var m2 = $("#lmonth").val();
    var y2 = $("#lyear").val();
    var date1 = new Date(y,m,d);
    var date2 = new Date(y2,m2,d2);

    if (date2<date1) {
        $("#lday").attr("min",d);$("#lday").val(d);
        $("#lmonth").attr("min",m);$("#lmonth").val(m);
        $("#lyear").attr("min",y);$("#lyear").val(y);
    } else {
        $("#lyear").attr("min",2018);
        $("#lmonth").attr("min",1);
        $("#lday").attr("min",1);

    }


}

var Booking = (function () {
    var target;
    var pub = {};
    var sDay,sMonth,sYear,lDay,lMonth,lYear,today;
    var bookedRooms = [];
    var myStartDate, myLastDate;
    var allRooms = [];
    var nonfreeRooms = [];
    var myBooking = [];
    var oldCookie;
    var newCookie;
    var myObjectCookie=[];

      /*Set Current Dates in CheckIn/CheckOut dates input form */

    function setDates() {
        today = new Date();
        sDay = today.getDate(); lDay=sDay;
        sMonth = today.getMonth() + 1; lMonth=sMonth;
        sYear = today.getFullYear(); lYear=sYear;
        $("#sday").val(sDay);$("#lday").val(lDay);
        $("#smonth").val(sMonth);$("#lmonth").val(lMonth);
        $("#syear").val(sYear);$("#lyear").val(lYear);

    }

    /*Set cookies*/
    function setCookie() {
        oldCookie = Cookie.get('myBookingCookies');
        if (oldCookie != null) {
            if (oldCookie != "") {
                myObjectCookie = JSON.parse(oldCookie);
            }
        }
        /*console.log(myObjectCookie);*/
        myObjectCookie.push({"room": myBooking[0], "startDate":myBooking[1],"endDate":myBooking[2]});
        newCookie = JSON.stringify(myObjectCookie);
        Cookie.set("myBookingCookies", newCookie, "");
        myObjectCookie = [];
        myBooking = [];
    }

    /*Set my CheckIn/CheckOut period */
    function clicked(e) {
        e.preventDefault();
        var start = "<table><tr><th>Number</th><th>Room Type</th><th>Description</th><th>Price</th></tr>";
        var table ="";
        var end = "</table>";
        var i =0;
        var j=0;
        var d1 = $("#sday").val();
        var m1 = $("#smonth").val();
        var y1 = $("#syear").val();
        var d2 = $("#lday").val();
        var m2 = $("#lmonth").val();
        var y2 = $("#lyear").val();
        myStartDate = new Date(y1,m1-1,d1);
        myLastDate = new Date(y2,m2-1,d2);
        nonfreeRooms = [];
        for (i=0;i<bookedRooms.length;i++) {
            if (myStartDate > bookedRooms[i][2] || myLastDate < bookedRooms[i][1]) {

            } else {
                nonfreeRooms.push(bookedRooms[i][0]);
            }

        }
        for (i=0;i<allRooms.length;i++){

            if ( nonfreeRooms.indexOf(allRooms[i][0]) === -1 ) {
                table = table + "<tr class='roomforbooking'><td >" + allRooms[i][0] + "</td><td>" + allRooms[i][1] +
                    "</td><td>" + allRooms[i][2] + "</td><td>" + allRooms[i][3] + "</td></tr>";
            }
        }

    /*    console.log(nonfreeRooms);console.log(myStartDate);console.log(myLastDate);*/
        $("#booking").html(start+table+end);
        var a =$("tr.roomforbooking").click(bookIt);
        a.css("cursor","pointer");
    }

    /*Apply my CheckIn/CheckOut period to the list of available rooms */
    function parseRooms(data) {
        var start = "<table><tr><th></th><th>Number</th><th>Room Type</th><th>Description</th><th>Price</th></tr>";
        var table ="";
        var end = "</table>";
        $(data).find("hotelRoom").each(function () {
            var roomNumber =  $(this).find("number")[0].textContent ;
            var roomType = $(this).find("roomType")[0].textContent;
            var description = $(this).find("description")[0].textContent;
            var pricePerNight = $(this).find("pricePerNight")[0].textContent;
            allRooms.push([roomNumber,roomType,description,pricePerNight]);
         });
       /* console.log(allRooms);*/
    }

    /*Create array of already booked Rooms
    * filled from file roomBookings.xml not form cookies !!!
    *
    * */
    function parseBookings(data) {
        $(data).find("booking").each(function () {
            var roomNumber =  $(this).find("number")[0].textContent ;
            var clientName = $(this).find("name")[0].textContent;
            var checkIn  = $(this).find("checkin").get();
            var checkOut  = $(this).find("checkout").get();
            var d1 = checkIn[0].childNodes[1].textContent;
            var m1 = checkIn[0].childNodes[3].textContent;
            var y1 = checkIn[0].childNodes[5].textContent;
            var d2 = checkOut[0].childNodes[1].textContent;
            var m2 = checkOut[0].childNodes[3].textContent;
            var y2 = checkOut[0].childNodes[5].textContent;
            bookedRooms.push([roomNumber,new Date(y1,m1,d1),new Date(y2,m2,d2)
                ]);
        });
       /* console.log(bookedRooms);*/
    }

    /* Getting list of Rooms with decription*/
    function getRooms() {$.ajax({
        type: "GET",
        url: "rooms/hotelRooms.xml",
        cache: false,
        success: function (data) {
            parseRooms(data);
        }
    });
    }

    /*Getting list of Booked rooms with booking dates*/
    function getBookings() {$.ajax({
        type: "GET",
        url: "rooms/roomBookings.xml",
        cache: false,
        success: function (data) {
            parseBookings(data);
        }
    });
    }

    /* Make a booking from list of free rooms*/
    function bookIt(){
        var b =  $(this)[0].textContent.substring(0,3);
        myBooking.push(b);myBooking.push(myStartDate);myBooking.push(myLastDate);
        alert("You booked Room: "+b+ " \n Dates: \n CheckIn: "+ myStartDate.getDate()+"."+(myStartDate.getMonth()+1)+
            "."+myStartDate.getFullYear()
            +"   -   CheckOut: " + myLastDate.getDate()+"."+(myLastDate.getMonth()+1)+"."+myLastDate.getFullYear()) ;
        /*console.log(myBooking);*/
        setCookie();
    }
    pub.setup = function () {

        setDates();
        getBookings();
        getRooms();


        $("#checkdatebutton").click(clicked);
        $("#checkdatebutton").onsubmit = null;
        $("#checkpendings").click(function () {
            window.open("admin.php","","","");
            });

    };
    return pub;
}());

$(document).ready(Booking.setup);