const express = require('express');
const mysql = require('mysql2');
const cors = require('cors');
const path = require('path');

const app = express();
const port = 3000;

// Habilitar CORS y JSON
app.use(cors());
app.use(express.json());

// Hacer accesible la carpeta 'public'
app.use('/public', express.static(path.join(__dirname, 'public')));

// Conexión a MySQL
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '12345678',
    database: 'base_de_datos_fatima'
});

db.connect(err => {
    if (err) {
        console.error('Error conectando a la base de datos:', err);
        return;
    }
    console.log('Conectado a la base de datos MySQL');
});

// Ruta para obtener libros
app.get('/api/books', (req, res) => {
    db.query('SELECT * FROM books', (err, results) => {
        if (err) {
            console.error('Error al obtener libros:', err);
            res.status(500).json({ error: 'Error en el servidor' });
        } else {
            // Agregar la URL completa de la imagen
            const booksWithFullImagePath = results.map(book => ({
                ...book,
                cover_image: `http://localhost:${port}/public/${book.cover_image}`
            }));
            res.json(booksWithFullImagePath);
        }
    });
});

// Iniciar servidor
app.listen(port, () => {
    console.log(`Servidor corriendo en http://localhost:${port}`);
});
