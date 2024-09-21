<?php
require 'vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Get environment variables
    $conn = mysqli_connect(
        getenv("DB_HOST"),
        getenv("DB_USERNAME"),
        getenv("DB_PASSWORD"),
        getenv("DB_DATABASE"),
        getenv("DB_PORT") ? : "3306"
    );

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// Close the connection when done (optional)
// $conn->close();
