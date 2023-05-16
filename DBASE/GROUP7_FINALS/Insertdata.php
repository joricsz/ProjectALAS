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

// Data validation
if(empty($Fname) && empty($Email)){
    echo "Error: Please fill out all fields.";
} else if(!preg_match('/^[a-zA-Z][a-zA-Z\s]*$/', $Fname)){
    echo "Error: Name cannot start with a number or special character. Please enter a valid name.";
} else if(empty($Fname)){
    echo "Error: Please enter your first name on the field.";
} else if(empty($Email)){
    echo "Error: Please enter your email";
} else if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
    echo "Error: Please enter a valid email address.";
} else {

// Sanitizes the user input data to prevent SQL injection attacks
$Fname = mysqli_real_escape_string($conn, $Fname);
$Email = mysqli_real_escape_string($conn, $Email);

// Checks if the value already exists in the database
$check_query = "SELECT SUB_Email FROM subscriber_table WHERE Email = '$Email'";
$result = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($result) > 0){
        //echo "Email is already in use.";
        $exception_message = "Email is already in use.";
    } else {
        // Inserts the sanitized form data into the database
        $insert_query = "INSERT INTO subscriber_table (SUB_FirstName, SUB_Email) VALUES ('$Fname', '$Email')";
        $result = mysqli_query($conn, $insert_query);

        // Checks if the INSERT query executed successfully
        if(mysqli_affected_rows($conn) > 0){
            //echo "Thank you for subscribing to our newsletter! You'll now receive our latest news and updates in your inbox.";
            $success_message = "Thank you for subscribing to our newsletter! You'll now receive our latest news and updates in your inbox.";
        } else {
            //echo "Error: There was a problem processing your request. Please try again later.";
            $error_message = "There was a problem processing your request. Please try again later.";
        }
    }
}

// Closes the database connection
mysqli_close($conn);
?>

<!-- Display the success or error message using HTML and CSS -->
<div class="message-box">
    <?php if(isset($exception_message)){ ?>
        <div class="error-message"><?php echo $exception_message; ?></div>
    <?php } ?>
    <?php if(isset($success_message)){ ?>
        <div class="success-message"><?php echo $success_message; ?></div>
    <?php } ?>
    <?php if(isset($error_message)){ ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php } ?>
</div>
