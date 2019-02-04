<?php
/**
 * Admin page for staff of Velvet & Compass Hotel
 * Only accessible to signed-in staff members
 * COSC212 Assignment 2
 * Owner: Megan Hayes
 */

// Start session before header is loaded; will redirect non-signed-in users back to the site's home page
session_start();
if (!isset($_SESSION['authenticatedUser'])) {
    header("Location:index.php");
    exit;
}

// Load header and JavaScript files
$scriptList = array("js/jquery-3.3.1.js", "js/Cookies.js", "js/Constructors.js", "js/Admin.js");
include("filePrivate/header.php");
?>
<section id="phpBookings">
    <!-- Display bookings made for the hotel, and the option to cancel each booking -->
    <h2>Booked Rooms</h2>
    <?php
    $bookings = simplexml_load_file('xml/roomBookings.xml');
    foreach ($bookings->booking as $booking) {
        ?>
        <div id="bookedRoom">
            <form action='cancellation.php' method='post'>
        <?php
        $roomNum = $booking->number;
        echo "<p>Room: $roomNum<br>";
        $groupName = $booking->name;
        echo "Group: $groupName<br>";
        $checkinDay = $booking->checkin->day;
        $checkinMonth = $booking->checkin->month;
        $checkinYear = $booking->checkin->year;
        echo "Check In: $checkinDay/$checkinMonth/$checkinYear<br>";
        $checkoutDay = $booking->checkout->day;
        $checkoutMonth = $booking->checkout->month;
        $checkoutYear = $booking->checkout->year;
        echo "Check Out: $checkoutDay/$checkoutMonth/$checkoutYear<br>";

        echo "<input type='text' name='cancelGroup' value='$groupName' style='display: none'>
            <input type='submit' name='cancel' class='cancel' value='Cancel Booking'></p>
        </form>";
        ?>
        </div>
        <?php
    }
    ?>
</section>
<section id="availableRooms">
    <!-- Display rooms available in the hotel, and the option to remove rooms from those available -->
    <h2>Room Details</h2>
    <?php
    $hotelRooms = simplexml_load_file('xml/hotelRooms.xml');
    foreach ($hotelRooms->hotelRoom as $hotelRoom) {
        $number = $hotelRoom->number;
        $roomType = $hotelRoom->roomType;
        $description = $hotelRoom->description;
        $price = $hotelRoom->pricePerNight;
        ?>
        <div id="availableRoom">
            <?php
        echo "<form method='post' action='removeRoom.php'><p>$number: $roomType<br>$description<br>$price<br> 
<input type='text' name='removeRoom' value='$number' style='display: none'>
<input type='submit' name='remove' value='Remove room'></p>
</form>";
        ?>
        </div>
        <?php
    }
    ?>
</section>
<section id="newRoom">
    <!-- Display options for adding a new room to those available in the hotel and to edit details of an
    existing room -->
    <form action="addRoom.php" method="post" class="textInputs">
        <h2>Add New Room</h2>
        <p><label for="number">Room number:</label>
            <input type="number" name="number" id="number" placeholder="101, 102 etc."></p>
        <p><label for="roomtype">Room type:</label>
            <input type="text" name="roomtype" id="roomtype" placeholder="King, Single, Twin, Double, Triple"></p>
        <p><label for="roomdesc">Description:</label>
            <input type="text" name="roomdesc" id="roomdesc" placeholder="Short description of room"></p>
        <p><label for="price">Price per night:</label>
            <input type="text" name="price" id="price"></p>
        <p><input type="submit" name="addRoom" id="addRoom" value="Add Room" placeholder="Price of room per night"></p>
    </form>
    <br>
    <form action="editDetails.php" method="post" class="textInputs">
        <h2>Edit Room Details</h2>
        <p><label for="number">Room number:</label>
            <input type="number" name="number" id="number" placeholder="101, 102 etc."></p>
        <p><label for="roomtype">Room type:</label>
            <input type="text" name="roomtype" id="roomtype" placeholder="King, Single, Double etc."></p>
        <p><label for="roomdesc">Description:</label>
            <input type="text" name="roomdesc" id="roomdesc" placeholder="Update room's description"></p>
        <p><label for="price">Price per night:</label>
            <input type="text" name="price" id="price"></p>
        <p><input type="submit" name="editDetails" id="editDetails" value="Update Room Details"></p>
    </form>
</section>
<?php
// Load footer
include("filePrivate/footer.php");
?>