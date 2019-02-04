<?php

/**
 * Lets staff edit details of rooms in the hotel - action of the editDetails form on Admin page
 * This page is not directly accessed by either guests or staff, but redirects users to the admin.php page
 * COSC212 Assignment 2
 * Megan Hayes
 */

// Start a session
if (session_id() === "") {
    session_start();
}

/**
 * Check to see if a string contains any content or not.
 * Leading and trailing whitespace are not considered to be 'content'.
 *
 * @param string $str The string to check.
 * @return True if $str is empty, false otherwise.
 */
function isEmpty($str)
{
    return strlen(trim($str)) == 0;
}

$roomNumber = $_POST['number'];
$hotelRooms = simplexml_load_file('xml/hotelRooms.xml');
foreach ($hotelRooms->hotelRoom as $hotelRoom) {
    // Check that the room number entered matches one of the rooms in the hotelRooms.xml file
    if ($hotelRoom->number == $roomNumber && !isEmpty($_POST['number'])) {
        // If a room matches, edit entries for that room only if the field on the form is not empty,
        // i.e. changes have actually been made to that part of the room's details
        if ($hotelRoom->roomType != $_POST['roomtype'] && !isEmpty($_POST['roomtype'])) {
            $hotelRoom->roomType = $_POST['roomtype'];
        }
        if ($hotelRoom->description != $_POST['roomdesc'] && !isEmpty($_POST['roomdesc'])) {
            $hotelRoom->description = $_POST['roomdesc'];
        }
        if ($hotelRoom->pricePerNight != $_POST['price'] && !isEmpty($_POST['price'])) {
            $hotelRoom->pricePerNight = $_POST['price'];
        }
    }
}
$hotelRooms->saveXML('xml/hotelRooms.xml');

// Redirect user back to admin.php
header("Location: admin.php");
exit;
?>