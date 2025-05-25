<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "Info";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
    else {
        echo "0 results";
      }
?>
