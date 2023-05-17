<?php
// Retrieves the form data using $_POST superglobal array
$email = $_GET['Email'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "newsletterdb";

// Creates connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Checks connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Checks if the value already exists in the database
$check_query = "SELECT SUB_Email FROM subscriber_table WHERE SUB_Email = '$email'";
$result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($result) > 0) {
    // Email already exists
    echo "exists";
} else {
    // Email doesn't exist
    echo "not_exists";
}
  
  // Close the database connection
  mysqli_close($conn);
?>