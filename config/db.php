<?php

$host = "localhost";
$port = 3307;
$user = "root";
$password = "";
$database = "mywebsite";

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>