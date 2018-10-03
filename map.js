"use strict";

/*Creating and putting on map all objects of interest*/

var Map = (function(){
    var pub = {};
    var map;
    var centralMarker,northMarker,southMarker,westMarker,eastMarker;
    var gallery;
    var contacts,f,title,activity;
    var markerLocation, markerBounds, markerMuseum;
    var showA = false;
    var showC = false;

    function onMapClick(e) {
        /*Handy for choosing coordinates on Map*/
        /*alert("You clicked the map at " + e.latlng);*/
    }

    /*Display or Hide points of interests*/

    function showHActivity() {
        if (showA === true){
            $(".activity").hide();
            showA = false;
        } else {
            $(".activity").show();
            showA = true;
        }
        if (showA === true) {
            westMarker = L.marker([21.297615, 202.160504]).addTo(map);
            westMarker.bindPopup("<section > " +
                "<img src=images/art-shop.jpg alt=ART-shop width='96px'>" +
                "<p style='overflow: auto;vertical-align: top'>ART-shop " +
                " 'Blue Sea'</p></section>"
            );

            gallery = L.marker([21.300498, 202.169866]).addTo(map);
            gallery.bindPopup("<section > " +
                "<img src=images/gallery.jpg alt=gallery width='48px'>" +
                "<p style='overflow: auto;vertical-align: top'>Pasific Gallery of Fine Arts</p></section>"
            );
            markerMuseum = L.marker([21.29466, 202.166509]).addTo(map);
            markerMuseum.bindPopup("<section > " +
                "<img src=images/museum.jpg alt=gallery width='72px'>" +
                "<p style='overflow: auto;vertical-align: top'>Museum of industry </p></section>"
            );
        } else {
            westMarker.remove();
            gallery.remove();
            markerMuseum.remove();
        }
    }

    /*Display or Hide points of food/eating */

    function showHContacts() {
        if (showC === true){
            $(".contact").hide();
            showC = false;
        } else {
            $(".contact").show();
            showC = true;
        }
        if (showC === true) {
            northMarker = L.marker([21.298933, 202.163655]).addTo(map);
            northMarker.bindPopup("<section >" +
                "<img src=images/bar.jpg alt=Bar width='96px'>" +
                "<p style='overflow: auto;vertical-align: top'>Bar " +
                " 'Popeye the Sailor' </p></section>"
            );
            southMarker = L.marker([21.295296, 202.162478]).addTo(map);
            southMarker.bindPopup("<section > " +
                "<img src=images/italiancafe.jpg alt=Cafe width='96px'>" +
                "<p style='overflow: auto;vertical-align: top'>Cafe " +
                " 'Mamma Mia Cafe'</p></section>"
            );

            eastMarker = L.marker([21.295896, 202.16707]).addTo(map);
            eastMarker.bindPopup("<section > " +
                "<img src=images/restaurant.jpg alt=Restaurant width='96px'>" +
                "<p style='overflow: auto;vertical-align: top'>Restaurant " +
                " 'Old Oak Deck'</p></section>"
            );
        } else {
            northMarker.remove();
            southMarker.remove();
            eastMarker.remove();
        }
    }

    /*Redraw map with centered point of interest */

    function centreMap(e) {
        if (this.textContent === "Hotel") {
            markerLocation = [centralMarker.getLatLng()];
            markerBounds = L.latLngBounds(markerLocation);
            map.fitBounds(markerBounds);
        }
        if (this.textContent === "Bar") {
            markerLocation = [northMarker.getLatLng()];
            markerBounds = L.latLngBounds(markerLocation);
            map.fitBounds(markerBounds);
        }
        if (this.textContent === "Cafe") {
            markerLocation = [southMarker.getLatLng()];
            markerBounds = L.latLngBounds(markerLocation);
            map.fitBounds(markerBounds);
        }
        if (this.textContent === "ART-shop") {
            markerLocation = [westMarker.getLatLng()];
            markerBounds = L.latLngBounds(markerLocation);
            map.fitBounds(markerBounds);
        }
        if (this.textContent === "Restaurant") {
            markerLocation = [eastMarker.getLatLng()];
            markerBounds = L.latLngBounds(markerLocation);
            map.fitBounds(markerBounds);
        }
        if (this.textContent === "Gallery") {
            markerLocation = [gallery.getLatLng()];
            markerBounds = L.latLngBounds(markerLocation);
            map.fitBounds(markerBounds);
        }
        if (this.textContent === "Museum") {
            markerLocation = [markerMuseum.getLatLng()];
            markerBounds = L.latLngBounds(markerLocation);
            map.fitBounds(markerBounds);
        }
    }

    /*Drawing Hotel Position on Map as a red circle
    * and creating clickable points of objects*/

    pub.setup = function() {
        map = L.map("map").setView([21.296423, 202.162382], 15);
        /*map = L.map("map").setView([-45.875, 170.500], 15);*/
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        { maxZoom:18,attribution:"Map data &copy;"
        +"<a href=http://www.openstreetmap.org/copyright>"
        +"OpenStreetMap contributors</a> CC-BY-SA"}).addTo(map);
        /*L.marker([-45.875, 170.500]).addTo(map);*/
        map.on("click", onMapClick);
        centralMarker = L.circle([21.297415, 202.162822],
            {radius: 32,
            color: "red",
            fillColor: "red",
            fillOpacity: 0.5 }).addTo(map);
        centralMarker.bindPopup("<section style='overflow: auto;vertical-align: top'> "+
            "<img src=images/hotel_isabel.jpg alt=Isabel width='96px'>" +
            "<p>Hotel Isabel " +
            "Welcome to Isabel</p></section>"
        );


        contacts = document.getElementsByClassName("hotel");
        title = contacts[0].getElementsByTagName("em")[0];
        title.onclick = centreMap;
        title.style.cursor = "pointer";

        contacts = document.getElementsByClassName("contact");
        for (f = 0; f < contacts.length; f+=1) {
            title = contacts[f].getElementsByTagName("em")[0];
            title.onclick = centreMap;
            title.style.cursor = "pointer";
        }
        activity = document.getElementsByClassName("activity");
        for (f = 0; f < activity.length; f+=1) {
            title = activity[f].getElementsByTagName("em")[0];
            title.onclick = centreMap;
            title.style.cursor = "pointer";
        }
       /* contacts.style.cursor = "pointer";*/
        $("#contactbutton").click(showHContacts);
        $("#attractbutton").click(showHActivity);
    };
    return pub; }());

$(document).ready(Map.setup);
