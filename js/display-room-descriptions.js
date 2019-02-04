/**
 * Room description display functions for Velvet & Compass Hotel site for COSC212
 *
 * Created by: Megan Hayes, 15/08/2018
 * Last edited by: Megan Hayes, 23/08/2018
 */

/*global $, console*/

/**
 * Module pattern for RoomDescriptions functions
 */
var RoomDescriptions = (function() {
    "use strict";
    var pub = {};

    /**
     * Extracts room information from XML file and displays it in a table
     *
     * @param data
     * @param target
     */
    function parseRooms(data, target) {
        $(data).find("hotelRoom").each(function () {
            var number = $(this).find("number")[0].textContent;
            var roomType = $(this).find("roomType")[0].textContent;
            var description = $(this).find("description")[0].textContent;
            var price = $(this).find("pricePerNight")[0].textContent;

            $(target).append("<tr><td>" +
                number + "</td><td>" +
                roomType + "</td><td>" +
                description + "</td><td>$" +
                price + "</td></tr>")
        });
    }

    /**
     * Finds a target to display content in within HTML page
     *
     * Uses AJAX to retrieve hotelRooms XML file
     *
     * On success, pass XML file and HTML target to parseRooms function
     */
    function showRooms() {
        var target = $.find(".seeRooms")[0];
        var data = "../xml/hotelRooms.xml";
        $.ajax({
            type: "GET",
            url: data,
            cache: false,
            success: function(data) {
                parseRooms(data, target);
            }
        });
    }

    /**
     * Setup function for displaying rooms
     *
     * Calls the showRooms function
     */
    pub.setup = function() {
        showRooms();
    };
    return pub;
}());
$(document).ready(RoomDescriptions.setup);