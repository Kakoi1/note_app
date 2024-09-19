<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "login_register";
$port = 3306; // Default MySQL port

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Your code for queries here

// Close the connection when done
mysqli_close($conn);

?>
