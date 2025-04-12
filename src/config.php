<?php
// Configuration for the database
$host = "localhost";
$user = "ict23amn";
$password = "258927";
$database = "ict23amn";

$conn = new mysqli($host, $user, $password, $database);

if ($conn -> connect_error) {
    die("Conn failed: ". $conn->connect_error);
}
?>
