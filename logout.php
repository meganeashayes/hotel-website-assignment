<?php

/**
 * Logs out verified staff members for Velvet & Compass Hotel
 * This page is not directly accessed by either guests or staff, but redirects users to either
 * the index.php page (if they were on the admin.php page) or the last page they were on
 * COSC212 Assignment 2
 * Megan Hayes
 */

// Start a session
if (session_id() === "") {
    session_start();
}

// Redirect user to the page they were previously on
$lastPage = $_SESSION['lastPage'];
header("Location:$lastPage");

// Unset the authenticatedUser session variable - if user was on admin.php page, they will be automatically
// redirected back to index.php
unset($_SESSION['authenticatedUser']);

exit;

?>