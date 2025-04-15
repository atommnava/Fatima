<?php
header("Access-Control-Allow-Origin: *");

$host = "localhost";
$user = "";
$password = "";
$database = "";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$book_id = $_GET['id'] ?? null;

if (!$book_id) {
    die("ID de libro no especificado");
}

$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    die("Libro no encontrado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($book['title']) ?></title>
    <link rel="stylesheet" href="https://antares.dci.uia.mx/ict23amn/Fatima/src/style.css">
</head>
<body style="background-color: #EEDDC2">
    
    <div class="book-detail-container">
        <div class="book-detail-card">
            <img src="<?= htmlspecialchars($book['cover_image']) ?>" alt="Portada" class="detail-cover">
            <div class="book-info">
                <h1><?= htmlspecialchars($book['title']) ?></h1>
                <p class="author">Autor: <?= htmlspecialchars($book['author']) ?></p>
                <p class="description"><?= htmlspecialchars($book['description']) ?></p>
                <p class="price">Precio: $<?= number_format($book['price'], 2) ?></p>
                
                <div class="action-buttons">
                    <button class="buy-button" onclick="comprarAhora(<?= $book['id'] ?>)">COMPRAR</button>
                    <button class="cart-button" onclick="agregarAlCarrito(<?= $book['id'] ?>)">AGREGAR AL CARRITO</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function comprarAhora(bookId) {
        // Lógica para compra directa
        alert(`Iniciando compra del libro ID: ${bookId}`);
    }

    function agregarAlCarrito(bookId) {
        // Lógica para agregar al carrito
        alert(`Libro ID: ${bookId} agregado al carrito`);
    }
    </script>
</body>
</html>
