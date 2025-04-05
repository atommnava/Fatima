<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "ict23amn", "258927", "ict23amn");
if ($conn->connect_error) {
    die(json_encode(["error" => "Conexión fallida: " . $conn->connect_error]));
}

$result = $conn->query("SELECT * FROM books");
$books = [];
while ($row = $result->fetch_assoc()) {
    $row["price"] = (float)$row["price"]; // Forzar conversión a número
    echo json_encode($books, JSON_NUMERIC_CHECK); // Asegurar números en JSON
}
echo json_encode($books);
?>