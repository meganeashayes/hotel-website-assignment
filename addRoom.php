<?php
/**
 * Lets staff add a new room to the hotel booking application - action of the addRoom form on Admin page
 * This page is not directly accessed by either guests or staff, but redirects users to the admin.php page
 * COSC212 Assignment 2
 * Megan Hayes
 */

// Manually start a session (as this page has no access to header.php)
if (session_id() === "") {
    session_start();
}

// Load XML file and add hotelRoom entry
$hotelRooms = simplexml_load_file('xml/hotelRooms.xml');

$hotelRoom = $hotelRooms->addChild('hotelRoom');
$hotelRoom->addChild('number', $_POST['number']);
$hotelRoom->addChild('roomType', $_POST['roomtype']);
$hotelRoom->addChild('description', $_POST['roomdesc']);
$hotelRoom->addChild('pricePerNight', $_POST['price']);
$hotelRooms->saveXML('xml/hotelRooms.xml');

// Redirect users back to admin.php
header("Location: admin.php");
exit;
?>