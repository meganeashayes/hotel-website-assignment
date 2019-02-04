<?php
/**
 * Checkout page for Velvet & Compass Hotel
 * COSC212 Assignment 2
 * Owner: Megan Hayes
 */

// Load header and JavaScript files
$scriptList = array("js/jquery3.3.js", "js/Cookies.js", "js/RoomManager.js", "js/Constructors.js", "js/Admin.js");
include("filePrivate/header.php");

// Store room details as session variables so they can be accessed through the whole checkout process
$_SESSION['bookRoom'] = $_POST['bookRoom'];
$_SESSION['guestName'] = $_POST['guestName'];
$_SESSION['arriveDay'] = $_POST['arriveDay'];
$_SESSION['arriveMonth'] = $_POST['arriveMonth'] + 1;
$_SESSION['arriveYear'] = $_POST['arriveYear'];
$_SESSION['leaveDay'] = $_POST['leaveDay'];
$_SESSION['leaveMonth'] = $_POST['leaveMonth'] + 1;
$_SESSION['leaveYear'] = $_POST['leaveYear'];
?>
<?php
// Fill in values for form inputs if the user needs to return to this form before completing checkout
function formFill($input) {
    if (isset($_SESSION[$input])) {
        $output = $_SESSION[$input];
        echo "value='$output'";
    }
}
?>
<section id="payment">
    <form method="post" action="validateCheckout.php">
        <fieldset>
            <legend>Delivery Details:</legend>
            <p>
                <label for="deliveryName">Deliver to:</label>
                <input type="text" name="deliveryName" id="deliveryName"
                    <?php
                    formFill('deliveryName')
                    ?>
                       required>
            </p>
            <p>
                <label for="deliveryEmail">Email:</label>
                <input type="email" name="deliveryEmail" id="deliveryEmail"
                    <?php
                    formFill('deliveryEmail')
                    ?>
                >
            </p>
            <p>
                <label for="deliveryAddress1">Address:</label>
                <input type="text" name="deliveryAddress1" id="deliveryAddress1"
                    <?php
                    formFill('deliveryAddress1')
                    ?>
                       required>
            </p>
            <p>
                <label for="deliveryAddress2"></label>
                <input type="text" name="deliveryAddress2" id="deliveryAddress2"
                    <?php
                    formFill('deliveryAddress2')
                    ?>
                >
            </p>
            <p>
                <label for="deliveryCity">City:</label>
                <input type="text" name="deliveryCity" id="deliveryCity"
                    <?php
                    formFill('deliveryCity')
                    ?>
                       required>
            </p>
            <p>
                <label for="deliveryPostcode">Postcode:</label>
                <input type="text" name="deliveryPostcode" id="deliveryPostcode" maxlength="4"
                    <?php
                    formFill('deliveryPostcode')
                    ?>
                       required class="short">
            </p>
        </fieldset>

        <fieldset>
            <legend>Payment Details:</legend>
            <p>
                <label for="cardType">Card type:</label>
                <select name="cardType" id="cardType"
                    <?php
                    formFill('cardType')
                    ?>
                >
                    <option value="amex">American Express</option>
                    <option value="mcard">Master Card</option>
                    <option value="visa">Visa</option>
                </select>
            </p>
            <p>
                <label for="cardNumber">Card number:</label>
                <input type="text" name="cardNumber" id="cardNumber" maxlength="16"
                    <?php
                    formFill('cardNumber')
                    ?>
                       required>
            </p>
            <p>
                <label for="cardMonth">Expiry date:</label>
                <select name="cardMonth" id="cardMonth"
                    <?php
                    formFill('cardType')
                    ?>>
                    <option value="1">01</option>
                    <option value="2">02</option>
                    <option value="3">03</option>
                    <option value="4">04</option>
                    <option value="5">05</option>
                    <option value="6">06</option>
                    <option value="7">07</option>
                    <option value="8">08</option>
                    <option value="9">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <label for="cardYear" class="tight">/</label>
                <select name="cardYear" id="cardYear"
                    <?php
                    formFill('cardType')
                    ?>>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                </select>
            </p>
            <p>
                <label for="cardValidation">CVC:</label>
                <input type="text" class="short" maxlength="4" name="cardValidation" id="cardValidation"
                    <?php
                    formFill('cardValidation')
                    ?>
                       required>
            </p>
        </fieldset>
        <input type="submit" name="submitBooking">
    </form>
</section>
<?php
// Load footer
include("filePrivate/footer.php");
?>

