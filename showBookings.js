"use strict";

/* Retrieving and displaying rooms currently booked and stored in cookies */

var showBookings = (function () {
    var myObj = [];
    var myString;
    var i;
    var pub = {};
    pub.setup = function () {
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
            table = table + "<tr ><td>" + myObj[i]["room"] + "</td><td>" + sd + "</td><td>" + ed + "</td></tr>";
        }
        $("#showcookies").html(start + table + end);
        return pub;
    };
}());

$(document).ready(showBookings.setup);