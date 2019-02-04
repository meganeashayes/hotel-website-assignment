<?php

/**
 * Room booking page for Velvet & Compass Hotel
 * COSC212 Assignment 2
 * Owner: Megan Hayes
 */

// Load header and JavaScript files
$scriptList = array("js/jquery-3.3.1.js", "js/Cookies.js", "js/RoomManager.js", "js/Constructors.js", "js/Admin.js");
include("filePrivate/header.php");

// Fill in values for form inputs if the user needs to return to this form before completing checkout
function formFill($input) {
    if (isset($_SESSION[$input])) {
        $output = $_SESSION[$input];
        echo "value='$output'";
    }
}

?>
<form id="bookingForm" name="bookingForm" method="post" action="checkout.php">
    <h2>Book Your Stay</h2>
    <fieldset>
        <legend>Your Details</legend>
        <ul>
            <li><input id="guestName" name="guestName" type="text" placeholder="Your name" value="<?php
                formFill('guestName')
                ?>"></li>
        </ul>
    </fieldset>
    <fieldset id="dates">
        <legend>When would you like to stay with us?</legend>
        <ul>
            <li>Arrive:
                <select name="arriveDay" id="arriveDay" <?php formFill('arriveDay') ?>>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>
                <select name="arriveMonth" id="arriveMonth"<?php formFill('arriveMonth') ?>>
                    <option value="0">January</option>
                    <option value="1">February</option>
                    <option value="2">March</option>
                    <option value="3">April</option>
                    <option value="4">May</option>
                    <option value="5">June</option>
                    <option value="6">July</option>
                    <option value="7">August</option>
                    <option value="8">September</option>
                    <option value="9">October</option>
                    <option value="10">November</option>
                    <option value="11">December</option>
                </select>


                <select name="arriveYear" id="arriveYear" <?php formFill('arriveYear') ?>>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>

                </select>
            </li>
            <li>Leave:
                <select name="leaveDay" id="leaveDay" <?php formFill('leaveDay') ?>>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>
                <select name="leaveMonth" id="leaveMonth" <?php formFill('leaveMonth') ?>>
                    <option value="0">January</option>
                    <option value="1">February</option>
                    <option value="2">March</option>
                    <option value="3">April</option>
                    <option value="4">May</option>
                    <option value="5">June</option>
                    <option value="6">July</option>
                    <option value="7">August</option>
                    <option value="8">September</option>
                    <option value="9">October</option>
                    <option value="10">November</option>
                    <option value="11">December</option>
                </select>


                <select name="leaveYear" id="leaveYear" <?php formFill('leaveYear') ?>>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>

                </select>
            </li>
        </ul>
    </fieldset>
    <section id="output"><!-- Hotel room data will be put here by JS --></section>
    <p id="errors"><!-- Errors from incorrectly filled in form details will be put here by PHP --></p>
    <p> <input type="submit" id="makeBooking" value="Book Room"></p>

</form>

<?php
// Load footer
include("filePrivate/footer.php");
?>
