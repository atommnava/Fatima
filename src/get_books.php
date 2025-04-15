<?php
/*
 * @author Atom Alexander M. Nava
 * @brief Script PHP que srive como base (API) para obtener todos los libros de la base de datos.
 * Devuelve los datos en formato JSON.
 */

 // Configuración de cabeceras para permitir CORS y especificar el tipo de contenido
 header("Access-Control-Allow-Origin: *");
 header("Content-Type: application/json");

 // Configuración de la conexión a la base de datos
 $host = "localhost";
 $user = "";
 $password = "";
 $database = "";

 // Crear conexión 
 $conn = new mysqli($host, $user, $password, $database);

 // Validación
 if ($conn -> connect_error) die(json_encode(["error" => "Conexión fallida: ". $conn->connect_error]));

 // Consulta SQL para obtener los libros.
 $result = $conn -> query("SELECT * FROM books;");
 $books = [];

 // Búcle para recorrer los libros.
 while($row = $result -> fetch_assoc()) {
    // TYPE CAST a float el precio
    $row["price"] = (float)$row["price"]; 
    // Agregar cada fila al arreglo «books»
    $books[] = $row;
 }

 // Devolver los libros como JSON
 // JSON_NUMERIC_CHECK asegura que los números se mantengan como números
 echo json_encode($books, JSON_NUMERIC_CHECK);
 
?>
