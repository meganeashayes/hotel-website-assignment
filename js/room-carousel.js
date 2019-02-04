/**
 * Room images carousel display for Velvet & Comapss Hotel, for COSC212
 *
 * Created by: Megan Hayes, 10/08/2018
 * Last edited by: Megan Hayes, 23/08/2018
 */

/**
 * Module pattern for carousel functions
 */
var Carousel = (function() {
    "use strict";
    var pub = {};
    var roomList = [];
    var roomIndex = 0;

    /**
     * Animates the carousel images to fade out
     *
     * On fading out, replaces content of carousel container to a new image by fading in
     */
    function nextCategory() {
        $("#carousel").fadeOut(
            function(){
                $("#carousel").empty().html(roomList[roomIndex].makeHTML()).fadeIn();
            });
        console.log(roomIndex);
        roomIndex += 1;
        if (roomIndex >= roomList.length) {
            roomIndex = 0;
        }
    }

    /**
     * Creates content for the carousel container to display
     * @param title
     * @param image
     * @constructor
     */
    function RoomCategory(title, image) {
        this.title = title;
        this.image = image;
        this.makeHTML = function() {
            return "<figure><img src='" + this.image + "'><figcaption>" + this.title + "</figcaption></figure></a>";
        };
    }

    /**
     * Setup function for carousel
     *
     * Fills roomList array with images and starts the carousel animation
     *
     * Sets a timer for animation
     */
    pub.setup = function() {
        roomList.push(new RoomCategory("King room", "images/king-room.jpg"));
        roomList.push(new RoomCategory("Triple room", "images/triple-room.jpg"));
        roomList.push(new RoomCategory("Double room", "images/double-room.jpg"));
        roomList.push(new RoomCategory("Twin room", "images/twin-room.jpg"));
        roomList.push(new RoomCategory("Single room", "images/single-room.jpg"));
        nextCategory();
        setInterval(nextCategory, 3000);
    };

    return pub;
}());

$(document).ready(Carousel.setup);