<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sampledb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

//update


//selecting data to display
$sql = "SELECT empID, lastname, firstname, designation, salary FROM employeetbl where lastname='Cruz'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "Employee Number: " . $row["empID"]. 
    "\t LastName: " . $row["lastname"]. " " .
     "\t FirstName" . $row["firstname"].
      "\t Designation" . $row["designation"] .
       "\t Salary" . $row["salary"] . "<br>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
?>