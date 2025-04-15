<?php
// Configuration for the database
$host = "localhost";
$user = "";
$password = "";
$database = "";

$conn = new mysqli($host, $user, $password, $database);

if ($conn -> connect_error) {
    die("Conn failed: ". $conn->connect_error);
}
?>
