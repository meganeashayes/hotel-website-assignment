<?php
/**
 * Header and navigation for Velvet & Compass Hotel
 * COSC212 Assignment 2
 * Megan Hayes
 */

// Start a session - header.php is at the top of all pages on the site, so this will load a session across the
// entire site
// Set the "last accessed page" of the site to be the current page - used in page redirection
session_start();
$_SESSION['lastPage'] = $_SERVER['PHP_SELF'];

/**
 * Image sources:
 * Compass header image: https://www.pexels.com/photo/beige-analog-gauge-697662/
 */
?>
<!DOCTYPE html>
<!--
COSC212 Assignment 1 2018, Velvet & Compass Hotel, Megan Hayes
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Velvet & Compass Hotel</title>
    <link rel="stylesheet" href="hotelStyle.css">
    <link rel="stylesheet" href="leaflet/leaflet.css">
    <?php
    // Link JavaScript files into the PHP file from the list given in the page including header.php
    if (isset($scriptList) && is_array($scriptList)) {
        foreach ($scriptList as $script) {
            echo "<script src='$script'></script>";
        }
    }
    echo "<script src='js/loginHelp.js'></script>";
    ?>
</head>
<body>
<header>
    <h1>VELVET & COMPASS HOTEL</h1>
    <p>Rooms for travellers from far and wide in the heart of New Zealand's wild South</p>

    <div id="user">
        <!-- Please see report for login details! -->
        <?php

        // Display the login form if no authenticated user is set, otherwise show the logout form and a
        // welcome message for the staff member logged in
        if (!isset($_SESSION['authenticatedUser'])) {
            ?>
            <div id="login">
                <form id="loginForm" action="login.php" method="POST">
                    <label for="loginUser">Username: </label>
                    <input type="text" name="loginUser" id="loginUser"><br>
                    <label for="loginPassword">Password: </label>
                    <input type="password" name="loginPassword" id="loginPassword"><br>
                    <input type="submit" id="loginSubmit" name="loginSubmit" value="Login">
                    <button id="loginHelp">Help for logging in</button>
                </form>
            </div>
        <?php } else { ?>
            <div id="logout">
                <p>Welcome, <span id="logoutUser"><?php echo $_SESSION['authenticatedUser'] ?></span></p>
                <form id="logoutForm" action="logout.php">
                    <input type="submit" id="logoutSubmit" value="Logout">
                </form>
            </div>
        <?php } ?>
    </div>
</header>
<nav>
    <ul>
        <?php
        // Control which links in the navigation are active - you shouldn't be able to click on a link to the
        // page you are currently on
        $currentPage = basename($_SERVER['PHP_SELF']);
        if ($currentPage === 'index.php') {
            echo "<li> HOME";
        } else {
            echo "<li> <a href='index.php'>HOME</a>";
        }
        if ($currentPage === 'book-now.php') {
            echo "<li> BOOK NOW";
        } else {
            echo "<li> <a href='book-now.php'>BOOK NOW</a>";
        }
        if ($currentPage === 'rooms.php') {
            echo "<li> ROOMS";
        } else {
            echo "<li> <a href='rooms.php'>ROOMS</a>";
        }
        if ($currentPage === 'location.php') {
            echo "<li> LOCATION";
        } else {
            echo "<li> <a href='location.php'>LOCATION</a>";
        }
        ?>
    </ul>
</nav>
