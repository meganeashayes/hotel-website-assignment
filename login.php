<?php
/**
 * Logs in verified staff members for Velvet & Compass Hotel
 * This page is not directly accessed by either guests or staff, but redirects users to the admin.php page
 * COSC212 Assignment 2
 * Megan Hayes
 */

// Start a session
if (session_id() === "") {
    session_start();
}

// Redirect users to the page they were on when they logged in
$lastPage = $_SESSION['lastPage'];
header("Location:$lastPage");

// Access mysqli database to verify user's identity as a staff member
if (isset($_POST['loginSubmit'])) {
    include("filePrivate/connect-to-database.php");
}

// Redirect user to index.php if they are not an authenticated user or they do not sign in correctly
if (!isset($_SESSION['authenticatedUser'])) {
    header("Location:index.php");
}

exit;
?>