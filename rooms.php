<?php
/**
 * Page displaying room details for Velvet & Compass Hotel
 * COSC212 Assignment 2
 * Owner: Megan Hayes
 */

// Load header and JavaScript files
$scriptList = array("js/jquery-3.3.1.js", "js/room-carousel.js", "js/display-room-descriptions.js");
include("filePrivate/header.php");
/**
 * Image sources:
 * Double room: https://www.florencehotellaurusalduomo.com/en/rooms-a-suites/double-room-with-view
 * King room: https://www.the-berkeley.co.uk/rooms-and-suites/superior-king-room/
 * Single room: https://www.whitegoodstradeassociation.org/events/book-rooms/single-standard-room-friday-night-detail
 * Triple room: https://www.drurycourthotel.ie/triple-room.html
 * Twin room: https://www.tripadvisor.co.uk/LocationPhotoDirectLink-g186239-d193737-i27869284-The_Atlantic_Hotel-Newquay_Cornwall_England.html
 */
?>
<div id="carousel"></div>
<div id="displayRooms">
    <table class="seeRooms">
        <tr>
            <th>Room Number</th>
            <th>Room Type</th>
            <th>About</th>
            <th>Price per Night</th>
        </tr>
        <!-- JavaScript will insert the available rooms into the table here -->
    </table>
</div>
<?php
// Load footer
include("filePrivate/footer.php");
?>