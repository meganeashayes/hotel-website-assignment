<?php
/**
 * Home page for Velvet & Compass Hotel
 * COSC212 Assignment 2
 * Owner: Megan Hayes
 */

// Load header and JavaScript files
$scriptList = array("js/jquery-3.3.1.js");
include("filePrivate/header.php");
?>
<section class="about">
    <h2>About the Hotel</h2>
    <p>A pleasant terraced house in the heart of Dunedin, your home away from home.</p>
    <ul>
        <li>Wi-Fi</li>
        <li>Beautiful gardens</li>
        <li>Lounge area and piano</li>
        <li>On-site parking</li>
        <li>Spa pool</li>
        <li>Pool table</li>
    </ul>
</section>
<section class="about">
    <h2>Contact Us</h2>
    <ul>
        <li>44 Royal Terrace, Dunedin</li>
        <li>(03) 490 5678</li>
        <li>velvetandcompass@awesomehotels.co.nz</li>
        <li>Check-in: 2:00pm</li>
        <li>Check-out: 10:00am</li>
    </ul>
</section>
<?php
// Load footer
include("filePrivate/footer.php");
?>