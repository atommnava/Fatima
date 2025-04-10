<?php
$host = "localhost";
$user = "ict23amn";
$password = "258927";
$database = "ict23amn";

$conn = new sqli($host, $user, $password, $database);

if ($conn -> connect_error) {
    die("Conn failed: ". $conn->connect_error);
}
?>