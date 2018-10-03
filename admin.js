"use strict";

/*Show booked rooms saved in cookies */

var mybookings = (function () {
    var myObj = [];
    var myString;
    var i;
    var pub = {};


    function parseBookings(data) {
        var start = "<table><tr><th>Number</th><th>Client Name</th><th>Start Date</th><th>End Date</th></tr>";
        var table = "";
        var end = "</table>";
        $(data).find("booking").each(function () {
            var roomNumber =  $(this).find("number")[0].textContent ;
            var clientName = $(this).find("name")[0].textContent;
            var checkIn  = $(this).find("checkin").get();
            var checkOut  = $(this).find("checkout").get();
            var d1 = checkIn[0].childNodes[1].textContent;
            var m1 = checkIn[0].childNodes[3].textContent;m1 = parseInt(m1)+1;
            var y1 = checkIn[0].childNodes[5].textContent;
            var d2 = checkOut[0].childNodes[1].textContent;
            var m2 = checkOut[0].childNodes[3].textContent;m2 = parseInt(m2)+1;
            var y2 = checkOut[0].childNodes[5].textContent;
            table = table + "<tr ><td>" + roomNumber + "</td><td>"+ clientName + "</td><td>" +
                d1+ "." + m1 + "." + y1+
                "</td><td>" + d2 + "." + m2 +"." + y2 +"</td></tr>";

        });

        $("#showbookings").append("<br>Booked rooms:" +start + table + end);
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


    pub.setup = function () {
        getBookings();
        myString = Cookie.get("myBookingCookies");
        myObj = JSON.parse(myString);
        var start = "<table><tr><th>Number</th><th>Start Date</th><th>End Date</th></tr>";
        var table = "";
        var end = "</table>";
        for (i = 0; i < myObj.length; i++) {
            var s = new Date(myObj[i]["startDate"]);
            var sd = s.getDate() + "." + (s.getMonth() + 1) + "." + s.getFullYear();
            var e = new Date(myObj[i]["endDate"]);
            var ed = e.getDate() + "." + (e.getMonth() + 1) + "." + e.getFullYear();
            table = table + "<tr ><td>" + myObj[i]["room"] + "</td><td>" + sd +
                "</td><td>" + ed + "</td></tr>";
        }
        $("#showbookings").html("<br>Bookings on pending:" +start + table + end+"<br><hr>");


    };
    return pub;
}());
$(document).ready(mybookings.setup);
