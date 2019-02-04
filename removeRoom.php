<?php
/**
 * Lets staff delete a room within the hotel booking application - action of the remove room form on
 * Admin page
 * This page is not directly accessed by either guests or staff, but redirects users to the admin.php page
 * COSC212 Assignment 2
 * Megan Hayes
 */

// Start session (as this page does not access header.php)
if (session_id() === "") {
    session_start();
}
// Delete the room selected from those available in hotelRooms.xml
$roomNumber = $_POST['removeRoom'];
$deleteRooms = simplexml_load_file("xml/hotelRooms.xml");
$deleteRoom = $deleteRooms->xpath("hotelRoom[number[text()='$roomNumber']]");
foreach ($deleteRoom as $delete) {
    unset($delete[0]);
}
$deleteRooms->saveXML('xml/hotelRooms.xml');

// Cancel all bookings in the room that was deleted
$deleteBookings = simplexml_load_file("xml/roomBookings.xml");
$deleteBooking = $deleteBookings->xpath("booking[number[text()='$roomNumber']]");
foreach ($deleteBooking as $delete) {
    unset($delete[0]);
}
$deleteBookings->saveXML('xml/roomBookings.xml');

// Redirect user to admin.php
header("Location: admin.php");
exit;
?>