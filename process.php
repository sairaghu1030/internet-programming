<?php
// Database connection
$servername = "localhost";  // or your host
$username = "root";         // your MySQL username
$password = "";             // your MySQL password
$dbname = "trailwings";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?> 