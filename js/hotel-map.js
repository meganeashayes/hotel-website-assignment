/**
 * Map functions for Velvet & Compass Hotel site for COSC212.
 *
 * Created by: Megan Hayes, 11/08/2018
 * Last updated by: Megan Hayes, 23/08/2018
 */

/* global L*/

/**
 * Module pattern for Map functions
 */
var Map = (function () {
    "use strict";

    var pub = {};
    var map, hotelMarker;
    var jizoMarker, ombrellosMarker, etruscoMarker;
    var hockenMarker, railwayMarker, museumMarker;
    var headings, sectionHeadings;
    var markerLocation, markerBounds;
    var restVisible = true;
    var attrVisible = true;

    /**
     * Centres the map at the marker location of the selected text
     *
     * @param e the event being called
     */
    function centreMap(e) {
        /*jshint -W040*/
        if (this.textContent === 'Velvet & Compass Hotel Dunedin') {
            markerLocation = [hotelMarker.getLatLng()];
        } else if (this.textContent === 'Dunedin Railway Station') {
            markerLocation = [railwayMarker.getLatLng()];
        } else if (this.textContent === 'Hocken Collections') {
            markerLocation = [hockenMarker.getLatLng()];
        } else if (this.textContent === 'Otago Museum') {
            markerLocation = [museumMarker.getLatLng()];
        } else if (this.textContent === 'Jizo') {
            markerLocation = [jizoMarker.getLatLng()];
        } else if (this.textContent === 'Etrusco') {
            markerLocation = [etruscoMarker.getLatLng()];
        } else if (this.textContent === 'Ombrellos Kitchen & Bar') {
            markerLocation = [ombrellosMarker.getLatLng()];
        }
        markerBounds = L.latLngBounds(markerLocation);
        map.fitBounds(markerBounds);
        /*jshint +W040*/
    }

    /**
     * Allows restaurant and attraction markers on the map to be hidden and reexposed
     *
     * When the markers are hidden, the headings for the individual restaurants/attractions
     * are hidden via a slide animation, and slid back out when the markers are made
     * visible again
     * @param e the event being called
     */
    function hideMarkers(e){
        if (this.textContent === 'Local Attractions') {
            $(this).siblings().slideToggle(1000, "linear");
            if (attrVisible) {
                museumMarker.setOpacity(0.0);
                railwayMarker.setOpacity(0.0);
                hockenMarker.setOpacity(0.0);
            } else {
                museumMarker.setOpacity(1.0);
                railwayMarker.setOpacity(1.0);
                hockenMarker.setOpacity(1.0);
            }
            attrVisible = !attrVisible;
        } else if (this.textContent === 'Nearby Restaurants') {
            $(this).siblings().slideToggle(1000, "linear");
            if (restVisible) {
                etruscoMarker.setOpacity(0.0);
                ombrellosMarker.setOpacity(0.0);
                jizoMarker.setOpacity(0.0);
            } else {
                etruscoMarker.setOpacity(1.0);
                ombrellosMarker.setOpacity(1.0);
                jizoMarker.setOpacity(1.0);
            }
            restVisible = !restVisible;
        }
    }

    /**
     * Does the setup for the map
     *
     * Creates a map and initialises the coordinates to display
     *
     * Creates markers with popups
     *
     * Attaches event listeners to headings in the document
     */
    pub.setup = function() {
        map = L.map('map').setView([-45.865889, 170.502504], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            { maxZoom: 18,
                attribution: 'Map data &copy; ' +
                '<a href="http://www.openstreetmap.org/copyright">' +
                'OpenStreetMap contributors</a> CC-BY-SA'
            }).addTo(map);
        hotelMarker = L.marker([-45.865889, 170.502504]).addTo(map);
        hotelMarker.bindPopup("<b>Velvet & Compass Hotel</b> <p>Rooms for travellers from far and wide in the heart of New Zealand's wild South</p>");
        hockenMarker = L.marker([-45.869635, 170.517459]).addTo(map);
        hockenMarker.bindPopup("<b>Hocken Collections</b> <p>Archive and art gallery of national significance</p>");
        etruscoMarker = L.marker([-45.875103, 170.502590]).addTo(map);
        etruscoMarker.bindPopup("<b>Etrusco</b> <p>Italian cuisine</p>");
        museumMarker = L.marker([-45.865455, 170.510395]).addTo(map);
        museumMarker.bindPopup("<b>Otago Museum</b> <p>NZ, Pacific & natural history</p>");
        jizoMarker = L.marker([-45.874789, 170.502831]).addTo(map);
        jizoMarker.bindPopup("<b>Jizo</b> <p>Japanese cuisine and bar</p>");
        ombrellosMarker = L.marker([-45.868038, 170.511008]).addTo(map);
        ombrellosMarker.bindPopup("<b>Ombrellos</b> <p>Dunedin's best craft beer restaurant</p>");
        railwayMarker = L.marker([-45.875144, 170.508854]).addTo(map);
        railwayMarker.bindPopup("<b>Dunedin Railway Station</b> <p>One of the most celebrated heritage buildings in Dunedin</p");
        headings = document.getElementsByTagName("h3");
        sectionHeadings = document.getElementsByTagName("h2");
        var restHeadings = document.getElementsByClassName(".restaurant");
        var actHeadings = document.getElementsByClassName(".attraction");

        for (var h = 0; h < headings.length; h+=1) {
            headings[h].style.cursor = "pointer";
            headings[h].onclick = centreMap;
        }
        for (var i = 0; i < sectionHeadings.length; i+=1){
            sectionHeadings[i].style.cursor = "pointer";
            sectionHeadings[i].onclick = hideMarkers;
        }

    };

    return pub;
}());

$(document).ready(Map.setup);
