<?php
header("Access-Control-Allow-Origin: *"); // Permite cualquier origen
header("Content-Type: application/json; charset=UTF-8");

// Credenciales de la base de datos (AJUSTA ESTOS VALORES)
$servername = "localhost";
$username = "ict23amn"; // Usuario de la BD
$password = "258927"; // Contraseña
$database = "ict23amn"; // Nombre de la BD

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode([
        "error" => "Error de conexión: " . $conn->connect_error
    ]));
}

// Consulta SQL
$sql = "SELECT id, title, author, genre, price, stock, cover_image FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $books = array();
    
    while($row = $result->fetch_assoc()) {
        // Construir URL completa para la imagen
        $row['cover_image'] = "https://antares.dci.uia.mx/ict23amn/Fatima/src/public/covers/" . basename($row['cover_image']);
        $books[] = $row;
    }
    
    echo json_encode($books);
} else {
    echo json_encode([]);
}

$conn->close();
?>