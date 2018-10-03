"use strict";

/* Show/Hide Animation rooms images with their descriptions*/

var showHide = (function () {
    var target;
    var pub = {};
    function clicked(e) {
        $(this).children(".description").toggle(1800);
    }
    pub.setup = function () {
        target = $(".room").click(clicked);
        target.css("cursor","pointer");
    };
    return pub;
}());

$(document).ready(showHide.setup);