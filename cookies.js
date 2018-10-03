"use strict";

var pendinghours = 0;

/*Cookies created with expire times in Hours or 0*/

var Cookie = (function () {
    var pub = {};
    pub.set = function (name, value, seconds) {
        var date, expires;
        if (pendinghours === 0) {
            expires = "";
        } else {
            alert("Your booking on pending, hours: " + pendinghours);
            date = new Date();
            date.setHours(date.getHours() + parseInt(pendinghours));
            date = new Date(date);
            expires =   "; expires=" + date.toUTCString();
        }

        document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
   /*     console.log("cookie:  "+ encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/");*/
    };

    /*Getting cookies*/

    pub.get = function (name) {
        var nameEq, cookies, cookie, i;
        nameEq = encodeURIComponent(name) + "=";
        cookies =  document.cookie.split(";");
        for (i = 0; i < cookies.length; i += 1) {
            cookie = cookies[i].trim();
            if (cookie.indexOf(nameEq) === 0)
            {
                return decodeURIComponent(cookie.substring(nameEq.length, cookie.length));
            }
        }
        return null;
    };

    /*Clearing cookies*/

    pub.clear = function (name) {
        pub.set(name, "", -1);
    };
    return pub;
}());

function pendinHours(){
    pendinghours = $("#pendinghours").val();

}