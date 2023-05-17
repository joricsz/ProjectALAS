<?php
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

// Retrieves the form data using $_POST superglobal array
$Fname = $_POST['Fname'];
$Email = $_POST['Email'];

// Sanitizes the user input data to prevent SQL injection attacks
$Fname = mysqli_real_escape_string($conn, $Fname);
$Email = mysqli_real_escape_string($conn, $Email);

// Checks if the value already exists in the database
$check_query = "SELECT SUB_Email FROM subscriber_table WHERE SUB_Email = '$Email'";
$result = mysqli_query($conn, $check_query);

// Inserts the sanitized form data into the database
$insert_query = "INSERT INTO subscriber_table (SUB_FirstName, SUB_Email) VALUES ('$Fname', '$Email')";
$result = mysqli_query($conn, $insert_query);

// Closes the database connection
mysqli_close($conn);
?>
