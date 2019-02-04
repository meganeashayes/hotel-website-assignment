<?php
/**
 * Checkout validation page for booking at Velvet & Compass Hotel
 * COSC212 Assignment 2
 * Owner: Megan Hayes
 */
$scriptList = array("js/jquery3.3.js");
include("filePrivate/header.php");
?>
<section id="main">
    <?php
    /**
     * Check to see if a string is composed entirely of the digits 0-9.
     * Note that this is different to checking if a string is numeric since
     * +/- signs and decimal points are not permitted.
     *
     * @param string $str The string to check.
     * @return True if $str is composed entirely of digits, false otherwise.
     */
    function isDigits($str)
    {
        $pattern = '/^[0-9]+$/';
        return preg_match($pattern, $str);
    }

    /**
     * Check to see if a string contains any content or not.
     * Leading and trailing whitespace are not considered to be 'content'.
     *
     * @param string $str The string to check.
     * @return True if $str is empty, false otherwise.
     */
    function isEmpty($str)
    {
        return strlen(trim($str)) == 0;
    }

    /**
     * Check to see if a string looks like an email.
     * Email validation is actually fairly complex, so this is a thin wrapper
     * around a PHP filter function.
     *
     * @param string $str The string to check.
     * @return  True if $str looks like a valid email address, false otherwise.
     */
    function isEmail($str)
    {
        // There's a built in PHP tool that has a go at this
        return filter_var($str, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Check to see if the length of a string is a given value, ignoring leading
     * and trailing whitespace.
     *
     * @param string $str The string to check.
     * @param integer $len The expected length of $str.
     * @result True if $str has length $len, false otherwise.
     */
    function checkLength($str, $len)
    {
        return strlen(trim($str)) === $len;
    }

    /**
     * Check credit card verification code.
     * This provides some rudimentary validation of a credit card number.
     * These checks depend on the card type:
     * - American express ($cardType = 'amex') card verification codes must be 4 digits long.
     * - MasterCard ($cardType = 'mcard') card verification codes must be 3 digits long.
     * - Visa ($cardType = 'visa') card verification codes must be 3 digits long.
     *
     * @param string $cardType The type of card, one of 'amex', 'mcard', or 'visa'.
     * @param string $cardVerifiy The credit card verification code.
     * @result True if $cardVerify passes some basic checks, false otherwise.
     */
    function checkCardVerification($cardType, $cardVerify)
    {
        if (!isDigits($cardVerify)) {
            return false;
        }

        switch ($cardType) {
            case 'amex':
                return checkLength($cardVerify, 4);
                break;
            case 'mcard':
            case 'visa':
                return checkLength($cardVerify, 3);
                break;
            default:
                return false;
        }
    }

    /**
     * Check credit card expiry date.
     * Checks that the date provided is in the future.
     *
     * @param string $cardMonth Numeric value of card expiry month.
     * @param string $cardYear Card expiry year.
     * @return True if $cardMonth/$cardYear is in the future, false otherwise.
     */
    function checkCardDate($cardMonth, $cardYear)
    {
        $year = (int)date('Y');
        $month = (int)date('n');
        $cardYear = (int)$cardYear;
        $cardMonth = (int)$cardMonth;

        if ($year > $cardYear) {
            return false;
        } elseif ($year === $cardYear && $month >= $cardMonth) {
            return false;
        } else {
            return true;
        }
    }

    // Set session variables for credit card form details
    $_SESSION['deliveryName'] = $_POST['deliveryName'];
    $_SESSION['deliveryEmail'] = $_POST['deliveryEmail'];
    $_SESSION['deliveryAddress1'] = $_POST['deliveryAddress1'];
    $_SESSION['deliveryAddress2'] = $_POST['deliveryAddress2'];
    $_SESSION['deliveryCity'] = $_POST['deliveryCity'];
    $_SESSION['deliveryPostcode'] = $_POST['deliveryPostcode'];
    $_SESSION['cardType'] = $_POST['cardType'];
    $_SESSION['cardNumber'] = $_POST['cardNumber'];
    $_SESSION['cardMonth'] = $_POST['cardMonth'];
    $_SESSION['cardYear'] = $_POST['cardYear'];
    $_SESSION['cardValidation'] = $_POST['cardValidation'];

    $success = true;

    // Test each of the credit card form inputs for validity - that they aren't blank, that email addresses
    // are entered correctly etc.
    //
    // If any parts of the form don't validate, set $success to false and push an error message to the user -
    // also give an option to return to the checkout to correct form details
    foreach ($_POST as $input) {
        if (isEmpty($input) && $input != $_POST['deliveryAddress2']) {
            echo "<p>Please fill out details for all inputs<br></p>";
            $success = false;
            break;
        }
    }
    if (!isEmail($_POST['deliveryEmail'])) {
        echo "Please enter a valid email address<br>";
        $success = false;
    }
    if (!isDigits($_POST['cardNumber'])) {
        echo "Card number must be composed only of digits<br>";
        $success = false;
    }
    if (!checkCardVerification($_POST['cardType'], $_POST['cardValidation'])) {
        echo "Please enter a correct CVC<br>";
        $success = false;
    }
    if (!checkCardDate($_POST['cardMonth'], $_POST['cardYear'])) {
        echo "Card expiry date must be in the future<br>";
        $success = false;
    }
    if (!$success) {
        echo "<a href='checkout.php'>Return to checkout?</a>";
    }

    // If the credit card information successfully validates, load the booking details into the booking XML
    // file, and print out a message confirming the booking and the details of the confirmed booking
    if ($success) {
        $bookings = simplexml_load_file('xml/roomBookings.xml');
        $booking = $bookings->addChild('booking');
        $booking->addAttribute('id', $_SESSION['guestName']);
        $booking->addChild('number', $_SESSION['bookRoom']);
        $booking->addChild('name', $_SESSION['guestName']);
        $checkin = $booking->addChild('checkin');
        $checkin->addChild('day', $_SESSION['arriveDay']);
        $checkin->addChild('month', $_SESSION['arriveMonth']);
        $checkin->addChild('year', $_SESSION['arriveYear']);
        $checkout = $booking->addChild('checkout');
        $checkout->addChild('day', $_SESSION['leaveDay']);
        $checkout->addChild('month', $_SESSION['leaveMonth']);
        $checkout->addChild('year', $_SESSION['leaveYear']);
        $bookings->saveXML('xml/roomBookings.xml');

        $count = $bookings->count() - 1;
        $roomNo = $bookings->booking[$count]->number;
        $guests = $bookings->booking[$count]->name;
        $arriveDay = $bookings->booking[$count]->checkin->day;
        $arriveMonth = $bookings->booking[$count]->checkin->month;
        $arriveYear = $bookings->booking[$count]->checkin->year;
        $leaveDay = $bookings->booking[$count]->checkout->day;
        $leaveMonth = $bookings->booking[$count]->checkout->month;
        $leaveYear = $bookings->booking[$count]->checkout->year;
        ?>
        <div>
            <h2>Thank you for booking at Velvet & Compass Hotel!</h2>
            <p>A confirmation of your booking will be emailed to you shortly along with more details about your
                stay. Below are the details of your booking; please get in touch directly if you have any
                questions:</p>
            <?php
            echo "<p>Room: $roomNo<br>
Group: $guests<br>
Arrive on: $arriveDay/$arriveMonth/$arriveYear<br>
Leave on: $leaveDay/$leaveMonth/$leaveYear</p>";
            ?>
        </div>

        <br>
        <?php
        // Clear the session
        unset($_SESSION['deliveryName']);
        unset($_SESSION['deliveryEmail']);
        unset($_SESSION['deliveryAddress1']);
        unset($_SESSION['deliveryAddress2']);
        unset($_SESSION['deliveryCity']);
        unset($_SESSION['deliveryPostcode']);
        unset($_SESSION['cardType']);
        unset($_SESSION['cardNumber']);
        unset($_SESSION['cardMonth']);
        unset($_SESSION['cardYear']);
        unset($_SESSION['cardValidation']);

        unset($_SESSION['bookRoom']);
        unset($_SESSION['guestName']);
        unset($_SESSION['arriveDay']);
        unset($_SESSION['arriveMonth']);
        unset($_SESSION['arriveYear']);
        unset($_SESSION['leaveDay']);
        unset($_SESSION['leaveMonth']);
        unset($_SESSION['leaveYear']);
        //$_SESSION = array();
        //session_destroy();
    }
    ?>
</section>
<?php
// Load footer
include("filePrivate/footer.php");
?>