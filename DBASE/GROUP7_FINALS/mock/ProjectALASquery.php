<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "newsletterdb";

date_default_timezone_set("Asia/Manila");

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

/*******************
      QUERIES
*******************/

//QUERY #1 - Display subscriber/s who subscribed on year 2022
echo "<b>List of subscriber/s who subscribed on year 2022</b><br>";
$query = "SELECT SUB_ID, SUB_FirstName, SUB_Email, SUB_SubscribedDate
          FROM subscriber_table
          WHERE YEAR(SUB_SubscribedDate) = 2022";
$result = $conn->query($query);

if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
        // Access each column using its name
        $SUB_ID = $row['SUB_ID'];
        $SUB_FirstName = $row['SUB_FirstName'];
        $SUB_Email = $row['SUB_Email'];
        $SUB_SubscribedDate = $row['SUB_SubscribedDate'];

        // Format and display each column
        $formattedSUB_ID = sprintf("%04d", $SUB_ID);
        $formattedSUB_FirstName = htmlspecialchars($SUB_FirstName);
        $formattedSUB_Email = htmlspecialchars($SUB_Email);
        $formattedSUB_SubscribedDate = date("M j, Y", strtotime($SUB_SubscribedDate));
        echo "ID: $formattedSUB_ID | Name: $formattedSUB_FirstName | Email: $formattedSUB_Email | Subscription Date: $formattedSUB_SubscribedDate <br>";
  }
}else{
  echo "0 results";
}

//QUERY #2 - Display subscriber/s who received the 2022 Holiday Greetings
echo "<br><b>List of all subscribers who received the 2022 Holiday Greetings newsletter</b><br>";
$query = "SELECT subscription_table.SUB_ID, SUB_FirstName, SUB_Email, newsletter_table.NL_ID, newsletter_table.NL_Title
          FROM subscription_table
          INNER JOIN newsletter_table ON newsletter_table.NL_ID = subscription_table.NL_ID
          INNER JOIN subscriber_table ON subscriber_table.SUB_ID = subscription_table.SUB_ID
          WHERE NL_Title = '2022 Holiday Greetings'";
$result = $conn->query($query);

if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
        //Access each column using its name
        $SUB_ID = $row['SUB_ID'];
        $SUB_FirstName = $row['SUB_FirstName'];
        $SUB_Email = $row['SUB_Email'];
        $NL_ID = $row['NL_ID'];
        $NL_Title = $row['NL_Title'];
        
        // Format and display each column
        $formattedSUB_ID = sprintf("%04d",$SUB_ID);
        $formattedSUB_FirstName = htmlspecialchars($SUB_FirstName);
        $formattedSUB_Email = htmlspecialchars($SUB_Email);
        $formattedNL_ID = sprintf("%04d", $NL_ID);
        $formattedNL_Title = htmlspecialchars($NL_Title);
        echo "ID: $formattedSUB_ID | Name: $formattedSUB_FirstName | Email: $formattedSUB_Email | ID: $formattedNL_ID | Title: $formattedNL_Title<br>";
  }
}else{
  echo "0 results";
}

//QUERY #3  Get a list of all newsletters that have been sent to a particular subscriber
echo "<br><b>List of all newsletters sent to a particular subscriber</b><br>";
$query = "SELECT SUB_FirstName, SUB_Email, newsletter_table.NL_ID, newsletter_table.NL_Title
          FROM subscription_table
          INNER JOIN newsletter_table ON newsletter_table.NL_ID = subscription_table.NL_ID
          INNER JOIN subscriber_table ON subscriber_table.SUB_ID = subscription_table.SUB_ID
          WHERE SUB_Email = 'joshua.ricafranca.cics@ust.edu.ph'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Access each column using its name
        $SUB_FirstName = $row['SUB_FirstName'];
        $SUB_Email = $row['SUB_Email'];
        $NL_ID = $row['NL_ID'];
        $NL_Title = $row['NL_Title'];
        
        // Format and display each column
        $formattedSUB_FirstName = htmlspecialchars($SUB_FirstName);
        $formattedSUB_Email = htmlspecialchars($SUB_Email);
        $formattedNL_ID = sprintf("%04d", $NL_ID);
        $formattedNL_Title = htmlspecialchars($NL_Title);
        echo "Name: $formattedSUB_FirstName | Email: $formattedSUB_Email | Title: $formattedNL_Title | ID: $formattedNL_ID<br>";
    }
}else{
  echo "0 results";
}


//QUERY #4 Display subscriber/s who subscribed on month of May 2023
echo "<br><b>List of subscriber/s who subscribed on month of May 2023</b><br>";
$query = "SELECT SUB_ID, SUB_FirstName, SUB_Email, SUB_SubscribedDate
          FROM subscriber_table
          WHERE YEAR(SUB_SubscribedDate)=2023 AND MONTH(SUB_SubscribedDate) = 05";
$result = $conn->query($query);

if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
        // Access each column using its name
        $SUB_ID = $row['SUB_ID'];
        $SUB_FirstName = $row['SUB_FirstName'];
        $SUB_Email = $row['SUB_Email'];
        $SUB_SubscribedDate = $row['SUB_SubscribedDate'];

        // Format and display each column
        $formattedSUB_ID = sprintf("%04d", $SUB_ID);
        $formattedSUB_FirstName = htmlspecialchars($SUB_FirstName);
        $formattedSUB_Email = htmlspecialchars($SUB_Email);
        $formattedSUB_SubscribedDate = date("M j, Y", strtotime($SUB_SubscribedDate));
        echo "ID: $formattedSUB_ID | Name: $formattedSUB_FirstName | Email: $formattedSUB_Email | Subscription Date: $formattedSUB_SubscribedDate <br>";
  }
}else{
  echo "0 results";
}

//QUERY #5 Get count of all subscribers up to date
echo "<br><b>Count of all subscribers up to date</b><br>";
$query = "SELECT COUNT(*) AS total FROM subscriber_table";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$timestampNow = date("M j, Y g:i A");

echo "Total number of subscribers as of $timestampNow: <b>{$row['total']}</b>";

mysqli_close($conn);
?>