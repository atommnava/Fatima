<?php
/*
 * @author Atom Alexander M. Nava
 * @brief Página que despliega los detalles de un libro especifico basado en el ID proporcionado.
 * @date
 */

// Configuración de cabeceras para permtir CORS
header("Access-Control-Allow-Origin: *");

require_once 'config.php';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del libro de los parámetros GET
$book_id = $_GET['id'] ?? NULL;

// Verificar si se proporciono el ID
if (!book_id) {
    die("ID inexistente o no especificado...");
}

// Consulta SQL para obtener el libro especifico
$stmt = $conn -> prepare("SELECT * FROM books WHERE id = ?");
$stmt -> bind_param("i", $book_id);
$stmt -> execute();
$result = $stmt -> get_result();
$book = $result -> fetch_assoc();

if (!book) die("Libro no encontrado...");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= htmlspecialchars($book['title']) ?> </title>
    <link rel="stylesheet" href="https://antares.dci.uia.mx/ict23amn/Fatima/src/style.css">
    <!-- Favicon estándar -->
    <link rel="icon" href="../images/logo.ico" type="image/x-icon">
</head>
<body style="background-color: #EEDDC2">
    
    <!-- Contenedor principal para los detalles del libro -->
    <div class="book-detail-container">
        <div class="book-detail-card">
            <!-- Imagen de portada del libro -->
            <img src="<?= htmlspecialchars($book['cover_image']) ?>" alt="Portada" class="detail-cover">
            
            <!-- Información del libro -->
            <div class="book-info">
                <h1><?= htmlspecialchars($book['title']) ?></h1>
                <p class="author">Autor: <?= htmlspecialchars($book['author']) ?></p>
                <p class="description"><?= htmlspecialchars($book['description']) ?></p>
                <p class="price">Precio: $<?= number_format($book['price'], 2) ?></p>
                
                <!-- Botones de acción -->
                <div class="action-buttons">
                    <button class="buy-button" onclick="comprarAhora(<?= $book['id'] ?>)">COMPRAR</button>
                    <button class="cart-button" onclick="agregarAlCarrito(<?= $book['id'] ?>)">AGREGAR AL CARRITO</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script.js -->
    <script src="script.js"></script>
</body>
</html>
