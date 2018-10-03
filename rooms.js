"use strict";

/* Rooms descriptions from XML file*/

var Rooms = (function(){
    var pub = {};

    /*Display list of rooms and their text descriptions on screen */

    function parseRooms(data) {
        $(data).find("roomType").each(function () {
            var roomId =  $(this).find("id")[0].textContent ;
            var description = $(this).find("description")[0].textContent;
            var maxGuests = $(this).find("maxGuests")[0].textContent;
                $("[id='"+ roomId +"']").html(description + "<br> <p>Maximum Guests: " + maxGuests + "</p>");
    });
    }

    /*Retrieve data from xml file by using jQuery AJAX*/

    function showDescription() {$.ajax({
        type: "GET",
        url: "rooms/roomTypes.xml",
        cache: false,
        success: function (data) {
            parseRooms(data);
        }
    });
    }
    pub.setup = function() {
        showDescription();
    };
    return pub; }());

$(document).ready(Rooms.setup);
