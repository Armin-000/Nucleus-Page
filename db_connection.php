<?php
$server = "ucka.veleri.hr";  // Correct server name
$username = "alisic";        // Correct username
$password = "11";            // Correct password
$database = "alisic";        // Correct database name

// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . " - Error Code: " . $conn->connect_errno);
} else {
    echo "Uspješno povezivanje na bazu!";
}


?>
