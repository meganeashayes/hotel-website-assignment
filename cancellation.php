<?php

/**
 * Lets staff cancel a booking within the hotel booking application - action of the cancellation form on
 * Admin page
 * This page is not directly accessed by either guests or staff, but redirects users to the admin.php page
 * COSC212 Assignment 2
 * Megan Hayes
 */

// Start a session (as this page does not load header.php)
if (session_id() === "") {
    session_start();
}

// Delete all orders in the XML file with the same group name
$name = $_POST['cancelGroup'];
$deleteBookings = simplexml_load_file("xml/roomBookings.xml");
$deleteBooking = $deleteBookings->xpath("booking[name[text()='$name']]");
foreach ($deleteBooking as $delete) {
    unset($delete[0]);
}
$deleteBookings->saveXML('xml/roomBookings.xml');

// Redirect user back to admin.php
header("Location: admin.php");
exit;
?>