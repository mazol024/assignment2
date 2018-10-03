"use strict";

/*Animated view of Hotel Isabel main page */
var Carousel = (function(){
    var pub = {};
    var hotelView = []; var viewIndex = 0;
    function nextObject() {
        $(".descriptionHotel").html(hotelView[viewIndex].makeHTML());
        viewIndex += 1;
        if (viewIndex >= hotelView.length) {
            viewIndex = 0;
        }
        $("#pict1").fadeToggle(3500);
        /*$("img").fadeIn(1000);*/
        /*$(".descriptionHotel").animate({opacity:0},3500,'swing');*/

    }

    /*Generating image tags for presentation*/

    function HotelObjects(title, image) { this.title = title;
        this.image = image;
        this.makeHTML = function() {
            return "<section>" +
                "<img id='pict1' src=" + this.image + " width=622px height=415px > </img>" + "<p>" + this.title + "</p>" + "</section>";
        }; }

    /*Creating array of Hotel images with short description texts*/

    pub.setup = function() {
        hotelView.push(new HotelObjects("<em>Old  Facade. View from Main Entrance.</em>",
            "images/hotel_isabel.jpg"));
        hotelView.push(new HotelObjects("<em>Restaurant 'Isabel'. European and Asian Menu, Fresh Drinks.</em>",
        "images/hotel_isabel1.jpg"));
        hotelView.push(new HotelObjects("<em>Historical photo of the Town.</em>",
            "images/hotel_isabel2.jpg"));
        nextObject();
        setInterval(nextObject, 3000);
    };
    return pub; }());



$(document).ready(Carousel.setup);

