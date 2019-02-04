<?php
/**
 * Connect to database to log a staff member in
 * COSC212
 * Megan Hayes
 */
// Start a session
if (session_id() === "") {
    session_start();
}
$conn = new mysqli('sapphire', 'mhayes', 'Hello1234',
    'mhayes_dev');
if ($conn->connect_errno) {
    // Something went wrong connecting
    echo "Could not connect; please try again";
}
$username = $conn->real_escape_string($_POST['loginUser']);
$password = $conn->real_escape_string($_POST['loginPassword']);
$query = "SELECT * FROM HotelStaff WHERE username = '$username' 
            AND password = SHA('$password')";
$result = $conn->query($query);
if ($result->num_rows === 1) {
    // If query is successful, set a session variable for an authenticated user (staff member)
    $_SESSION['authenticatedUser'] = $username;
}

// Close connection to mysqli database
$result->free();

$conn->close();
?>